<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Log;
use App\Task\ShopMapCron;
use App\Task\AmazonCron;
use App\Task\RssCron;
class Kernel extends ConsoleKernel
{
    /**
     * アプリケーションで提供するArtisanコマンド
     *
     * @var array
     */
    protected $commands = [
      // 'App\Console\Commands\InspireCommand',
      'App\Console\Commands\TestCommand' // 追加
    ];

    /**
     * アプリケーションのコマンド実行スケジュール定義
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

      Log::debug('start task schedule!');

        //Rss Urlを取得
        $schedule->call(function () {
            RssCron::getRssUrl();
        })->everyFiveMinutes();

        //スクレイピング
        $schedule->call(function () {
            ShopMapCron::shop_map();
        })->hourly();
        
        // // スクレイピングしたデータの緯度経度を取得する
        $schedule->call(function () {
            ShopMapCron::shop_map_latlnt();
        })->everyFiveMinutes();

        //amazonOrderGet
        // $schedule->call(function () {
        //  AmazonCron::amzOrderGet();
        // })->everyMinute();
    }

    
    /**
     * アプリケーションのクロージャベースコマンドの登録
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
