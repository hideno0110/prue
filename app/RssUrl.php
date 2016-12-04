<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssUrl extends Model
{

  protected $fillable = [
    'admin_id',
    'url'
  ];
  
  
  public function admin() {
    return $this->belongsTo('App\Admin');
  }
}
