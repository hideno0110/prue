<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{

  protected $fillable = [
      'name',
      'type'
  ];

  public function inventory()
  {
      return $this->hasMany('App\Inventory');
  }
}
