<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

  protected $fillable = [
    'inventory_id',
    'amount'
  ];

  public function inventory() {
    return $this->belongsTo('App\Inventory');
  }

}
