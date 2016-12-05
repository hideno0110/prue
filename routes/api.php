<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| APIルート
|--------------------------------------------------------------------------
|
| ここでアプリケーションのAPIルートを登録します。これらの
| ルートはRouteServiceProviderによりロードされ、"api"ミドルウェア
| グループにアサインされます。API構築を楽しんでください！
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
