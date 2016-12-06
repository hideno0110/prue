<?php

namespace App;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','is_active','photo_id','merchant_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }

    public function merchant() {
        return $this->belongsTo('App\Merchant');
    }
    
    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function isAdmin() {
       if($this->role->name == "administrator") {
           return true;
       }
       return false;
    }

    public function inventory() {
        return $this->hasMany('App\Inventory');
    }

    public function rss_urls() {
      return $this->hasMany('App\RssUrl');
    }

    public function routeNotificationForSlack()
    {
      return env('SLACK_WEBFOOK','slackurl');
    }

}
