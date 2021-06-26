<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use DB;

class TeamController extends Controller
{
    // [RICKY] Reload halaman dashboard peserta
    public function dashboard() {
        return view('peserta.dashboard');
    }
}
