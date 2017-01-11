<?php
Route::get('sitemap', array('uses' => 'AdminSitemapController@getIndex', 'as' => 'sitemap'));

//////////////////////////////////////////
// Admin Route
//////////////////////////////////////////

Route::group(['prefix' => 'admin'], function () {
    //lp
    Route::get('/lp', 'LpController@index');
    Route::post('/lp', 'LpController@store');
    //ログイン    
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::post('/logout', 'AdminAuth\LoginController@logout');
    Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm');
    Route::post('/register', 'AdminAuth\RegisterController@register');
    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

    //ダッシュボード
    Route::get('/', 'AdminDashboardController@index');
    Route::resource('/merchant','AdminMerchantController');
    Route::resource('/users','AdminUsersController', ['except' => ['show']]);
    Route::resource('/shops','AdminShopsController', ['except' => ['show']]);
    Route::resource('/shop_lists','AdminShopListController', ['except' => ['show']]);
    Route::resource('/inventories','AdminInventoriesController', ['except' => ['show']]);
    Route::post('/inventories/master_item', 'AdminInventoriesController@apply_item_master');
    Route::resource('/items','AdminItemMasterController', ['except' => ['show']]);
    Route::resource('/stocks','AdminStockController', ['only' => ['index','update']]);
     Route::get('/mws/sell', 'AdminMwsSellsController@index');
    Route::get('/mws/fba-inv', 'AdminFbaInventoriesController@index');
    Route::get('/research-shops', 'AdminResearchShopController@index', ['only' => ['index']]);
    Route::resource('/rss-read','AdminRssController', ['except' => ['show']]);
    Route::resource('/contact', 'AdminContactController', ['only' => ['index', 'store']]);
    Route::resource('/terms', 'AdminTermsController', ['only' => ['index']]);
    Route::resource('/privacy', 'AdminPrivacyController', ['only' => ['index']]);
    Route::resource('/howto', 'AdminHowtoController', ['only' => ['index']]);
    Route::resource('/qa', 'AdminQaController', ['only' => ['index']]);

    //upload
    Route::get('/upload', 'AdminUploadController@index');
    Route::post('/admin/add', 'AdminUploadController@store');
    //jquery INLINE EDIT
    Route::any('/jquerypost', 'AdminFunctionController@postDB'); 
    //autocomplete
    Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'AutoCompleteController@index'));
    Route::get('searchajax',array('as'=>'searchajax','uses'=>'AutoCompleteController@autoComplete'));
    Route::get('search_inventories',array('as'=>'search_inventories','uses'=>'AutoCompleteController@search_inventories'));
    //amazon API
    Route::get('/mws','AdminAmazonController@getAmazonOrders');
});

//////////////////////////////////////////
// Tool or Something
//////////////////////////////////////////

Route::post('/tool/maps','ScrapingController@scraping');

//////////////////////////////////////////
// Master Route
//////////////////////////////////////////

Route::group(['prefix' => 'master'], function () {
    //ログイン
    Route::get('/login', 'MasterAuth\LoginController@showLoginForm');
    Route::post('/login', 'MasterAuth\LoginController@login');
    Route::post('/logout', 'MasterAuth\LoginController@logout');
    Route::get('/register', 'MasterAuth\RegisterController@showRegistrationForm');
    Route::post('/register', 'MasterAuth\RegisterController@register');
    Route::post('/password/email', 'MasterAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'MasterAuth\ResetPasswordController@reset');
    Route::get('/password/reset', 'MasterAuth\ForgotPasswordController@showLinkRequestForm');
    Route::get('/password/reset/{token}', 'MasterAuth\ResetPasswordController@showResetForm');

    Route::get('/', 'MasterDashboardController@index');
    Route::resource('/admin-merchant', 'MasterAdminMerchantController');
    Route::resource('/admin-user', 'MasterAdminUserController');
    Route::resource('/admin-inventory', 'MasterAdminInventoryController');
    Route::resource('/admin-shop', 'MasterAdminShopController');
    Route::resource('/admin-rss', 'MasterAdminRssController');
    Route::resource('/admin-contact', 'MasterAdminContactController');
    Route::resource('/shop-user', 'MasterShopUserController');
});


//////////////////////////////////////////
// Shopping Route
//////////////////////////////////////////
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/', 'ShopIndexController@index');
Route::get('/{id}', 'ShopIndexController@show');
Route::get('/shop/cart/{id}','ShopCartController@index');
Route::post('/shop/cart/complete/{id}', 'ShopCartController@store');


