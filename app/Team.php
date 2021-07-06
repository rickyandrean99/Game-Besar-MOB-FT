<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //[KENNETH] Hubungan many-to-many antara Team dengan Material.
    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_team', 'teams_id', 'materials_id')->withPivot('amount');
    }
}
