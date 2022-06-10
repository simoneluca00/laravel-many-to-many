<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id', 'title', 'content', 'image', 'slug'
    ];

    // one to many
    // nome della public function -> nome modello
    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }

    // many to many
    // nome della public function -> nome entità
    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
}
