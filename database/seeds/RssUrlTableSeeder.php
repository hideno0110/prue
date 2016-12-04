<?php

use Illuminate\Database\Seeder;
use App\RssUrl;
class RssUrlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rss_urls = [
            [ 'admin_id' => 1, 'url' => 'http://news.yahoo.co.jp/pickup/science/rss.xml' ],
            [ 'admin_id' => 1, 'url' => 'http://headlines.yahoo.co.jp/rss/zdn_mkt-dom.xml' ],
            [ 'admin_id' => 2, 'url' => 'http://news.yahoo.co.jp/pickup/computer/rss.xml' ]
           // [ 'admin_id' => 1, 'url' => 'https://manablog.org/feed/' ],
           // [ 'admin_id' => 1, 'url' => 'https://blog.codecamp.jp/feed' ],
  
          ];
        foreach( $rss_urls as $url ) {
          $rss_url = new RssUrl();
          $rss_url->admin_id = $url['admin_id'];
          $rss_url->url = $url['url'];
          $rss_url->save();
        }
    }
}
