<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == "maharu") {
            return redirect()->route('dashboard');
        } else if (Auth::user()->role == "shop") {
            return redirect()->route('shop');
        } else if (Auth::user()->role == "quest") {
            return redirect()->route('quest');
        } else if (Auth::user()->role == "rally") {
            return redirect()->route('rally');
        } else if (Auth::user()->role == "admin") {
            return redirect()->route('round');
        }
    }
}
