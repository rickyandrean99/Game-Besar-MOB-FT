<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Events\PrivateQuestResult;
use App\Events\UpdatePart;
use App\Events\BroadcastVideo;
use App\SecretWeapon;

class QuestController extends Controller
{
    public function index() {
        $this->authorize('admin-quest');

        $teams = DB::table('teams')->select('id', 'name')->get();

        return view('admin.quest', [ 'teams' => $teams ]);
    }

    public function result(Request $request) {
        $this->authorize('admin-quest');

        $receiver_id = $request->get('id_team');

        if ($request->get('status')) {
            $message = "Hore, tim anda berhasil !";

            $defaultParts = DB::table('secret_weapons')->select('part_amount_collected')->get();
            $parts = $defaultParts[0]->part_amount_collected + 1;

            DB::table('secret_weapons')->where('id', 1)->update(['part_amount_collected'=>$parts]);
            DB::table('teams')->where('id', $receiver_id)->update(['material_shopping'=>0]);
        } else
            $message = "Yahh, tim anda gagal :')";

        
        $insert_history = DB::table('histories')->insert([
            'teams_id' => $receiver_id,
            'name' => $message,
            'type' => 'quest'
        ]);
        
        $secret_weapon = SecretWeapon::find(1);
        
        // Pusher
        broadcast(new PrivateQuestResult($receiver_id, $message))->toOthers();
        event(new UpdatePart($secret_weapon->part_amount_collected, $secret_weapon->part_amount_target));
        if ($secret_weapon->part_amount_collected >= $secret_weapon->part_amount_target) {
            event(new BroadcastVideo(true));
        }

        return ["success" => true];
    }
}
