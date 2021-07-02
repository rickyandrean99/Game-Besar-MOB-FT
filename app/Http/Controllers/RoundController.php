<?php

namespace App\Http\Controllers;

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
        $round = Round::find(1);
        $difference = strtotime($round->time_end) - strtotime(date("Y-m-d H:i:s"));
        return view('admin.round', ['round'=> $round, 'times'=> $difference]);
    }

    // [RICKY] Untuk update round dan set sesi jadi preparation
    public function updateRound() {
        $round_detail = Round::find(1);
        $debuff_overtime = 0; // Cek ini untuk keseluruhan tim
        
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
                $buff_increased = false;

                // Buff regeneration sekalian (RETURNER)
                if ($team->buff_regeneration > 0) { 
                    $update_hp_team = DB::table('teams')->where('id', $team->id)->increment('hp_amount', 50);
                }

                // Cek Status debuff_overtime yang stackable di seluruh tim (PARADOX SPHERE)
                if ($team->debuff_overtime) {
                    $debuff_overtime++;
                }

                // Cek Status buff_increased seluruh tim saat mau melancarkan attack (SCARLET PHANTOM)
                if ($team->buff_increased > 0) {
                    $buff_increased = true;
                }

                // Player attack ke boss
                $damage_weapon = $team->weapon_level * 50;
                if ($buff_increased) {
                    $damage_weapon += (0.25 * $damage_weapon);
                }

                $attack_boss = DB::table('enemy_bosses')->where('id', 1)->decrement('hp_amount', $damage_weapon);
            }

            // [RICKY] Boss melancarkan serangan tim yang sudah ditentukan
            foreach ($boss_attack_list as $value) {
                $team_detail = Team::find($value);
                
                // [RICKY] Memastikan apakah tim masih bisa bermain dengan mengecek hp yang dimiliki
                if ($team_detail->hp_amount != 0) {
                    // [RICKY] Pengecekan apakah monster boss dapat menyerang tim ini (WINDTALKER)
                    if (!($team_detail->debuff_disable)) {
                        // Damage yang diterima boss berkurang (ANTIQUE CUIRASS)
                        if ($team_detail->debuff_decreased > 0) {
                            $boss_damage = 0.75 * $boss_damage;
                        }

                        // Cek Status shield tim [SHIELD]
                        if ($team_detail->shield) {
                            $boss_damage = 0.5 * $boss_damage;
                        }

                        // Cek Status buff_immortal tim saat special turn [IMMORTAL ARMOR]
                        if ($round_detail->round % 4 == 0) {
                            if ($round_detail->buff_immortal) {
                                $boss_damage = 0;
                            }
                        }
                        
                        // Kurangi HP Team (Cek darah diatas atau dibawah damage boss)
                        $attack_team = DB::table('teams')->where('id', $team_detail->id)->decrement('hp_amount', $boss_damage);
                    } else {
                        // cari tim baru (pake loop tentukan tim barunya)
                    }
                }
            }

            // [RICKY] Remove status
            $team_list = Team::all();
            foreach ($team_list as $team) {
                // Reset debuff disable
                if ($team->debuff_disable) {
                    $reset = DB::table('teams')->where('id', $team->id)->update(['debuff_disable'=> false]);
                }

                // Reset debuff decreased
                if ($team->debuff_decreased > 0) {
                    $reset = DB::table('teams')->where('id', $team->id)->decrement('debuff_decreased', 1);
                }

                // Reset debuff overtime
                if ($team->debuff_overtime) {
                    $reset = DB::table('teams')->where('id', $team->id)->update(['debuff_overtime'=> false]);
                }

                // Reset buff increased
                if ($team->buff_increased) {
                    $reset = DB::table('teams')->where('id', $team->id)->decrement('buff_increased', 1);
                }

                // Reset buff increased
                if ($team->buff_immortal) {
                    $reset = DB::table('teams')->where('id', $team->id)->update(['buff_immortal'=> false]);
                }

                // Reset buff regeneration
                if ($team->buff_regeneration) {
                    $reset = DB::table('teams')->where('id', $team->id)->decrement('buff_regeneration', 1);
                }

                // Reset shield
                if ($team->shield) {
                    $reset = DB::table('teams')->where('id', $team->id)->update(['shield'=> false]);
                }
            }
        } else {
            // Gamebes belum mulai atau sudah selesai
        }

        // [RICKY] Update round
        // $end_time = Carbon::now()->addMinutes(3);
        // $update_round = DB::table('rounds')->where('id', 1)->update(['round'=> $round_detail->round + 1, 'action'=> false, 'time_end'=> $end_time]);

        // [RICKY] Pusher broadcast
        // event(new UpdateRound($round_detail->round + 1, false, 3));
        // return ["success" => true];
    }

    // [RICKY] Untuk update sesi jadi action
    public function updateSesi() {
        $round_detail = Round::find(1);

        // [RICKY] Update round
        $end_time = Carbon::now()->addMinutes(1);
        $update_round = DB::table('rounds')->where('id', 1)->update(['action'=> true, 'time_end'=> $end_time]);

        // [RICKY] Pusher broadcast
        event(new UpdateRound($round_detail->round, true, 1));
        return ["success" => true];
    }
}