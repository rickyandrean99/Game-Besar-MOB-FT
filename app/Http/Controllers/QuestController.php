<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Events\PrivateQuestResult;
use App\Events\UpdateAdminQuest;
use App\Events\UpdatePart;
use App\Events\BroadcastVideo;
use App\SecretWeapon;
use App\Round;
use Carbon\Carbon;

class QuestController extends Controller
{
    public function index() {
        $this->authorize('admin-quest');

        $teams = DB::table('teams')->select('id', 'name', 'quest_status')->get();

        $round = Round::find(1);
        $difference = strtotime($round->time_end) - strtotime(date("Y-m-d H:i:s"));
        $secret_weapon = SecretWeapon::find(1);

        return view('admin.quest', [
            'teams' => $teams,
            'round'=> $round,
            'times'=> $difference,
            'weapon' => $secret_weapon
        ]);
    }

    public function result(Request $request) {
        $this->authorize('admin-quest');

        $round = Round::find(1);
        $receiver_id = $request->get('id_team');

        // Add part for scret weapons
        $secret = SecretWeapon::find(1);

        if ($secret->part_amount_collected + count($receiver_id) > 250)
            DB::table('secret_weapons')->where('id', 1)->update(['part_amount_collected' => 250]);
        else
            DB::table('secret_weapons')->where('id', 1)->increment('part_amount_collected', count($receiver_id));

        foreach ($receiver_id as $id) {
            $message = "Selamat, tim anda berhasil menyelesaikan quest";

            // Update Part Tim
            DB::table('teams')->where('id', $id)->increment('quest_amount', 1);

            // Ubah status material shopping
            DB::table('teams')->where('id', $id)->update(['material_shopping'=>0, 'quest_status'=>true]);

            // Insert history
            DB::table('histories')->insert([
                'teams_id' => $id,
                'name' => $message,
                'type' => 'QUEST',
                'time' =>  Carbon::now(),
                'round' => $round->round
            ]);

            // Pusher private
            $message = "<tr><td><p><b>[QUEST]</b><small> ".date('H:i:s')."</small><br><span>".$message."</span></p></td></tr>";
            broadcast(new PrivateQuestResult($id, $message))->toOthers();
        }

        // Pusher
        $secret_weapon = SecretWeapon::find(1);
        event(new UpdatePart($secret_weapon->part_amount_collected, $secret_weapon->part_amount_target));
        if ($secret_weapon->part_amount_collected >= $secret_weapon->part_amount_target) {
            event(new BroadcastVideo(true));
        }

        // broadcast ke halaman quest untuk update table
        event(new UpdateAdminQuest($receiver_id, true));

        return ["success" => true];
    }
}
