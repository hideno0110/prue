<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssNews extends Model
{
    protected $fillable = [
        'admin_id',
        'site',
        'title',
        'date',
        'link'
    ];


    public function get_rss_lists($admin_id, $num) 
    {
        $rss_lists = RssNews::where('admin_id',$admin_id)->take($num)->get();
        return $rss_lists;
    } 
}
