<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class QuestController extends Controller
{
    public function index() {
        $this->authorize('admin-quest');
        
        return view('admin.quest');
    }
}
