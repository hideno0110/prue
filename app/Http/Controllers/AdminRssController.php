<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RssUrl;
use App\RssNews;
use Auth;
use DB;

class AdminRssController extends Controller 
{    
  
    public function __construct() 
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }

    public function index() 
    {
        $admin_id = Auth::guard('admin')->user()->id;

        $items_lists = RssNews::where('admin_id', $admin_id )->orderBy('date', 'desc')->get();
   
        return view('admin.rss.index',compact('items_lists'));

    }

    public function store(Request $request)
    {
        $rss = new RssUrl();
        $rss->url = $request['url'];
        $rss->admin_id = Auth::guard('admin')->user()->id;
        $rss->save();
        
        return redirect('/admin/rss-read')->with('flash_message',trans('adminlte_lang::message.created_msg'));
    }
}
