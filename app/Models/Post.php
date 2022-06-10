<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id', 'title', 'content', 'image', 'slug'
    ];

    // nome della public function -> nome modello
    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }
}
