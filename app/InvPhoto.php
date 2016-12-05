<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvPhoto extends Model
{
    protected $uploads ='/images/inv/';

    protected $fillable = ['file',
        'type',
        'inventory_id',
        'number',

    ];


    public function getFileAttribute($photo) {
        return $this->uploads . $photo;
    }

   public function inventory() {
       return $this->belongsTo('App\Inventory');
   }

}
