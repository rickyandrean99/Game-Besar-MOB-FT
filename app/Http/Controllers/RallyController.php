<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RallyController extends Controller
{
    public function team(){
        $this->authorize('admin-rally');

        $teams = DB::table('teams')->get();
        return view('admin.rally',['teams'=>$teams]);
    }

    public function rallySimpan(Request $request){
        $this->authorize('admin-rally');

        $tipe = $request->get('tipe');
        $kelompok1 = $request->get('kelompok1');
        $kelompok2 = $request->get('kelompok2');
        $status = $request->get('status');
        $coin = 0;
        if($tipe == "singel"){
            if($status == 'win'){
                $coin = 100000;
            }
            else{
                $coin = 20000;
            }
            $update= DB::table('teams')->where('id',$kelompok1)->increment('coin',$coin);
        }
        else{
            if($status == "winOrLose"){
                $coinwin = 250000;
                $coinlose = 30000;
                $update1= DB::table('teams')->where('id',$kelompok1)->increment('coin',$coinwin);
                $update2= DB::table('teams')->where('id',$kelompok2)->increment('coin',$coinlose);
            }
            else{
                $coin = 100000;
                $update= DB::table('teams')->where('id',$kelompok1)->increment('coin',$coin);
                $update= DB::table('teams')->where('id',$kelompok2)->increment('coin',$coin);
            }
        }

        return response()->json(array(
            'msg' => "berhasil menambahkan koin"
        ), 200);
    }
}
