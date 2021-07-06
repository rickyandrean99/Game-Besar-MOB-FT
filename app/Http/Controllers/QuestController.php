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
        $receiver_id = $request->get('id_team');

        if ($request->get('status')) {
            $message = "Tim mu berhasil menyelesaikan quest";


        } else {
            $message = "Tim mu gagal menyelesaikan quest";
        }

        broadcast(new PrivateQuestResult($receiver_id, $message))->toOthers();
        return ["success" => true];
    }
}
