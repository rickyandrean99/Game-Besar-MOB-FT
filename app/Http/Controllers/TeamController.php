<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use DB;

class TeamController extends Controller
{
    // Asumsi data yang digunakan adalah tim 1

    // [RICKY] Reload halaman dashboard peserta
    public function dashboard() {
        $equipment_list = DB::table('equipments')->get();

        return view('peserta.dashboard',
            [
                'equipments' => $equipment_list
            ]
        );
    }
}
