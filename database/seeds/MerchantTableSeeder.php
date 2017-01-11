<?php

use Illuminate\Database\Seeder;



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
use peron\amazonmws\amazonorderlist;
use peron\amazonmws\amazoninventorylist;
use Peron\AmazonMws\AmazonProductList;





use Faker\Factory as Faker;
class MerchantTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('ja_JP');
        $merchant_names = array('コードショッピング','東商店','エントラータ','中古販売堂','セカンドブック');


        $asin = array(
          'B01LC99ERC', 'B01H1EWOG0', 'B01IEMPJAQ', 'B01LPTFJLO', 'B01J2XM0R6', 'B01IO57DAM', 'B01IEMPJMO', 'B01N8PFLQJ', 'B001KZGZVW', 'B0106XFCPI', 'B00NFCCUNK', 'B01N8RFIAA', 
          'B00005OVNV', 'B00005OVS6', 'B00005OVS9', 'B00005OVSB', 'B00005OVSS', 'B00005OVST', 'B00005OVSU', 'B00005OVTR', 'B00005OVTV', 'B00005OVUG', 'B00005OVUO', 'B00005OVUR', 
          'B01MYW8W47', 'B01N1LNSYL', 'B01NBHXDNA', 'B017JX0ETM', 'B01LXGP4UP', 'B00B8OBHHM', 'B01KUKDH7W', 'B01M4PSZS8', 'B01N4B8PS9', 'B01K19IM8G', 'B00HK8ETE8', 'B01DQEV15O', 
          'B01J7JNHXQ', 'B01MAV51SD', 'B01N7FJJA1', 'B01J7JN5ME', 'B01N4BN3AW', 'B002TKLMM4', 'B00N9NKTOC', 'B00IJ46SB4', 'B00IJ46SB4', 'B018VOBCJY', 'B005HMMBYE', 'B010AE5OZG', 
          'B00005OVUZ', 'B00005OVV0', 'B00005OVV3', 'B00005OVV5', 'B00005OVVU', 'B00005OVWF', 'B00005OVWV', 'B00005OVXQ', 'B00005OVXR', 'B00005QBBC', 'B00005QBBZ', 'B00005QBK2', 
          'B01I0WV9TA', 'B013SEKBIU', 'B004VC7VCS', 'B00DVDIODI', 'B00BSK1QPO', 'B019W1E89Q', 'B01JRFR4FC', 'B011REIANG', 'B00NSKYG2M', 'B00E37SO0E', 'B005HMMC0M', 'B01G4L84I8', 
          'B01718VCIW', 'B013SEIU9M', 'B0145YNPDA', 'B00FQ5K64O', 'B011HUVDJ8', 'B014D6L104', 'B01LYOTOPA', 'B01BXIYYRC', 'B01BHQ7PLW', 'B014697AYE', 'B00VDNCMCC', 'B00BXVR8FU', 
          'B012T45N74', 'B000WN67L6', 'B01MQSXNV8', 'B00C6AAO12', 'B01H03FQ44', 'B000J1099M', 'B014D6KF74', 'B010EUBT64', 'B0096JYZMA', 'B00ST81QTY', 'B00FQDFZQK', 'B01LXDUH4X', 
          'B000050GET', 'B00005BPJ4', 'B00005OULE', 'B00005OULX', 'B00005OUM5', 'B00005OUM6', 'B00005OURY', 'B00005OVIH', 'B00005OVKE', 'B00005OVNM', 'B00005OVNP', 'B00005OVNS', 
          'B00Y00O3RC', 'B009UQETKM', 'B00YOTLODK', 'B00EJA6P88', 'B003M6AGWQ', 'B00KQIG92Y'

        ); 


        for($i=0; $i<5; $i++) {       
          //企業ロゴ（ダミー) 
          $photo = Photo::create([
            'file' => 'me'.$i.'.png',
          ]);
          
          $merchant = new Merchant;
          $merchant->name = $merchant_names[$i];
          $merchant->tel =  $faker->phoneNumber;
          $merchant->mail = $faker->email;
          $merchant->postal_code = $faker->postcode;
          $merchant->prefecture = $faker->prefecture;
          $merchant->city = $faker->city;
          $merchant->address = "1-23";
          $merchant->address2 = "ABCビルディング1".$i;
          $merchant->photo_id = $photo->id;         
          $merchant->is_active = 1;
          $merchant->save();       

          //Inventory
          for ($j=0; $j < 5; $j++) {
            echo $j;
          $input=  array(
              'merchant_id' => rand(1,4),
              'photo_id' => 0,
              'asin' => $asin[$j+$i*10],
              'jan_code' => "",
              'item_code' => "",
              'sku' => "",
              'name' => "",
              'shop_id' => rand(1,10),
              'buy_date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = date_default_timezone_get()),
              'number' => rand(0,10),
              'buy_price' => rand(1000,5000),
              'sell_price' => rand(1000,20000),
              'payment_id' => rand(1,2),
              'condition_id' => rand(1,3),
              'sale_place_id' => rand(1,3),
              'description' => "良い状態です",
              'description_1' => "",
              'description_2' => "",
              'memo' => "",
              'ebay_id' => "",
              'ebay_memo' => "",
              'free' => 0,
              'free_memo' => "",
              'sku2' => "",
              'shipping_type' => 1,
              'update_admin_id' => 0,
              'is_active' =>1
          );
        //新規商品登録の際に、商品マスタがない場合、amazonよりデータの取得を行う。
        //取得に失敗する可能性もあるので、transactionの外に置く
        $amazon_get_flg = 0;
        $item='';
        
        
            echo 'start'.$j.$merchant->id;
            
            //更新者のidを取得
            $input['update_admin_id'] = 0;
            //merchant_idを取得
            $input['merchant_id'] = $merchant->id;
            //merchantインスタンスを作成
            // $merchant = Merchant::findOrFail($merchant_id);
            
            
            //新規商品をDBに登録
            $inventory = Inventory::create($input);
            
            //ItemMasterにitem_master_idとして商品マスタが登録済みか確認
            $query = ItemMaster::query();

             if(!empty($inventory->asin)){
                 $query->where('asin',$inventory->asin);
             }
             if(!empty($inventory->jan_code)){
                 $query->where('jan_code',$inventory->jan_code);
             }
             if(!empty($inventory->item_code)){
                 $query->where('item_code',$inventory->item_code);
             }

            $merchant_id = $merchant->id;
            //結果を取得
            $item_master = $query
              ->where('merchant_id', $merchant_id)->first();

            //item master に商品マスタがあるかどうかを確認し、ある場合は、item_master_idをセット
            //ない場合は、商品マスタをASINをもとに新規作成

             //inventoryのasin or jan or item_codeがマスタに存在するか確認 
              //商品マスタに存在すれば存在すれば既存商品マスタのIDを取得
            if(isset($item_master->id)) {
                  $inventory->item_master_id = $item_master->id;
                //商品マスタに存在しない場合、商品マスタを新規作成し、IDを取得
                } else {
                  $item_input['asin'] = $inventory->asin;
                  $item_input['jan_code'] = $inventory->jan_code;
                  $item_input['item_code'] = $inventory->item_code;
                  $item_input['merchant_id'] = $inventory->merchant_id;
                  $item = ItemMaster::create($item_input);
                  //新規作成した商品マスタから商品マスタIDを取得
                  $inventory->item_master_id = $item->id;
                }

            echo $j.'y'.$merchant->id;
            //SKU（商品番号）を作成
            //SKU = Item_masterID + condition + (usedの場合No.)
            if($inventory->condition->type == 11) {
                $inventory->sku = $inventory->item_master_id.'-'.$inventory->condition->type;
            } else { //used item
                $inventory->sku =$inventory->item_master_id.'-'.$inventory->condition->type.'-'.$inventory->id;
            }
            
            //SKU,item_master_idを追加更新
            $inventory->save();

            // echo $j.'et';
            // //画像を追加
            // $files = $request->file('photos');
            // //配列の中身確認用のjudge変数　http://qiita.com/wonda/items/b4a425edd73880a13e62
            // //$judge = array_filter($files);
            // if(!empty($files)) {
            //     $i = 1;
            //     foreach ($files as $file) {
            //         $name = time() . $file->getClientOriginalName();
            //         // $file->move('images/inv/'.$inventory->id.'/',$name);
            //         $file->move('images/inv/',$name);
            //         $photo = InvPhoto::create(['file'=>$name,
            //             'type'=> 1,
            //             'inventory_id'=>$inventory->id,
            //             'number'=>$i]);
            //         $i++;
            //     }
            // }
            //
            //在庫数を追加する
            $stock = InvStock::where('sku','like','%'.$inventory->sku.'%')->first();             
            // var_dump($stock);
            // var_dump($inventory->sku);

            if(isset($stock->id)) {
                $stock->stock += $inventory->number;
                $stock->save();
                $inventory->inv_stock_id = $stock->id;

            } else {
               $stock = new InvStock; 
                $stock['stock'] = $inventory->number;
                $stock['sku']   = $inventory->sku;
                $stock->merchant_id = $inventory->merchant_id;
                $stock->save();
                $inventory->inv_stock_id = $stock->id;
            }

            //stock_idを追加更新
            $inventory->save();



        //amazon APIにてamazonデータを取得し格納する
        if(($inventory->asin != ''|| $inventory->jan_code != '') && $item){ 
          try {
              $obj = new AmazonProductList("myStore"); //store name matches the array key in the config file
              $obj->setIdTYpe("ASIN","JAN"); //tells the object to automatically use tokens right away
              if($inventory->asin != '') { 
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



    }
}
