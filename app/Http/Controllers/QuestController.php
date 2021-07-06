<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Events\PrivateQuestResult;

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
        } else
            $message = "Yahh, tim anda gagal :')";

        DB::table('teams')->where('id', $receiver_id)->update(['material_shopping'=>1]);

        broadcast(new PrivateQuestResult($receiver_id, $message))->toOthers();
        return ["success" => true];
    }
}
