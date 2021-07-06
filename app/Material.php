<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //[KENNETH] Hubungan many-to-many antara Team dengan Material.
    public function teams(){
        return $this->belongsToMany(Team::class, 'material_team', 'materials_id', 'teams_id')->withPivot('amount');
    }
}