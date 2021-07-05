<?php

namespace App\Http\Controllers;

use App\Material;
use App\Team;
use Illuminate\Http\Request;
use DB;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.toko', ["material" => Material::all(), "team" => Team::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {

        //Perintah SQL buat ambil data sesuai ID team & ID material
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }

    public function buymaterial(Request $request){
        $team_id = $request->get('team_id');
        $cart = $request->get('cart');

        $nama_material = "";
        $quantity = 0;
        $material_id =0;
        $total = $cart[0]['total'];
        for ($i=0; $i < count($cart); $i++) { 
            $material_id= $cart[$i]['id'];
            $material_check = DB::table('material_team')
            ->join('materials', 'material_team.materials_id', '=', 'materials.id')
            ->join('teams', 'material_team.teams_id', '=', 'teams.id' )
            ->where('teams_id', $team_id)
            ->where('materials_id', $material_id)
            ->get();
            $quantity = $cart[$i]['qty'];
            //Kalau datanya sdh ada
            if(count($material_check) > 0){
                //Update material_team
                $update_material = DB::table('material_team')->where('teams_id', $team_id)->where('materials_id', $material_id)->increment('amount', $quantity);
            }
            else{
                //Insert material_team
                $update_material = DB::table('material_team')->insert([
                    'teams_id' => $team_id, 
                    'materials_id' => $material_id, 
                    'amount'=> $quantity
                ]);
            }
        }
        //Kurangi coin team
        $update_coin_team = DB::table('teams')->where('id', $team_id)->decrement('coin', $total);
        
            return response()->json(array(
                'cart' => 'sukses!',
                // 'message' => $message,
                // 'material_update' => $material_update
            ), 200);
        
       


        // Pengecekan jika ada data yang sesuai, maka tinggal update
        
    }
}
