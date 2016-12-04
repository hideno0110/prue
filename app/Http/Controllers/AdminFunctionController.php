<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use ZipArchive;
use Chumper\Zipper\Zipper;
//use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use DB;
use ChromePhp;

class AdminFunctionController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function postDB(Request $request)
    {
        $id = $request->input('target_id');
        $target_text = $request->input('target_text');
        $target_type = $request->input('target_type');


        if ($target_type == 'shop_prefecture'){
        //ショップの都道府県の変更
          try {
              DB::table('shops')
                  ->where('id', $id)
                  ->update(['prefecture' => $target_text]);

          } catch (Exception $e) {
              return Redirect::back();
          }
          
        } else if($target_type == 'free') {
        //インベントリーのfreeNoの変更
          try {
              DB::table('inventories')
                  ->where('id', $id)
                  ->update(['free' => $target_text]);

          } catch (Exception $e) {
              return Redirect::back();
          }
        
        } else if($target_type == 'memo') {
          //インベントリーのメモの変更
          try {
              DB::table('inventories')
                  ->where('id', $id)
                  ->update(['memo' => $target_text]);
          } catch (Exception $e) {
              return Redirect::back();
          }
        }

        return Response::make('0');

    }

    /**
     * AutoComplete function 
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request){
        ChromePhp::log('start autocomlete');

        $input = $request->all();
        $term = $input['q'];
        ChromePhp::log('$term: ',$term);
        $results = array();

        $queries = DB::table('shops')
            ->where('shop_branch_name', 'LIKE', '%'.$term.'%')
            ->take(10)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->shop_branch_name ];
        }

        if(count($results))
            return $results;
        else
            return ['value'=>'No Result Found','id'=>''];


    }

    //画像ダウンロード
	  public function download_file() {


		$id = Input::get('id');
		$files = glob('images/'.$id);
		$zipfile = 'pics_'.$id.'.zip';


		$zipper = new Zipper();
		$zipper->make($zipfile)->add($files);

		$zipper = new Zipper();
		$zipper->make($zipfile)->add($files);
		// この方法はエラーになった
		// Zipper::make('images/test.zip')->add($files);

 		return response()->download(public_path($zipfile));
 		//ziparchiveha	 試していない
        // // Zipクラスロード
        // $zip = new ZipArchive();
        // // Zipファイル名
        // $zipFileName = 'hogehoge.zip';
        // // Zipファイル一時保存ディレクトリ
        // $zipTmpDir = '/hoge/tmp';
         
        // // Zipファイルオープン
        // $result = $zip->open($zipTmpDir.$zipFileName, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
        // if ($result !== true) {
        //     // 失敗した時の処理
        // }
         
        // // ここでDB等から画像イメージ配列を取ってくる
        // $image_data_array = 'images/5/';
         
        // // 処理制限時間を外す
        // set_time_limit(0);
         
        // foreach ($image_data_array as $filepath) {
         
        //     $filename = basename($filepath);
         
        //     // 取得ファイルをZipに追加していく
        //     $zip->addFromString($filename,file_get_contents($filepath));
         
        // }
                        
        // $zip->close();
         
        // // ストリームに出力
        // header('Content-Type: application/zip; name="' . $zipFileName . '"');
        // header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
        // header('Content-Length: '.filesize($zipTmpDir.$zipFileName));
        // echo file_get_contents($zipTmpDir.$zipFileName);
         
        // // 一時ファイルを削除しておく
        // unlink($zipTmpDir.$zipFileName);
         // exit();

    }

    //画像を表示
    public function show_pic() {

        $path = storage_path().'/images/～～～';  //（目的のパス
        return Response::download($path);


    }

    //画像を表示
    public function readXML() {
        $url = "http://hack.dev/images/xml/376847109017031.xml";
        $xml = simplexml_load_file($url);//指定したファイルの中の整形式XMLドキュメントをオブジェクトに変換

        return dd($xml);

    }


}
    

