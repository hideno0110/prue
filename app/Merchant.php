<?php

namespace App;

use Auth;
use App\Admin;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
  protected $fillable = [
    'name',
    'tel',
    'mail',
    'postal_code',
    'prefecture',
    'city',
    'address',
    'address2',
    'is_active',
  
  ];

  public function admins() 
  {
      return $this->hasMany('App\Admin');
  }

  public function shop_lists() 
  {
      return $this->hasMany('App\ShopLists');
  }
  public function inventories() 
  {
      return $this->hasMany('App\Inventory');
  }
  public function photo() 
  {
      return $this->belongsTo('App\Photo');
  }

  public function item_masters() 
  {
      return $this->hasMany('App\ItemMaster');
  }

  public static function merchantUserCheck() 
  {
      $admin_id = Auth::guard('admin')->user()->id;
      $merchant_id = admin::find($admin_id)->merchant_id;

      return $merchant_id;
  }

  public static function merchantName()
  {
      $admin_id = Auth::guard('admin')->user()->id;
      $merchant_name = admin::find($admin_id)->merchant->name;

      return $merchant_name;
  
  }

}
