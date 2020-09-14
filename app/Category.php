<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = ['name', 'description', 'photo_link'];

  public function products () {
    return $this->hasMany('App\Product');
  }
}
