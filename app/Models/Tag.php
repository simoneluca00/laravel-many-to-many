<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // many to many
    // nome della public function -> nome entità
    public function posts(){
        return $this->belongsToMany('App\Models\Post');
    }
}
