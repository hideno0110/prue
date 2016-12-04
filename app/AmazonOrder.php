<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmazonOrder extends Model
{
  protected $fillable = [

    'amz_order_id',
    'purchase_date',
    'status'
  ];

  public function amazonOrder() {

      return $this->hasMany('App\AmazonOrderItem');
  }
}
