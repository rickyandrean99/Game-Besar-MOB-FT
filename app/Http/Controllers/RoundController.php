<?php

namespace App\Http\Controllers;

use App\Events\BroadcastVideo;
use App\Events\UpdatePart;
use App\Events\UpdateRound;
use App\Events\PrivateQuestResult;
use App\Events\UpdateHitpoint;
use App\Events\UpdateStatus;
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
        $damage_dealt_to_boss = 0;
        $attack_amount_list = array();
        
        // [RICKY] Sistem serang boss
        if ($round_detail->round > 0 && $round_detail->round <= 20) {
            // [RICKY] Masuk if jika round itu adalah special
            if ($round_detail->round % 4 == 0 || $round_detail->round == 13) {
                $boss_attack_list = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25);
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
                if ($team->attack_status && $team->weapon_level > 0) {
                    $damage_weapon = $team->weapon_level * 50 + 50;
                } else {
                    $damage_weapon = 0;
                }

                // [RICKY] Cek buff_regeneration (RETURNER)
                if ($team->buff_regeneration > 0) { 
                    $update_hp_team = DB::table('teams')->where('id', $team->id)->increment('hp_amount', 30);
                    broadcast(new UpdateHitpoint($team->id, $team->hp_amount + 30, null, null))->toOthers();
                }

                // [RICKY] Cek Status buff_increased (SCARLET PHANTOM)
                if ($team->buff_increased > 0) {
                    $damage_weapon += (0.25 * $damage_weapon);
                }

                // [RICKY] Cek Status debuff_overtime yang stackable (PARADOX SPHERE)
                if ($team->debuff_overtime) {
                    $damage_weapon += 10;
                }

                $damage_dealt_to_boss += $damage_weapon;
                $attack_amount_list[] = $damage_weapon;
            }

            // [RICKY] Kurangi hp boss berdasarkan damage_dealt_to_boss
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

                        // History kena damage
                        $msg_receive_damage = 'Terkena damage boss sebesar '.$damage_dealt_to_team;

                        $insert_history = DB::table('histories')->insert([
                            'teams_id' => $value,
                            'name' => $msg_receive_damage,
                            'type' => 'ATTACKED',
                            'time' =>  Carbon::now(),
                            'round' => $round_detail->round
                        ]);
                        
                        $msg_receive_damage = "<tr><td><p><b>[ATTACKED]</b><small> ".date('H:i:s')."</small><br><span>".$msg_receive_damage."</span></p></td></tr>";
                        
                        // [RICKY] Kurangi HP Team
                        if ($team_detail->hp_amount > $damage_dealt_to_team) {
                            $attack_team = DB::table('teams')->where('id', $team_detail->id)->decrement('hp_amount', $damage_dealt_to_team);
                            broadcast(new UpdateHitpoint($team_detail->id, $team_detail->hp_amount - $damage_dealt_to_team, $msg_receive_damage, null))->toOthers();
                        } else {
                            $attack_team = DB::table('teams')->where('id', $team_detail->id)->update(['hp_amount'=> 0]);
                            $death_message = "<tr><td><p><b>[STATUS]</b><small> ".date('H:i:s')."</small><br><span>Tidak dapat bermain lagi</span></p></td></tr>";
                            broadcast(new UpdateHitpoint($team_detail->id, 0, $msg_receive_damage, $death_message))->toOthers();

                            $insert_history = DB::table('histories')->insert([
                                'teams_id' => $value,
                                'name' => 'Tidak dapat bermain lagi',
                                'type' => 'STATUS',
                                'time' =>  Carbon::now(),
                                'round' => $round_detail->round
                            ]);
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

                    $reset_ye = DB::table('teams')->where('id', $team->id)->update([
                        'debuff_decreased' => $set_debuff_decreased,
                        'buff_increased' => $set_buff_increased,
                        'buff_regeneration' => $set_buff_regeneration,
                    ]);
                }
            }
            
            $reset = DB::table('teams')->update([
                'material_shopping' => true,
                'quest_status' => false,
                'debuff_disable' => false,
                'debuff_overtime' => false,
                'buff_immortal' => false,
                'shield' => false,
                'attack_status' => false,
                'heal_status' => false,
                'buff_debuff_status' => false
            ]);
        }

        // [RICKY] Update round
        $minute = 8;

        $end_time = Carbon::now()->addMinutes($minute);
        $update_round = DB::table('rounds')->where('id', 1)->update(['round'=> $round_detail->round + 1, 'action'=> false, 'time_end'=> $end_time]);

        // [RICKY] Pusher broadcast
        $boss_detail = EnemyBoss::find(1);
        event(new UpdateRound($round_detail->round + 1, false, $minute, $boss_detail->hp_amount));

        // Update Status
        $team_list = Team::all();
        foreach ($team_list as $key => $tl) {
            if ($attack_amount_list[$key] > 0) {
                $insert_history = DB::table('histories')->insert([
                    'teams_id' => $tl->id,
                    'name' => 'Berhasil melancarkan serangan sebesar '.$attack_amount_list[$key],
                    'type' => 'ATTACK',
                    'time' =>  Carbon::now(),
                    'round' => $round_detail->round
                ]);
            }
            broadcast(new UpdateStatus($tl, $attack_amount_list[$key]))->toOthers();
        }

        return ["success" => true];
    }

    // [RICKY] Untuk update sesi jadi action
    public function updateSesi() {
        $this->authorize('admin-itd');

        $round_detail = Round::find(1);
        $minute = 1;

        // [RICKY] Update round
        $end_time = Carbon::now()->addMinutes($minute);
        $update_round = DB::table('rounds')->where('id', 1)->update(['action'=> true, 'time_end'=> $end_time]);

        // [RICKY] Pusher broadcast
        event(new UpdateRound($round_detail->round, true, $minute, null));
        return ["success" => true];
    }

    // [RICKY] Untuk broadcast video
    public function broadcastVideo(Request $request) {
        $type = $request->get('broadcast_type');
        if (!($type)) {
            $update_reminder = DB::table('rounds')->where('id', 1)->update(['reminder'=> true]);
        }

        event(new BroadcastVideo($type));
        return ["success" => true];
    }

    // [RICKY] Test untuk update progress dari special weapon part
    public function updatePartManual(Request $request) {
        $part_amount = $request->get('amount');
        $update_part = DB::table('secret_weapons')->where('id', 1)->increment('part_amount_collected', $part_amount);

        $secret_weapon = SecretWeapon::find(1);
        event(new UpdatePart($secret_weapon->part_amount_collected, $secret_weapon->part_amount_target));

        if ($secret_weapon->part_amount_collected >= $secret_weapon->part_amount_target) {
            event(new BroadcastVideo(true));
        }

        return ["success" => true];
    }
}