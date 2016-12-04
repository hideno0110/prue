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
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $admin_id = Auth::guard('admin')->user()->id;

      $items_lists = RssNews::where('admin_id', $admin_id )->orderBy('date', 'desc')->get();
   
      return view('admin.rss.index',compact('items_lists'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $rss = new RssUrl();
          $rss->url = $request['url'];
          $rss->admin_id = Auth::guard('admin')->user()->id;
          $rss->save();
        
        return redirect('/admin/rss-read')->with('flash_message',trans('adminlte_lang::message.created_msg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
