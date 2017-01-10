<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemMaster;
use App\Merchant;
use App\Inventory;
use Auth;
use DB;
use App\Http\Requests\ItemCreateRequest;
use Illuminate\Support\Facades\Input;

class AdminItemMasterController extends Controller
{
    public function __construct()
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $merchant_id = Merchant::merchantUserCheck();
        $items = ItemMaster::
          // join('inventories', 'item_masters.id', '=', 'inventories.item_master_id')
          where('merchant_id',$merchant_id)
          ->orderBy('id','desc')
          ->get();

        // dd($items);
        // foreach($items as $item) {
        //   if($item->inventories){
        //     var_dump(count($item->inventories->name));
        //   }
        // }

        return view('admin.items.index',compact('items'));
    }

    public function create()
    {
        return view('admin.items.create');
    }
    
    public function store(ItemCreateRequest $request)
    {
        //フォームから新規商品入力値を取得
        $input = $request->all();

        try {
          //トランザクション開始
          DB::beginTransaction();
          
          //merchant_idを取得
          $input['merchant_id'] = Merchant::merchantUserCheck();
          
          ItemMaster::create($input);

          //コミット
          DB::commit();
        } catch (Exception $e) {
          DB::rollBack();
          return Redirect::back();
        }
        
        return redirect('/admin/items');
    }

    public function edit($id)
    {
        $merchant_id = Merchant::merchantUserCheck();
        $item_merchant_id = ItemMaster::findOrFail($id)->merchant_id;
        
        if($merchant_id == $item_merchant_id) {
            $item = ItemMaster::findOrFail($id);
            $url = 'https://d1ge0kk1l5kms0.cloudfront.net';
            $html_code = $item->file;
            $item->file = preg_replace("/http:\/\/ecx.images-amazon.com/", $url, $html_code);
            return view('admin.items.edit',compact('item'));
        } else {
            return view('admin.errors.404'); 
        }  
    }

    public function update(ItemCreateRequest  $request, $id)
    {
        $input = $request->all();

        try {
            ItemMaster::findOrFail($id)->update($input); 
        } catch (Exception $e) {
            return Redirect::back();
        }
    
    
        if (Input::get('list')) {
            return redirect('/admin/items')->with('flash_message',trans('adminlte_lang::message.updated_msg'));
        } elseif (Input::get('edit')) {
            return redirect('/admin/items/'.$id.'/edit')->with('flash_message',trans('adminlte_lang::message.updated_msg'));
        }
    }

    public function destroy($id)
    {
        $item = ItemMaster::findOrFail($id);
        $item->delete();

        return redirect('/admin/items')->with('flash_message',trans('adminlte_lang::message.updated_msg'));
    }
}
