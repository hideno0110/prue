<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSitemapController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | サイトマップコントローラ
    |--------------------------------------------------------------------------
    |
    | サイトマップを生成するためのコントローラです。
    |
    */
 
    public function getIndex()
    {
    // インスタンス生成
    $sitemap = \App::make("sitemap");
 
    // キャッシュキー、及びキャッシュの有効期限（分単位※Carbon、Datetime、intのいずれか）を設定する。
    // 第三引数（オプション）キャッシュを有効にするかしないか、デフォルト：true（但しsetCacheメソッドを呼び出さなかった場合デフォルト値false）、false:無効
    // 複数サイトマップを作る場合には他のキャッシュキーと被らないようにしないとダメだと思います。
    $sitemap->setCache('Laravel.Sitemap.MySitemap.', 60, true);
 
    // アイテムの設定
    // 引数：URL, 日時（Y-m-dTH:i+09:00）, 重要度（0.1～1.0）, 更新頻度（always, hourly, daily, weekly, monthly, yearly, never）
    // 以下は例です。
    $sitemap->add(\URL::route('items.index'), '2014-01-27T10:10:00+09:00', '1.0', 'daily');
    $sitemap->add(\URL::route('items.create'), '2014-01-27T18:00:00+09:00', '0.5', 'never');
 
    // $posts = Post::orderBy('updated_at', 'desc')->get();
    // foreach ($posts as $post)
    // {
    // $sitemap->add(URL::route('post', $post->id), $post->updated_at, '1.0', 'weekly');
    // }
 
    // レンダラー生成
    // オプション：'xml'（デフォルト）, 'html', ''txt', 'ror-rss', ''ror-rdf'
    return $sitemap->render('xml');
    }
    //
}
