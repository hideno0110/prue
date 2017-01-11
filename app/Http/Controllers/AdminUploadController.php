<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use DB;

class AdminUploadController extends Controller
{
    public function __construct()
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }


    public function index() {

       return view('admin.upload.index');
    }

    public function store() {


        //CSVファイルの取得
        if(Input::get('inventories')) {


            $file = Input::file('inventories');
            $fileName = $file->getClientOriginalName() . '_' . time();
            $move = $file->move(storage_path() . '/upload', $fileName);

            // return print $move;

            //CSVのパース
            $config = new LexerConfig();
            $config->setDelimiter(",")
                ->setToCharset('UTF-8') // Customize file encoding. Default value is null, no converting.
                ->setFromCharset('SJIS'); // Customize source encoding. Default value is null.

            $interpreter = new Interpreter();


            $interpreter->addObserver(function (array $columns) {
                // CSVファイルを1行ずつ処理
//               dd($columns);
                DB::table('inventories')->insert(
                    [
                        'id' => $columns[0],
                        'sku' => $columns[1],
                        'jan_code' => $columns[2],
                        'asin' => $columns[3],
                        'shop_id' => $columns[4],
                        'name' => $columns[5],
                        'buy_date' => $columns[6],
                        'sale_place_id' => $columns[7],
                        'number' => $columns[8],
                        'buy_price' => $columns[9],
                        'sell_price' => $columns[10],
                        'payment_id' => $columns[11],
                        'condition_id' => $columns[12],
                        'description_1' => $columns[13],
                        'description_2' => $columns[14],
                        'description' => $columns[15],
                        'sku2' => $columns[16],
                        'ebay_id' => $columns[17],
                        'ebay_memo' => $columns[18],
                        'free' => $columns[19],
                        'free_memo' => $columns[20],
                        'created_at' => $columns[21],
                        'updated_at' => $columns[22],
                        'user_id' => $columns[23],
                        'is_active' => $columns[24],
                        'photo_id' => $columns[25]
                    ]
                );
            });


            $lexer = new Lexer($config);
            $lexer->parse($move, $interpreter);

            return back();





        } elseif(Input::get('shop_lists')) {

            $file = Input::file('shop_lists');
            $fileName = $file->getClientOriginalName() . '_' . time();
            $move = $file->move(storage_path() . '/upload', $fileName);

            // return print $move;

            //CSVのパース
                $config = new LexerConfig();
            $config->setDelimiter(",")
                    ->setToCharset('UTF-8') // Customize file encoding. Default value is null, no converting.
                    ->setFromCharset('SJIS-win'); // Customize source encoding. Default value is null.

            $interpreter = new Interpreter();


            $interpreter->addObserver(function (array $columns) {
                // CSVファイルを1行ずつ処理
                DB::table('shop_lists')->insert(
                    [
                    'id' => $columns[0],
                    'is_active' => $columns[1],
                    'created_at' => $columns[2],
                    'updated_at' => $columns[3],
                    'shop_name' => $columns[4]
                    ]
                );
            });


            $lexer = new Lexer($config);
            $lexer->parse($move, $interpreter);

            return back();

        }elseif(Input::get('shops')) {

            $file = Input::file('shops');
            $fileName = $file->getClientOriginalName() . '_' . time();
            $move = $file->move(storage_path() . '/upload', $fileName);

            // return print $move;

            //CSVのパース
            $config = new LexerConfig();
            $config->setDelimiter(",")
                ->setToCharset('UTF-8') // Customize file encoding. Default value is null, no converting.
                ->setFromCharset('SJIS-win'); // Customize source encoding. Default value is null.

            $interpreter = new Interpreter();


            $interpreter->addObserver(function (array $columns) {
                // CSVファイルを1行ずつ処理
                DB::table('shops')->insert(
                    [
                        'id' => $columns[0],
                        'shop_list_id' => $columns[1],
                        'is_active' => $columns[2],
                        'shop_branch_name' => $columns[5],
                        'created_at' => $columns[3],
                        'updated_at' => $columns[4]
//                        'is_active' => $columns[3]
                    ]
                );
            });


            $lexer = new Lexer($config);
            $lexer->parse($move, $interpreter);

            return back();

        } elseif(Input::get('fba_inventories')) {
            //DBを空にする
            DB::table('fba_inventories')->truncate();

            $file = Input::file('fba_inventories');
            $fileName = $file->getClientOriginalName() . '_' . time();
            $move = $file->move(storage_path() . '/upload', $fileName);

            // return print $move;



            //CSVのパース
            $config = new LexerConfig();
            $config->setDelimiter("\t")
                ->setToCharset("UTF-8") // Customize file encoding. Default value is null, no converting.
                ->setFromCharset("Shift_JIS") // Customize source encoding. Default value is null.
                ->setIgnoreHeaderLine(false)
                ->setEscape("\\");

            $interpreter = new Interpreter();


            $interpreter->addObserver(function (array $columns) {

//                return print  $columns[3].":".$columns[4];

		if($columns[5] == '欠陥品・不良品') {
			$columns[5] = '不良';
		}

                // CSVファイルを1行ずつ処理
                DB::table('fba_inventories')->insert(
                    [
//                        'id' =>'',
                        'date' => $columns[0],
                        'fnsku' => $columns[1],
                        'sku' => $columns[2],
//                        'name' => $columns[3],
                        'number' => $columns[4],
                        'fc' => $columns[5],
                        'status' => $columns[6],
                        'country' => $columns[7]
                    ]
                );
            });


            $lexer = new Lexer($config);
            $lexer->parse($move, $interpreter);

            return back();




        } elseif(Input::get('mws_sells')) {


            $file = Input::file('mws_sells');
            $fileName = $file->getClientOriginalName() . '_' . time();
            $move = $file->move(storage_path() . '/upload', $fileName);

            // return print $move;



            //CSVのパース
            $config = new LexerConfig();
            $config->setDelimiter("\t")
                ->setToCharset("UTF-8") // Customize file encoding. Default value is null, no converting.
                ->setFromCharset("Shift_JIS") // Customize source encoding. Default value is null.
                ->setIgnoreHeaderLine(true)
                ->setEscape("\\");

            $interpreter = new Interpreter();


            $interpreter->addObserver(function (array $columns) {

//                return print  $columns[3].":".$columns[4];

                // CSVファイルを1行ずつ処理
                DB::table('mws_sells')->insert(
                    [
//                        'id'=>'',
                        'settlement-id' => $columns[0],
                        'settlement-start-date' => $columns[1],
                        'settlement-end-date' => $columns[2],
                        'deposit-date' => $columns[3],
                        'total-amount' => $columns[4],
                        'currency' => $columns[5],
                        'transaction-type' => $columns[6],
                        'order-id' => $columns[7],
                        'merchant-order-id' => $columns[8],
                        'adjustment-id' => $columns[9],
                        'shipment-id' => $columns[10],
                        'marketplace-name' => $columns[11],
                        'shipment-fee-type' => $columns[12],
                        'shipment-fee-amount' => $columns[13],
                        'order-fee-type' => $columns[14],
                        'order-fee-amount' => $columns[15],
                        'fulfillment-id' => $columns[16],
                        'posted-date' => $columns[17],
                        'order-item-code' => $columns[18],
                        'merchant-order-item-id' => $columns[19],
                        'merchant-adjustment-item-id' => $columns[20],
                        'sku' => $columns[21],
                        'quantity-purchased' => $columns[22],
                        'price-type' => $columns[23],
                        'price-amount' => $columns[24],
                        'item-related-fee-type' => $columns[25],
                        'item-related-fee-amount' => $columns[26],
                        'misc-fee-amount' => $columns[27],
                        'other-fee-amount' => $columns[28],
                        'other-fee-reason-description' => $columns[29],
                        'promotion-id' => $columns[30],
                        'promotion-type' => $columns[31],
                        'promotion-amount' => $columns[33],
                        'direct-payment-type' => $columns[33],
                        'direct-payment-amount' => $columns[34],
                        'other-amount' => $columns[35],
                    ]
                );
            });

            $lexer = new Lexer($config);
            $lexer->parse($move, $interpreter);

            return back();




        }

        return back();
    }
}
