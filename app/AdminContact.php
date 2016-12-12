<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminContact extends Model
{

  protected  $fillable = [
      'merchant_id',
      'admin_id',
      'name',
      'email',
      'subject',
      'content', 

  ];

  public function admin() 
  {
      return $this->belongsTo('App\Admin');
  }

}
