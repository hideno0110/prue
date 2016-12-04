<?php

namespace App\Task;

use Illuminate\Database\Eloquent\Model;
use App\RssUrl;
use App\RssNews;
use Log;
use DB;
class RssCron extends Model
{
  public static function getRssUrl() {
  
     // RSS をcronで取得する
       Log::debug('start rss task');
       try{
         DB::beginTransaction();

         //削除
         RssNews::truncate();       

         $rss_urls = RssUrl::all();
         $cache = [];

         foreach($rss_urls as $rss_url) {
           // admin_idを特定
           $admin_id = $rss_url->admin_id;
           // rss取得
           if( !isset($cache[$rss_url->url] )) {
              $rss_data = simplexml_load_file($rss_url->url);
              $cache[$rss_url->url] = $rss_data;
           }
           $rss_data = $cache[$rss_url->url];

           // キャッシュ保存
            foreach($rss_data->channel->item as $rss){
                $item = new RssNews();
                $item->admin_id = $admin_id;
                $item->site = $rss_data->channel->title;
                $item->title = $rss->title;
                $item->date = date("Y-m-d H:i:s", strtotime($rss->pubDate));
                $item->url = $rss->link;
                $item->save();    
            }
          }
         //コミット
         DB::commit();
       } catch (Exception $e) {
           DB::rollBack();
           return Redirect::back();
       }     
  }
}
