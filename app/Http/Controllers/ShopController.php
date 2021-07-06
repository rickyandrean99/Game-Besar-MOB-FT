<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\Team;
use DB;

class ShopController extends Controller
{
    public function index()
    {
        $this->authorize('admin-shop');
        return view('admin.shop', ["material" => Material::all(), "team" => Team::where('material_shopping',0)->get()]);
    }

    public function insertOrUpdate(Request $request, Team $team)
    {
        // $this->authorize('admin-shop');

        //Cari ID Team yang sesuai & ambil array Cart dari Requests
        $id = $request->get('teams_id');
        $team = Team::find($id);
        $coin = $team->coin;

        //Ambil array dari cart
        $cart = $request->get('cart');
        $total = $cart[0]['total'];
        $material_id = 0;
        $quantity = 0;

        //Check secara berulang apakah material yang dicari ada atau tidak
        for ($i = 0; $i < count($cart); $i++) {
            $material_id = $cart[$i]['id'];
            $quantity = $cart[$i]['qty'];
            $exists = $team->materials()->where('materials_id', $material_id)->first();
            if ($exists != null) {
                //Update
                $amount = $exists->pivot->amount;
                $team->materials()->updateExistingPivot($material_id, array('amount' => $amount + $quantity));
            } else {
                //Insert
                $team->materials()->attach($material_id, ['amount' => $quantity]);
            }

            //Ambil class Material sesuai dengan ID 
            $material = Material::find($material_id);
            $material->timestamps = false;

            //Buat variabel
            $stock = $material->stock;
            $beginning_stock = $material->beginning_stock;
            $price = $material->price;
            $max_price = $material->max_price;

            //Stok material yang sudah berkurang
            $stockNow = $stock - $quantity;

            //Jika stok sudah berkurang sebanyak 10%
            if ($beginning_stock - round(($beginning_stock * 0.1)) == $stockNow) {
                //Ubah stok awal menjadi stok sekarang
                $material->beginning_stock = $stockNow;
                $material->stock = $stockNow;

                //Ubah harga
                $price += $price * 0.1;
                //Kalau harga sudah maksimal
                if ($max_price == $price) {
                    //Jadikan harga skrg == harga maks
                    $price = $max_price;
                }
                $material->price = $price;
            }
            //Simpan
            $material->save();
        }

        //Pengurangan koin
        if ($coin >= $total) {
            $totalCoinsNow = $coin - $total;
            $team->coin = $totalCoinsNow;
            $team->timestamps = false;
        } else {
            $team->coin = 0;
        }

        //Ubah material shopping ke 1
        $team->material_shopping = 1;

        //Simpan
        $team->save();
        
        return response()->json(array(
            'message' => 'Transaksi berhasil!',
        ), 200);
    }
}
