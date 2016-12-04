<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{

  protected $fillable = [
    'item_code',
    'asin',
    'name',
    'item_detail',
    'category',
    'rank',
    'file',
    'merchant_id'

  ];

  public function inventories() {

    return $this->hasMany('App\Inventory');
  }

  public function merchant() {

    return $this->belongsTo('App\merchant');
  }

}
