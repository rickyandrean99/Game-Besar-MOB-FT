<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public function teams(){
        return $this->belongsToMany('App\Team', 'teams_id', 'id');
    }
}