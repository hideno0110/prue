<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Shop extends Model
{
    use  Sortable;
    
    protected $fillable = [
      'shop_branch_name',
      'shop_list_id',
      'postal_code',
      'prefecture',
      'city',
      'address',
      'address2',
		  'is_active',       	
		];

    protected $sortable = [
      'id',
      // 'shop_name',
      'shop_branch_name',
      'city',
      'address',
      'is_active',
      'created_at'
    ];

    public function shop_list() {
      return $this->belongsTo('App\ShopList');
    }

    public function inventory() {
      return $this->hasMany('App\Inventory');
    }

    public function shop_count() {
      $shops = Shop::where('is_active', 1)->count();
      return $shops;
    }
}
