<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\Team;

class ShopController extends Controller
{
    public function index() {
        $this->authorize('admin-shop');
        return view('admin.toko');
    }
}
