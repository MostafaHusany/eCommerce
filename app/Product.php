<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['catgorie_id', 'name', 'description', 'photo_link'];

    public function categorie () {
      return $this->belongTo('App\Category');
    }
}
