<?php

namespace App\Http\Controllers;

use App\Events\BroadcastVideo;
use App\Events\UpdatePart;
use App\Events\UpdateRound;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Team;
use App\EnemyBoss;
use App\SecretWeapon;
use App\Round;
use Carbon\Carbon;
use DB;

class RoundController extends Controller
{
    // [RICKY] Reload halaman admin untuk ganti ronde dan sesi
    public function round() {
        $this->authorize('admin-itd');

        $round = Round::find(1);
        $difference = strtotime($round->time_end) - strtotime(date("Y-m-d H:i:s"));
        return view('admin.round', ['round'=> $round, 'times'=> $difference]);
    }

    // [RICKY] Untuk update round dan set sesi jadi preparation
    public function updateRound() {
        $this->authorize('admin-itd');

        $round_detail = Round::find(1);
        $debuff_overtime = 0;
        $damage_dealt_to_boss = 0;
        
        // [RICKY] Sistem serang boss
        if ($round_detail->round > 0 && $round_detail->round <= 20) {
            // [RICKY] Masuk if jika round itu adalah special
            if ($round_detail->round % 4 == 0) {
                $boss_attack_list = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
                $boss_damage = 300;
            } else {
                $random_attack_list = DB::table('random_boss_attacks')->where('id', $round_detail->round)->get();
                $boss_attack_list[] = $random_attack_list[0]->first_team;
                $boss_attack_list[] = $random_attack_list[0]->second_team;
                $boss_attack_list[] = $random_attack_list[0]->third_team;
                $boss_attack_list[] = $random_attack_list[0]->fourth_team;
                $boss_damage = 100;
            }

            // [RICKY] Team melancarkan serangan ke boss
            $team_list = Team::all();
            foreach ($team_list as $team) {
                $damage_weapon = ($team->attack_status)? $team->weapon_level * 50 : 0;

                // [RICKY] Cek buff_regeneration (RETURNER)
                if ($team->buff_regeneration > 0) { 
                    $update_hp_team = DB::table('teams')->where('id', $team->id)->increment('hp_amount', 30);
                }

                // [RICKY] Cek Status debuff_overtime yang stackable (PARADOX SPHERE)
                if ($team->debuff_overtime) {
                    $debuff_overtime++;
                }

                // [RICKY] Cek Status buff_increased (SCARLET PHANTOM)
                if ($team->buff_increased > 0) {
                    $damage_weapon += (0.25 * $damage_weapon);
                }

                $damage_dealt_to_boss += $damage_weapon;
            }

            // [RICKY] Kurangi hp boss berdasarkan damage_dealt_to_boss dan debuff overtime
            $damage_dealt_to_boss += ($debuff_overtime*10);
            $attack_boss = DB::table('enemy_bosses')->where('id', 1)->decrement('hp_amount', $damage_dealt_to_boss);

            // [RICKY] Boss melancarkan serangan tim yang sudah ditentukan
            foreach ($boss_attack_list as $value) {
                $team_detail = Team::find($value);
                $damage_dealt_to_team = $boss_damage;
                
                // [RICKY] Memastikan apakah tim masih bisa bermain dengan mengecek hp yang dimiliki
                if ($team_detail->hp_amount > 0) {
                    // [RICKY] Pengecekan apakah monster boss dapat menyerang tim ini (WINDTALKER & IMMORTAL ARMOR)
                    if (!($team_detail->debuff_disable) && !($team_detail->buff_immortal)) {
                        // [RICKY] Damage yang diterima dari serangan boss berkurang 25% (ANTIQUE CUIRASS)
                        if ($team_detail->debuff_decreased > 0) {
                            $damage_dealt_to_team = 0.75 * $damage_dealt_to_team;
                        }

                        // [RICKY] Damage yang diterima dari serangan boss berkurang 50% [SHIELD]
                        if ($team_detail->shield) {
                            $damage_dealt_to_team = (int)(0.5 * $damage_dealt_to_team);
                        }
                        
                        // [RICKY] Kurangi HP Team
                        if ($team_detail->hp_amount > $damage_dealt_to_team) {
                            $attack_team = DB::table('teams')->where('id', $team_detail->id)->decrement('hp_amount', $damage_dealt_to_team);
                        } else {
                            $attack_team = DB::table('teams')->where('id', $team_detail->id)->update(['hp_amount'=> 0]);
                        }
                    }
                }
            }

            // [RICKY] Hapus status buff/debuff dll
            $team_list = Team::all();
            foreach ($team_list as $team) {
                // [RICKY] Reset jika tim masih diperbolehkan bermain
                if ($team->hp_amount > 0) {
                    $set_debuff_decreased = ($team->debuff_decreased > 0)? $team->debuff_decreased - 1 : 0;
                    $set_buff_increased = ($team->buff_increased > 0)? $team->buff_increased - 1 : 0;
                    $set_buff_regeneration = ($team->buff_regeneration  > 0)? $team->buff_regeneration  - 1 : 0;

                    $reset = DB::table('teams')->where('id', $team->id)->update([
                        'debuff_disable' => false,
                        'debuff_decreased' => $set_debuff_decreased,
                        'debuff_overtime' => false,
                        'buff_increased' => $set_buff_increased,
                        'buff_immortal' => false,
                        'buff_regeneration' => $set_buff_regeneration,
                        'shield' => false,
                        'attack_status' => false,
                        'heal_status' => false,
                        'buff_debuff_status' => false
                    ]);
                }
            }
        }

        // [RICKY] Update round
        $end_time = Carbon::now()->addMinutes(3);
        $update_round = DB::table('rounds')->where('id', 1)->update(['round'=> $round_detail->round + 1, 'action'=> false, 'time_end'=> $end_time]);

        // [RICKY] Pusher broadcast
        $boss_detail = EnemyBoss::find(1);
        event(new UpdateRound($round_detail->round + 1, false, 3, $boss_detail->hp_amount));
        return ["success" => true];
    }

    // [RICKY] Untuk update sesi jadi action
    public function updateSesi() {
        $this->authorize('admin-itd');
        
        $round_detail = Round::find(1);

        // [RICKY] Update round
        $end_time = Carbon::now()->addMinutes(1);
        $update_round = DB::table('rounds')->where('id', 1)->update(['action'=> true, 'time_end'=> $end_time]);

        // [RICKY] Pusher broadcast
        event(new UpdateRound($round_detail->round, true, 1, null));
        return ["success" => true];
    }

    // [RICKY] Untuk broadcast video
    public function broadcastVideo(Request $request) {
        event(new BroadcastVideo($request->get('broadcast_type')));
        return ["success" => true];
    }

    // [RICKY] Test untuk update progress dari special weapon part
    public function testingPartDoang(Request $request) {
        $part_amount = $request->get('amount');
        $secret_weapon = SecretWeapon::find(1);
        $update_part = DB::table('secret_weapons')->where('id', 1)->increment('part_amount_collected', $part_amount);
        event(new UpdatePart($secret_weapon->part_amount_collected + $part_amount, $secret_weapon->part_amount_target));

        if ($secret_weapon->part_amount_collected + $part_amount >= $secret_weapon->part_amount_target) {
            event(new BroadcastVideo(true));
        }

        return ["success" => true];
    }
}