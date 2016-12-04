<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvStock extends Model
{
  protected $fillable = [
    'inventory_id',
    'stock'
  ];
  
  public function inventory() {
    return $this->belongsTo('App\Inventory');
  }




}
