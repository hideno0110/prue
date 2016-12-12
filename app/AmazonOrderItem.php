<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmazonOrderItem extends Model
{
  protected $fillable = [
      'amazon_order_table_id',
      'sku',
      'item_name',
      'amount',
      'price'
  ];
  
  public function amazonOrder()
  {
      return $this->belongsTo('App\AmazonOrder');
  }
}
