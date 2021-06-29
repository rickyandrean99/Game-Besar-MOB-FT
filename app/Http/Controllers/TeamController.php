<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use DB;

class TeamController extends Controller
{
    // [RICKY] Reload halaman dashboard peserta
    public function dashboard() {
        $id_team = 1;
        $equipment_list = DB::select(DB::raw("SELECT e.id AS id_equipment, e.name AS nama_equipment, coalesce(et.amount, '0') AS jumlah_equipment, e.equipment_types_id AS tipe_equipment FROM equipments AS e LEFT JOIN (SELECT * FROM equipment_team WHERE teams_id = $id_team) AS et ON e.id = et.equipments_id WHERE e.id NOT IN (1,2,3)ORDER BY id_equipment"));
        
        return view('peserta.dashboard', [
            'equipments' => $equipment_list
        ]);
    }

    // [RICKY] Mendapatkan list material yang dibutuhkan saat click crafting
    public function getEquipmentRequirement(Request $request) {
        $equipment_requirement = DB::table('equipment_requirement')->join('materials', 'equipment_requirement.materials_id', '=', 'materials.id')->where('equipment_requirement.equipments_id', $request->get('id_equipment'))->select('materials.name AS nama_material', 'equipment_requirement.amount_need AS jumlah_material')->get();
        
        return response()->json(array(
            'equipment_requirement' => $equipment_requirement
        ), 200);
    }

    // [RICKY] Crafting equipment berdasarkan material yang dimiliki
    public function craftingEquipment(Request $request) {
        $id_team = 1;
        $id_equipment = $request->get('id_equipment');
        $amount = $request->get('amount');

        $equipment_requirement = DB::table('equipment_requirement')->where('equipments_id', $id_equipment)->get();

        // [RICKY] Lakukan pengecekan apakah material yang dimiliki mencukupi
        foreach ($equipment_requirement as $er) {
            $material_team = DB::table('material_team')->where('teams_id', 1)->where('materials_id', $er->materials_id)->get();
            if (count($material_team) > 0) {
                if ($material_team[0]->amount >= ($er->amount_need * $amount)) {
                    $crafting_result = true; 
                } else {
                    $crafting_result = false;
                    break;
                }
            } else {
                $crafting_result = false;
                break;
            }
        }
        
        if ($crafting_result) {
            // [RICKY] Lakukan pengurangan material yang dimiliki apabila persyaratan tercukupi
            foreach ($equipment_requirement as $er) {
                $kurangi_material_team = DB::table('material_team')->where('teams_id', 1)->where('materials_id', $er->materials_id)->decrement('amount', $er->amount_need * $amount);
            }

            // [RICKY] Menambah equipment yang di crafting
            $check_equipment = DB::table('equipment_team')->where('teams_id', $id_team)->where('equipments_id', $id_equipment)->get();
            if (count($check_equipment) > 0) {
                $update_equipment = DB::table('equipment_team')->where('teams_id', $id_team)->where('equipments_id', $id_equipment)->increment('amount', $amount);
            } else {
                $insert_equipment = DB::table('equipment_team')->where('teams_id', $id_team)->where('equipments_id', $id_equipment)->insert([
                    'equipments_id'=> $id_equipment,
                    'teams_id'=> $id_team,
                    'amount'=> $amount
                ]);
            }
        }
        
        return response()->json(array(
            'crafting_result' => $crafting_result
        ), 200);
    }

    // [RICKY] Use equipment yang dimiliki
    public function useEquipment(Request $request) {
        $id_team = 1;
        $id_equipment = $request->get('id_equipment');

        // TO DO HERE

        if ($use_access) {
            $update_equipment = DB::table('equipment_team')->where('equipments_id', $id_equipment)->where('teams_id', $id_team)->decrement('amount', 1);
        }
        
        $amount_equipment = DB::table('equipment_team')->where('equipments_id', $id_equipment)->where('teams_id', $id_team)->get();

        return response()->json(array(
            'use_result' => $use_access,
            'amount_now' => $amount_equipment[0]->amount
        ), 200);
    }
}
