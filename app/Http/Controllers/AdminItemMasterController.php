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
use Peron\AmazonMws\AmazonProductList;

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

        return view('admin.items.index',compact('items'));

//    $items = ItemMaster::where('id', '>=',3129 )->where('id', '<=',3171 )->get();
//    foreach($items as $item){
//        Self::get_item_master_info($item);
//    }
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

    function get_item_master_info($item)
    {
        //amazon APIにてamazonデータを取得し格納する
        if(($item->asin != ''|| $item->jan_code != '')  ){
            try {
                $obj = new AmazonProductList("myStore"); //store name matches the array key in the config file
                $obj->setIdTYpe("ASIN","JAN"); //tells the object to automatically use tokens right away
                if($item->asin != '') {
                    $obj->setProductIds($item->asin); //tells the object to automatically use tokens right away
                } else {
                    $obj->setProductIds($item->jan_code); //tells the object to automatically use tokens right away
                }
                $item_detail = $obj->fetchProductList(); //this is what actually sends the request
                if(isset($item_detail->GetMatchingProductForIdResult->Error->Code)) {
                    // dont save
                } else {
                    $item->name = $item_detail->GetMatchingProductForIdResult->Products->Product->AttributeSets->ItemAttributes->Title;
                    $item->category = $item_detail->GetMatchingProductForIdResult->Products->Product->SalesRankings->SalesRank->ProductCategoryId[0];
                    $item->rank = $item_detail->GetMatchingProductForIdResult->Products->Product->SalesRankings->SalesRank->Rank[0];
                    $item->file = $item_detail->GetMatchingProductForIdResult->Products->Product->AttributeSets->ItemAttributes->SmallImage->URL;
                    $item->item_detail = $item_detail->GetMatchingProductForIdResult->Products->Product->AttributeSets->ItemAttributes->Feature[0];

                    //ssl用にURLを変換
                    $url = 'https://d1ge0kk1l5kms0.cloudfront.net';
                    $html_code = $item->file;

                    $html_code = preg_replace("/http:\/\/ecx.images-amazon.com/", $url, $html_code);
                    $item->file = preg_replace("_SL75_", "_SL300_", $html_code);
                    $item->save();
                }

            } catch (Exception $ex) {
                echo 'There was a problem with the Amazon library. Error: '.$ex->getMessage();
            }
        }
    }


}
