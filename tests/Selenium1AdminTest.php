<?php

use Modelizer\Selenium\SeleniumTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SeleniumAdminTest extends SeleniumTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginForm()
    {
        $loginInput = [
            'email' => 'a1@a.com',
            'password' => 'admin1'
        ];

        // $inventoryInput = [
        //     
        //     'asin' => "test_asin",
        //     'jan_code' => "jan12345",
        //     'name' => "test_item",
        //     'shop_id' => 1,
        //     // 'buy_date' => "2016-11-29",
        //     'number' => 1,
        //     'buy_price' => 1000,
        //     'sell_price' => 20000,
        //     'payment_id' => 1,
        //     // 'condition_id' => selectOption('form select[name=condition_id]', '1'),
        //     'sale_place_id' => 1,
        //     'description' => "良い状態です",
        //     // 'description_1' => "good description1",
        //     // 'description_2' => "good description2",
        //     // 'memo' => "hello memo",
        //     // 'ebay_id' => "1",
        //     // 'ebay_memo' => "ebaymemo",
        //     // 'free' => 1,
        //     // 'free_memo' => "free_memo",
        //     // 'sku2' => "sku2",
        //     // 'shipping_type' => 1,
        //     // 'is_active' =>1
        // ];


        // Login form test case scenario
        $this->visit('/admin/lp')
          ->hold(10)
          ->visit('/admin/login')
          ->submitForm('#login-form', $loginInput)
          ->seePageIs('/admin')
          ->hold(10)
          ->visit('/admin/items')
          ->hold(10)
          ->visit('/admin/inventories/create')
          ->hold(3)
          ->type('B018FWNB1O', 'asin')
          ->hold(1)
          ->type('1000', 'buy_price')
          ->hold(1)
          ->type('5000', 'sell_price')
          ->hold(2)
          ->type('3', 'number')
          ->type('1', 'condition_id')
          ->hold(3)
          ->press('new')
          ->hold(3)

          ->visit('/admin/items')
          ->hold(10)
          ->visit('/admin/inventories/')
          // ->click('test_asin')
          // ->see('test_asin')

          //遷移確認 
          ->hold(5)         
          ->visit('/admin/stocks')
          ->hold(3)         
          ->visit('/admin/shops')
          ->hold(5)         
          ->visit('/admin/shops/1/edit')
          ->hold(5)         

          ->visit('/admin/users')
          ->hold(5)         

          ->visit('/admin/rss-read');
          // ->visit('/tool/maps')


    }
}
