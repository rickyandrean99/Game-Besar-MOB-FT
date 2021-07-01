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
        return view('admin.round', ['round'=> $round]);
    }

    // [RICKY] Untuk update round dan set sesi jadi preparation
    public function updateRound() {
        $round_detail = Round::find(1);

        $end_time = Carbon::now()->addMinutes(3);
        $update_round = DB::table('rounds')->where('id', 1)->update(['round'=> $round_detail->round + 1, 'action'=> false, 'time_end'=> $end_time]);

        event(new UpdateRound($round_detail->round + 1, false, 3));

        return ["success" => true];
    }

    // [RICKY] Untuk update sesi jadi action
    public function updateSesi() {
        $round_detail = Round::find(1);

        $end_time = Carbon::now()->addMinutes(1);
        $update_round = DB::table('rounds')->where('id', 1)->update(['action'=> true, 'time_end'=> $end_time]);

        event(new UpdateRound($round_detail->round, true, 1));

        return ["success" => true];
    }
}