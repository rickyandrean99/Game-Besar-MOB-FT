<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function materials(){
        return $this->belongsToMany('App\Material', 'materials_id', 'id');
    }
}
