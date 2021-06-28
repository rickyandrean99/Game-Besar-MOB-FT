<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use DB;

class TeamController extends Controller
{
    // [RICKY] Reload halaman dashboard peserta
    public function dashboard() {
        $equipment_list = DB::select(DB::raw("SELECT e.id AS id_equipment, e.name AS nama_equipment, coalesce(et.amount, '0') AS jumlah_equipment FROM equipments AS e LEFT JOIN (SELECT * FROM equipment_team WHERE teams_id = 1) AS et ON e.id = et.equipments_id ORDER BY id_equipment"));
        
        return view('peserta.dashboard', [
            'equipments' => $equipment_list
        ]);
    }

    public function getEquipmentRequirement(Request $request) {
        $equipment_requirement = DB::table('equipment_requirement')->join('materials', 'equipment_requirement.materials_id', '=', 'materials.id')->where('equipment_requirement.equipments_id', $request->get('id_equipment'))->select('materials.name AS nama_material', 'equipment_requirement.amount_need AS jumlah_material')->get();
        
        return response()->json(array(
            'equipment_requirement' => $equipment_requirement
        ), 200);
    }
}
