<?php

namespace App\Http\Controllers;

use App\Events\BuyMaterial;
use Illuminate\Http\Request;
use App\Material;
use App\Team;
use DB;

class ShopController extends Controller
{
    public function index()
    {
        $this->authorize('admin-shop');
        return view('admin.shop', ["material" => Material::all(), "team" => Team::where('material_shopping', 0)->get()]);
    }

    public function insertOrUpdate(Request $request, Team $team)
    {
        $this->authorize('admin-shop');

        //Cari ID Team yang sesuai & ambil array Cart dari Requests
        $id = $request->get('teams_id');
        $team = Team::find($id);
        $coin = $team->coin;

        //Ambil array dari cart
        $cart = $request->get('cart');
        $total = $cart[0]['total'];
        $material_id = 0;
        $quantity = 0;

        //Buat array untuk mengirimkan material yang gagal dibeli.
        $failToBuy = [];
        $notBuyEverything = [];

        //Check secara berulang apakah material yang dicari ada atau tidak
        for ($i = 0; $i < count($cart); $i++) {
            $material_id = $cart[$i]['id'];

            //Ambil class Material sesuai dengan ID 
            $material = Material::find($material_id);
            $name = $material->name;
            $material->timestamps = false;
            $stock = (int)$material->stock;
            $beginning_stock = $material->beginning_stock;
            $price = $material->price;
            $max_price = $material->max_price;

            $quantity = (int)$cart[$i]['qty'];
            $subtotal = $quantity * $price;
            $exists = $team->materials()->where('materials_id', $material_id)->first();

            if ($exists != null) {
                //Jika stok berjumlah 0 
                if ($stock == 0) {
                    array_push($failToBuy, $name);
                    $total -= $subtotal;
                }
                //Jika stok kurang dari jumlah yang dibeli
                else if ($quantity > $stock) {
                    //Tambah dengan stoknya aja
                    $amount = $exists->pivot->amount;
                    $team->materials()->updateExistingPivot($material_id, array('amount' => $amount + $stock));
                    array_push($failToBuy, $name);
                    $stock = 0;
                }
                //Update normal
                else {
                    $amount = $exists->pivot->amount;
                    $team->materials()->updateExistingPivot($material_id, array('amount' => $amount + $quantity));
                    $stock -= $quantity;
                }
            } else {
                //Jika stok berjumlah 0 
                if ($stock == 0) {
                    array_push($failToBuy, $name);
                    $total -= $subtotal;
                }
                //Jika stok kurang dari jumlah yang dibeli
                else if ($quantity > $stock) {
                    $team->materials()->attach($material_id, ['amount' => $stock]);
                    array_push($failToBuy, $name);
                    $stock = 0;
                }
                //Insert normal
                else {
                    $team->materials()->attach($material_id, ['amount' => $quantity]);
                    $stock -= $quantity;
                }
            }

            //Jika stok sudah berkurang sebanyak 10%
            if ($beginning_stock - round(($beginning_stock * 0.1)) >= $stock) {
                //Ubah stok awal menjadi stok sekarang
                $material->beginning_stock = $stock;
                $material->stock = $stock;

                //Ubah harga
                $price += ($price * 0.1);
                //Kalau harga sudah maksimal
                if ($max_price <= $price) {
                    //Jadikan harga skrg == harga maks
                    $price = $max_price;
                }
                $material->price = $price;
            } else {
                //Simpan material
                $material->stock = $stock;
            }

            $material->save();
        }

        //Pengurangan koin
        if ($coin >= $total) {
            $totalCoinsNow = $coin - $total;
            $team->coin = $totalCoinsNow;
            $team->timestamps = false;
            broadcast(new BuyMaterial($id, $cart, "Tim berhasil membeli material", $totalCoinsNow))->toOthers();
        } else if ($coin < $total) {
            $team->coin = 0;
            broadcast(new BuyMaterial($id, $cart, "Tim berhasil membeli material", 0))->toOthers();
        }

        //Ubah material shopping ke 1
        $team->material_shopping = 1;

        //Simpan
        $team->save();

        // Tambah history
        $insert_history = DB::table('histories')->insert([
            'teams_id' => $id,
            'name' => 'Berhasil membeli material',
            'type' => 'buy-material'
        ]);

        if (empty($failToBuy)) {
            return response()->json(array(
                'message' => 'Yay, transaksi berhasil!'
            ), 200);
        } else {
            return response()->json(array(
                'message' => 'Transaksi berhasil, namun ada beberapa material yang gagal ditambahkan/diupdate atau jumlah tidak ditambahkan/diupdate sesuai karena stok habis.'
            ), 200);
        }
    }
}
