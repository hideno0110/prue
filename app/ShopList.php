<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ShopList extends Model
{
    use  Sortable;
    
    protected $fillable = ['shop_name',
			'is_active'     	
		];

    protected $sortable = [
        'id',
        'shop_name',
        'is_active'
    ];


    public function merchant() {
      return $this->belongsTo('App\Merchant');
    }

    public function shops() {
      return $this->hasMany('App\Shop');
    }

    public function shop_list_count() {
      $shop_list_count = ShopList::where('is_active', 1)->count();
      return $shop_list_count;
    }

}
