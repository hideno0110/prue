<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvStock extends Model
{
  protected $fillable = [
    'stock'
  ];


  public function inventory() {
    return $this->hasMany('App\Inventory');
  }




}
