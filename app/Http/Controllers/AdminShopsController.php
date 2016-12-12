<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopsCreateRequest;
use Illuminate\Http\Request;
use App\Shop;
use App\ShopList;
use Auth;
use App\Admin;
use App\Http\Requests;
use App\Merchant;
use DB;
use Illuminate\Support\Facades\Input;

class AdminShopsController extends Controller
{

    public function __construct()
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }

    public function index(Shop $shop)
    {
        $shop_name = Input::get('shop_name');
        $shop_branch_name = Input::get('shop_branch_name');
        $prefecture = Input::get('prefecture');
        $buy_date = Input::get('buy_date');

        //ログインしているユーザのmerchant_idを取得
        $admin_id = Auth::guard('admin')->user()->id;
        $merchant_id = admin::find($admin_id)->merchant_id;
        
        $shops = $shop
            ->select('shops.id', 'shop_lists.shop_name','shops.shop_branch_name','shops.postal_code','shops.prefecture','shops.city','shops.address','shops.address2','shops.is_active','shops.created_at')
            ->join('shop_lists', 'shops.shop_list_id', '=', 'shop_lists.id')
            ->where('shops.is_active', '1')
            ->where('shop_lists.merchant_id', $merchant_id)
            ->paginate(20);
        
        
        $shop_list = ShopList::where('merchant_id', $merchant_id)->pluck('shop_name','id')->all();

        $compacted = compact(
          'shops',
          'shop_list',
          'shop_branch_name',
          'shop_name',
          'prefecture',
          'counts',
          'buy_date'
        );

        return view('admin.shops.index',$compacted);
    }

    public function create()
    {
        return view('admin.shops.create');
    }

    public function store(ShopsCreateRequest $request) {
        try {
            Shop::create($request->all());
          } catch (Exception $e) {
            return Redirect::back();
          }

        return redirect('/admin/shops')->with('flash_message',trans('adminlte_lang::message.created_msg'));
    }

    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        $shop_list = ShopList::pluck('shop_name','id')->all();
        
        $merchant_id = Merchant::merchantUserCheck(); 

        $inventories = DB::select("
                 select id,sku,name,buy_date from inventories 
                  where shop_id = $id and merchant_id = $merchant_id
                 ");

        return view('admin.shops.edit', compact('shop','shop_list','inventories'));
    }

    public function update(ShopsCreateRequest $request, $id)
    {
        $shop = Shop::findOrFail($id);

        try {
            $shop->update($request->all());

        } catch (Exception $e) {
            return Redirect::back();
        }

        if (Input::get('list')){
            return redirect('/admin/shops')->with('flash_message',trans('adminlte_lang::message.updated_msg'));

        }elseif (Input::get('edit')){
            return redirect('/admin/shops/'.$id.'/edit')->with('flash_message',trans('adminlte_lang::message.updated_msg'));
        }
    }

    public function destroy($id)
    {
        try {
            Shop::findOrFail($id)->delete();

        } catch (Exception $e) {
            return Redirect::back();
        }
    
        return redirect('/admin/shops')->with('flash_message',trans('adminlte_lang::message.deleted_msg'));
    }
}
