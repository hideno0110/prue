<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * この名前空間はコントローラルートへ適用されます。
     *
     * さらに、URLジェネレーターのルート名前空間としても設定されます。
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * ルートモデル結合、パターンフィルターなどを定義
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * アプリケーションのルートを定義
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapMasterRoutes();

        $this->mapAdminRoutes();

        //
    }

    /**
     * Define the "admin" routes for the application.
     *
     * これらのルートではすべて、セッション状態、CSRF保護などを受ける
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => ['web', 'admin', 'auth:admin'],
            'prefix' => 'admin',
            'as' => 'admin.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }

    /**
     * Define the "master" routes for the application.
     *
     * これらのルートではすべて、セッション状態、CSRF保護などを受ける
     *
     * @return void
     */
    protected function mapMasterRoutes()
    {
        Route::group([
            'middleware' => ['web', 'master', 'auth:master'],
            'prefix' => 'master',
            'as' => 'master.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/master.php');
        });
    }

    /**
     * アプリケーションの"Web"ルート定義
     *
     * これらのルートではすべて、セッション状態、CSRF保護などを受ける
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * アプリケーションの"api"ルート定義
     *
     * 通常、これらのルートはステートレス
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
