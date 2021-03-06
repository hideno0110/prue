<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InventoriesCreateRequest;
use App\Http\Requests;
use App\Inventory;
use App\Admin;
use App\Shop;
use App\ShopList;
use App\Payment;
use App\Condition;
use App\SalePlace;
use App\Photo;
use App\InvPhoto;
use App\InvStock;
use App\ItemMaster;
use App\Merchant;
use Auth;
use DB;
use peron\amazonmws\amazonorderlist;
use peron\amazonmws\amazoninventorylist;
use Peron\AmazonMws\AmazonProductList;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class AdminInventoriesController extends Controller
{

    public function __construct()
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //店舗IDを取得
        $merchant_id = Merchant::merchantUserCheck();

        //検索でクリアを押した場合 
        $clear = Input::get('clear');
        if ($clear == 'clear') {
            return redirect('/admin/inventories');
        }

        //検索の値を取得
        $asin = Input::get('asin');
        $sku = Input::get('sku');
        $name = Input::get('name');
        $condition_ids = Input::get('condition_id');
        $sale_place_ids = Input::get('sale_place_id');
        $description = Input::get('description');
        $shopname = Input::get('shopname');
        $buy_date = Input::get('buy_date');
        $free = Input::get('free');
        $memo = Input::get('memo');

        //Inventoryのインスタン化、queryメソッド
        $query = Inventory::query();

        //もしasinがあれば
        if (!empty($asin)) {
            $query->where('asin', 'like', '%' . $asin . '%');
        }
        //もしsku,sku2があれば
        if (!empty($sku)) {
            $query->Where('sku', 'like', '%' . $sku . '%')->orWhere('sku2', 'like', '%' . $sku . '%');
        }
        //もしnameがあれば
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        // //もしshopnameがあれば
        if (!empty($shopname)) {
            $query->where('shop_name', 'like', '%' . $shopname . '%')
                ->orWhere('shop_branch_name', 'like', '%' . $shopname . '%')
                ->leftJoin('shops', 'inventories.shop_id', '=', 'shops.id')
                ->leftJoin('shop_lists', 'shops.shop_list_id', '=', 'shop_lists.id');
        }
        //もしbuydateがあれば
        if (!empty($buy_date)) {
            $query->where('buy_date', 'like', '%' . $buy_date . '%');
        }
        //もしdescriptionがあれば
        if (!empty($description)) {
            $query->where('description', 'like', '%' . $description . '%');
        }
        //もしmemoがあれば
        if (!empty($memo)) {
            $query->where('memo', 'like', '%' . $memo . '%');
        }
        //もしfreeがあれば
        if (!empty($free)) {
            $query->where('free', 'like', '%' . $free . '%');
        }
        //もしsale_placeがあれば
        if (!empty($sale_place_ids)) {
            if (!reset($sale_place_ids) == "") {
                foreach ($sale_place_ids as $sale_place_id) {
                    if ($sale_place_id === reset($sale_place_ids)) {
                        $query->where('sale_place_id', '=', $sale_place_id);
                    } else {
                        $query->orWhere('sale_place_id', '=', $sale_place_id);
                    }
                }
            }
        }
        //もしconditionがあれば
        if (!empty($condition_ids)) {
            if (!reset($condition_ids) == "") {
                foreach ($condition_ids as $condition_id) {
                    if ($condition_id === reset($condition_ids)) {
                        $query->where('condition_id', '=', $condition_id);
                    } else {
                        $query->orWhere('condition_id', '=', $condition_id);
                    }
                }
            }
        }

        //検索結果を取得
        $inventories = $query
            ->sortable()
            ->where('merchant_id', $merchant_id)
            ->orderBy('inventories.id', 'desc')
            ->paginate(100);

        //結果数（検索結果数）を取得 
        $count_inv = $inventories->count();


        //検索用
        $payment = Payment::pluck('name', 'id')->all();
        $condition = Condition::pluck('name', 'type')->all();
        $sale_place = SalePlace::pluck('name', 'id')->all();


        //amazon用出荷CSVダウンロード
        if (Input::get('download') == 'inv') {

            $inv = Self::makeinv_csv($query);
            return $inv;
        } elseif (Input::get('download') == 'fba') {
            $fba = Self::makefba_csv($query, $merchant_id);
            return $fba;
        }


        $compacted = compact(
            'inventories',
            'shops',
            'shop_branch',
            'payment',
            'condition',
            'asin',
            'sku',
            'name',
            'shopname',
            'condition_ids',
            'sale_place',
            'buy_date',
            'query',
            'memo',
            'description',
            'count_inv',
            'sale_place_ids',
            'free'
        );

        return view('admin.inventory.index', $compacted);
    }

    public function create()
    {
        //merchant_idを取得
        $merchant_id = Merchant::merchantUserCheck();

        //リスト表示用
        $payment = Payment::pluck('name', 'id')->all();
        $condition = Condition::pluck('name', 'id')->all();
        $sale_place = SalePlace::pluck('name', 'id')->all();

        $shop_list = ShopList::where('merchant_id', $merchant_id)->where('is_active', 1)->orderBy('shop_name')->get();
        $shop_branch_list = Shop::where('is_active', 1)->orderBy('shop_branch_name')->get();

        $shops_objs = DB::select('select 
                        shops.id as id, 
                        CONCAT(shop_lists.shop_name,shops.shop_branch_name) as shop 
                        from shops 
                        left join shop_lists on shops.shop_list_id = shop_lists.id 
                        where shop_lists.merchant_id =' . $merchant_id . '
                        ORDER BY  shop_lists.shop_name ASC');


        $shops = array();
        foreach ($shops_objs as $shops_obj) {
            $shops[$shops_obj->id] = $shops_obj->shop;
        }

        $compacted = compact(
            'shop_branch_list',
            'shop_list',

            'shops',
            'shop_lists',
            'payment',
            'condition',
            'sale_place'
        );

        return view('admin.inventory.create', $compacted);
    }

    public function store(InventoriesCreateRequest $request)
    {
        //新規商品登録の際に、商品マスタがない場合、amazonよりデータの取得を行う。
        //取得に失敗する可能性もあるので、transactionの外に置く
        $amazon_get_flg = 0;
        $item = '';

        //フォームから新規商品入力値を取得
        $input = $request->all();

        // trim
        $input["asin"] = trim($input["asin"]);
        $input["jan_code"] = trim($input["jan_code"]);
        $input["item_code"] = trim($input["item_code"]);

        if ($input["item_master_id"] != "") {
            if (ItemMaster::find($input["item_master_id"])) {
                // ok
            } else {
                return redirect()->back()->with('error_message', 'error item_message');
            }
        }


        try {
            //トランザクション開始
            DB::beginTransaction();

            //更新者のidを取得
            $input['update_admin_id'] = Auth::guard('admin')->user()->id;
            //merchant_idを取得
            $input['merchant_id'] = Merchant::merchantUserCheck();

            //新規商品をDBに登録
            $inventory = Inventory::create($input);

            //ItemMasterに登録済みか確認し、ない場合は作成後、item_master_idを取得
            $inventory->item_master_id = Self::get_item_master($inventory, 1);
            //SKU（商品番号）を作成
            //SKU = Item_masterID + condition + (usedの場合No.)
            if ($inventory->condition->type == 11) {
                $inventory->sku = $inventory->item_master_id . '-' . $inventory->condition->type;
            } else { //used item
                $inventory->sku = $inventory->item_master_id . '-' . $inventory->condition->type . '-' . $inventory->id;
            }

            //SKU,item_master_idを追加更新
            $inventory->save();

            //画像を追加
            $files = $request->file('photos');
            //配列の中身確認用のjudge変数　http://qiita.com/wonda/items/b4a425edd73880a13e62
            //$judge = array_filter($files);
            if (!empty($files)) {
                $i = 1;
                foreach ($files as $file) {
                    $name = time() . $file->getClientOriginalName();
                    // $file->move('images/inv/'.$inventory->id.'/',$name);
                    $file->move('images/inv/', $name);
                    $photo = InvPhoto::create(['file' => $name,
                        'type' => 1,
                        'inventory_id' => $inventory->id,
                        'number' => $i]);
                    $i++;
                }
            }

            //在庫数を追加する
            $stock = InvStock::where('sku', 'like', '%' . $inventory->sku . '%')->first();
            // var_dump($stock);
            // var_dump($inventory->sku);

            if (isset($stock->id)) {
                $stock->stock += $inventory->number;
                $stock->save();
                $inventory->inv_stock_id = $stock->id;

            } else {
                $stock = new InvStock;
                $stock['stock'] = $inventory->number;
                $stock['sku'] = $inventory->sku;
                $stock->merchant_id = $inventory->merchant_id;
                $stock->save();
                $inventory->inv_stock_id = $stock->id;
            }

            //stock_idを追加更新
            $inventory->save();

            //コミット
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back();
        }

        //amazon APIにてamazonデータを取得し格納する
        if (($inventory->asin != '' || $inventory->jan_code != '') && $item) {
            try {

                eval(\Psy\sh());
                $obj = new AmazonProductList("myStore"); //store name matches the array key in the config file
                $obj->setIdTYpe("ASIN", "JAN"); //tells the object to automatically use tokens right away
                if ($inventory->asin != '') {
                    $obj->setProductIds($item->asin); //tells the object to automatically use tokens right away
                } else {
                    $obj->setProductIds($item->jan_code); //tells the object to automatically use tokens right away
                }
                $item_detail = $obj->fetchProductList(); //this is what actually sends the request
                if (isset($item_detail->GetMatchingProductForIdResult->Error->Code)) {
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
                echo 'There was a problem with the Amazon library. Error: ' . $ex->getMessage();
            }
        }

        if (Input::get('new')) {
            return redirect('/admin/inventories')->with('flash_message', trans('adminlte_lang::message.created_msg'));

        } elseif (Input::get('continue')) {
            return redirect('/admin/inventories/create/')->with('flash_message', trans('adminlte_lang::message.created_msg'));
        }

    }


    public function edit($id)
    {
        $merchant_id = Merchant::merchantUserCheck();
        $inventory_merchant_id = Inventory::findOrFail($id)->merchant_id;

        if ($merchant_id == $inventory_merchant_id) {

            $inventory = Inventory::findOrFail($id);
            $condition = Condition::pluck('name', 'id')->all();
            $payment = Payment::pluck('name', 'id')->all();
            $sale_place = SalePlace::pluck('name', 'id')->all();



            $shop_list = ShopList::where('merchant_id', $merchant_id)->where('is_active', 1)->orderBy('shop_name')->get();
            $shop_branch_list = Shop::where('is_active', 1)->orderBy('shop_branch_name')->get();

            $shops_objs = DB::select('select 
                          shops.id as id, 
                          CONCAT(shop_lists.shop_name,shops.shop_branch_name) as shop 
                          from shops 
                          left join shop_lists on shops.shop_list_id = shop_lists.id  
                          where shop_lists.merchant_id =' . $merchant_id . '
                          ORDER BY shop_lists.shop_name ASC');

            $shops = array();
            foreach ($shops_objs as $shops_obj) {
                $shops[$shops_obj->id] = $shops_obj->shop;
            }
            $invphotos = DB::table('inv_photos')->where('inventory_id', $id)->get();

            $compacted = compact(
                'shop_list',
                'shop_branch_list',
                'inventory',
                'shops',
                'condition',
                'payment',
                'invphotos',
                'sale_place',
                'path'
            );

            return view('admin.inventory.edit', $compacted);
        } else {
            return view('admin.errors.404');
        }
    }


    public function update(InventoriesCreateRequest $request, $id)
    {
        $input = $request->all();

        try {
            //トランザクション開始
            DB::beginTransaction();
            //更新者のidを取得
            $input['update_admin_id'] = Auth::guard('admin')->user()->id;

            //画像を追加
            $files = $request->file('photos');
            //配列の中身確認用のjudge変数　http://qiita.com/wonda/items/b4a425edd73880a13e62
            //$judge = array_filter($files);
            if (!empty($files)) {
                $i = 1;
                foreach ($files as $file) {
                    $name = time() . $file->getClientOriginalName();
                    $file->move('images/inv/', $name);
                    $photo = InvPhoto::create(['file' => $name,
                        'type' => 1,
                        'inventory_id' => $id,
                        'number' => $i]);
                    $i++;
                }
            }

            //Auth::user()->inventory()->whereId($id)->first()->update($input);
            Inventory::whereId($id)->first()->update($input);

            //コミット
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back();
        }

        if (Input::get('list')) {
            return redirect('/admin/inventories')->with('flash_message', trans('adminlte_lang::message.updated_msg'));
        } elseif (Input::get('edit')) {
            return redirect('/admin/inventories/' . $id . '/edit')->with('flash_message', trans('adminlte_lang::message.updated_msg'));
        }
    }


    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        // unlink(public_path() . $inventory->inv_photo->file);
        $inventory->delete();
        return redirect('/admin/inventories')->with('flash_message', trans('adminlte_lang::message.deleted_msg'));
    }


    /**
     * CSVファイル作成
     *
     */
    function makeinv_csv($query)
    {

        //クエリ実行
        $inventories_csv = $query->get();

        //仮ファイルOpen
        $stream = fopen('php://temp', 'w');

        fputcsv($stream, [
            'sku',
            'product-id',
            'product-id-type',
            'optional-payment-type-exclusion',
            'merchant_shipping_group_name', # 201808 new
            'price',
            'standard-price-points',# 201808 new
            'minimum-seller-allowed-price',
            'maximum-seller-allowed-price',
            'item-condition',
            'quantity',
            'add-delete',
            'will-ship-internationally',
            'item-note',
            'fulfillment-center-id',
            'handling-time', # 201808 new ↓
            'batteries_required',
            'are_batteries_included',
            'battery_cell_composition',
            'battery_type',
            'number_of_batteries',
            'battery_weight',
            'number_of_lithium_ion_cells',
            'number_of_lithium_metal_cells',
            'lithium_battery_packaging',
            'lithium_battery_energy_content',
            'lithium_battery_weight',
            'supplier_declared_dg_hz_regulation1',
            'supplier_declared_dg_hz_regulation2',
            'supplier_declared_dg_hz_regulation3',
            'supplier_declared_dg_hz_regulation4',
            'supplier_declared_dg_hz_regulation5',
            'hazmat_united_nations_regulatory_id',
            'safety_data_sheet_url',
            'item_weight',
            'item_volume',
            'flash_point',
            'ghs_classification_class1',
            'ghs_classification_class2',
            'ghs_classification_class3',
            'item_weight_unit_of_measure',
            'item_volume_unit_of_measure',
            'lithium_battery_energy_content_unit_of_measure',
            'lithium_battery_weight_unit_of_measure',
            'battery_weight_unit_of_measure'
        ], "\t");
        //loop

        foreach ($inventories_csv as $inventory) {
            if ($inventory->sku2 !== "" and $inventory->sku2 !== null) {
                $sku = $inventory->sku2;
            } else {
                $sku = $inventory->sku;
            }
            $description = preg_replace('/(?:\n|\r|\r\n)/', '', $inventory->description);

            if ($inventory->batteries_required == 1) {
                $batteries_required = "TRUE";
                $are_batteries_included = "TRUE";
                $battery_cell_composition = "リチウム金属";
                $battery_type = "リチウムイオン";
                $number_of_batteries = 1;
                $battery_weight = 150;
                $number_of_lithium_ion_cells = 4;
                $number_of_lithium_metal_cells = 4;
                $lithium_battery_packaging = "時計本体にセット済み";
                $lithium_battery_energy_content = 2;
                $lithium_battery_weight = 2;


            } else {
                $batteries_required = "FALSE";
                $are_batteries_included = "";
                $battery_cell_composition = "";
                $battery_type = "";
                $number_of_batteries = "";
                $battery_weight = "";
                $number_of_lithium_ion_cells = "";
                $number_of_lithium_metal_cells = "";
                $lithium_battery_packaging = "";
                $lithium_battery_energy_content = "";
                $lithium_battery_weight = "";
            }
            //カラムを選択
            fputcsv($stream, [
                $sku,
                $inventory->asin,
                '1',
                'exclude cod, cvs',
                '',
                $inventory->sell_price,
                '',
                '',
                '',
                $inventory->condition->type,
                $inventory->number,
                'a',
                '11',
                $description,
                'AMAZON_JP',
                '', #handling-time
                $batteries_required, #batteries_required TRUE / FALSE
                $are_batteries_included, #are_batteries_included
                $battery_cell_composition, #battery_cell_composition
                $battery_type, #battery_type
                $number_of_batteries, #number_of_batteries
                $battery_weight,#battery_weight
                $number_of_lithium_ion_cells, #number_of_lithium_ion_cells
                $number_of_lithium_metal_cells,  #number_of_lithium_metal_cells
                $lithium_battery_packaging, #lithium_battery_packaging
                $lithium_battery_energy_content, #lithium_battery_energy_content
                $lithium_battery_weight, #lithium_battery_weight
                '該当なし', #supplier_declared_dg_hz_regulation1
                '', #supplier_declared_dg_hz_regulation2
                '', #supplier_declared_dg_hz_regulation3
                '', #supplier_declared_dg_hz_regulation4
                '', #supplier_declared_dg_hz_regulation5
                '', #hazmat_united_nations_regulatory_id
                '', #safety_data_sheet_url
                '', #item_weight
                '', #item_volume
                '', #flash_point
                '', #ghs_classification_class1
                '', #ghs_classification_class2
                '', #ghs_classification_class3
                '', #item_weight_unit_of_measure
                '', #item_volume_unit_of_measure
                '', #lithium_battery_energy_content_unit_of_measure
                '', #lithium_battery_weight_unit_of_measure
                '' #battery_weight_unit_of_measur
            ], "\t");
            //全カラムの場合はtoArray()を使えば良い
            //fputcsv($stream,$user->toArray());
        }

        //ポインタの先頭へ
        rewind($stream);

        //いろいろ変換
        $csv = mb_convert_encoding(str_replace(PHP_EOL, "\r\n", stream_get_contents($stream)), 'SJIS', 'UTF-8');

        //file名
        $filename = "inv_" . date('Ymd') . ".txt";

        //header
        $headers = array(
            'Content-Type' => 'text/tab-separated-values',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        );
        $inv = Response::make($csv, 200, $headers);

        return $inv;
    }

    /**
     * CSVファイル作成
     *
     */
    function makefba_csv($query, $merchant_id)
    {
        $merchant = Merchant::findOrFail($merchant_id);

        //クエリ実行
        $inventories_csv = $query->get();

        //仮ファイルOpen
        $stream = fopen('php://temp', 'w');

        fputcsv($stream, [
            'PlanName',
            'Plan-fba-' . date("Ymd") . '-id',
        ], "\t");
        fputcsv($stream, [
            'AddressName',
            $merchant->name,
        ], "\t");
        fputcsv($stream, [
            'AddressFieldOne',
            $merchant->address,
        ], "\t");
        fputcsv($stream, [
            'AddressFieldTwo',
            $merchant->address2,
        ], "\t");
        fputcsv($stream, [
            'AddressCity',
            $merchant->city,
        ], "\t");
        fputcsv($stream, [
            'AddressCountryCode',
            'JP',
        ], "\t");
        fputcsv($stream, [
            'AddressStateOrRegion',
            $merchant->prefecture,
        ], "\t");
        fputcsv($stream, [
            'AddressPostalCode',
            $merchant->postal_code,
        ], "\t");
        fputcsv($stream, [
            '',
        ], "\t");
        fputcsv($stream, [
            'MerchantSKU',
            'Quantity',
        ], "\t");


        //loop
        foreach ($inventories_csv as $inventory) {
            if ($inventory->sku2 !== '' and $inventory->sku2 !== null) {
                $sku = $inventory->sku2;
            } else {
                $sku = $inventory->sku;
            }
            //カラムを選択
            fputcsv($stream, [
                $sku,
                $inventory->number,
            ], "\t");
            //全カラムの場合はtoArray()を使えば良い
            //fputcsv($stream,$user->toArray());
        }

        //ポインタの先頭へ
        rewind($stream);

        //いろいろ変換
        $csv = mb_convert_encoding(str_replace(PHP_EOL, "\r\n", stream_get_contents($stream)), 'SJIS', 'UTF-8');

        //file名
        $filename = "fba" . date('Ymd') . ".txt";

        //header
        $headers = array(
            'Content-Type' => 'text/tab-separated-values',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        );

        $fba = Response::make($csv, 200, $headers);


        return $fba;
    }


    /**
     * CSVファイル作成(all item)
     *
     */
    public function item_all()
    {
        //クエリ実行
        $inventories_csv = Inventory::
        where('merchant_id', 1)
            ->orderBy('id', 'desc')
            ->get();

        //仮ファイルOpen
        $stream = fopen('php://temp', 'w');

        fputcsv($stream, [
            'sku',
            'sku2',
            'asin',
            'name',
            'buy_date',
            'num',
            'buy price'

        ], "\t");
        //loop

        foreach ($inventories_csv as $inventory) {
            //カラムを選択
            fputcsv($stream, [
                $inventory->sku,
                $inventory->sku2,
                $inventory->asin,
                $inventory->name,
                $inventory->buy_date,
                $inventory->number,
                $inventory->buy_price

            ], "\t");
            //全カラムの場合はtoArray()を使えば良い
            //fputcsv($stream,$user->toArray());
        }

        //ポインタの先頭へ
        rewind($stream);

        //いろいろ変換
        $csv = mb_convert_encoding(str_replace(PHP_EOL, "\r\n", stream_get_contents($stream)), 'SJIS', 'UTF-8');

        //file名
        $filename = "inv_" . date('Ymd') . ".txt";

        //header
        $headers = array(
            'Content-Type' => 'text/tab-separated-values',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        );
        $inv = Response::make($csv, 200, $headers);

        return $inv;
    }

    /**
     * 商品マスタ取得&作成
     * $act_flg : 0.get item_master 1.get & make item_master
     */
    function get_item_master($inventory, $act_flg)
    {
        //ItemMasterにitem_master_idとして商品マスタが登録済みか確認
        $query = ItemMaster::query();

        if (!empty($inventory->asin)) {
            $query->where('asin', $inventory->asin);
        }
        if (!empty($inventory->jan_code)) {
            $query->where('jan_code', $inventory->jan_code);
        }
        if (!empty($inventory->item_code)) {
            $query->where('item_code', $inventory->item_code);
        }

        $merchant_id = Merchant::merchantUserCheck();
        //結果を取得
        $item_master = $query
            ->where('merchant_id', $merchant_id)->first();

        //item master に商品マスタがあるかどうかを確認し、ある場合は、item_master_idをセット
        //ない場合は、商品マスタをASINをもとに新規作成

        //inventoryのasin or jan or item_codeがマスタに存在するか確認

        //商品マスタに存在すれば存在すれば既存商品マスタのIDを取得
        if (isset($item_master->id)) {
            return $inventory->item_master_id = $item_master->id;

            //商品マスタに存在しない場合、商品マスタを新規作成し、IDを取得
        } elseif ($act_flg == 1) {
            $item_input['asin'] = $inventory->asin;
            $item_input['jan_code'] = $inventory->jan_code;
            $item_input['item_code'] = $inventory->item_code;
            $item_input['merchant_id'] = $inventory->merchant_id;
            $item = ItemMaster::create($item_input);
            //amazonから取得した商品情報を保存
            Self::get_item_master_info($item);
            //新規作成した商品マスタから商品マスタIDを取得
            return $inventory->item_master_id = $item->id;
        } else {
            return print "no item_master";
        }
    }


    /**
     * amazonAPI 商品マスタ情報の追加
     */
    function get_item_master_info($item)
    {
        //amazon APIにてamazonデータを取得し格納する
        if (($item->asin != '' || $item->jan_code != '')) {
            try {
                $obj = new AmazonProductList("myStore"); //store name matches the array key in the config file
                $obj->setIdTYpe("ASIN", "JAN"); //tells the object to automatically use tokens right away
                if ($item->asin != '') {
                    $obj->setProductIds($item->asin); //tells the object to automatically use tokens right away
                } else {
                    $obj->setProductIds($item->jan_code); //tells the object to automatically use tokens right away
                }
                $item_detail = $obj->fetchProductList(); //this is what actually sends the request
                if (isset($item_detail->GetMatchingProductForIdResult->Error->Code)) {
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
                echo 'There was a problem with the Amazon library. Error: ' . $ex->getMessage();
            }
        }
    }


    public function apply_item_master()
    {

        //店舗IDを取得
        $merchant_id = Merchant::merchantUserCheck();
        //該当の店舗IDかつ、item_masterが0(なし）のものを抽出
        $inventories = Inventory::where('merchant_id', '=', $merchant_id)
            ->where('item_master_id', '=', 0)
            ->get();

        foreach ($inventories as $inventory) {
            $inventory->item_master_id = Self::get_item_master($inventory, 1);
            $inventory->save();
            if ($inventory->asin != '') {
                $item = ItemMaster::where('id', '=', $inventory->item_master_id)->first();
                Self::get_item_master_info($item);
            }
        }

        return redirect('/admin/inventories')->with('flash_message', trans('adminlte_lang::message.updated_msg'));
    }

}
