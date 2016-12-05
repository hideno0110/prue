<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopMap extends Model
{
  protected $fillable = [
    'shop',
    'shop_category',
    'shop_branch',
    'postal_code',
    'prefecture',
    'address1',
    'address2',
    'tel',
    'url',
    'time',
  ];
}
