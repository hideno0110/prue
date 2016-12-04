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
            'email' => 'admin1@a.com',
            'password' => 'admin1'
        ];

        $inventoryInput = [
            
            'asin' => "test_asin",
            'jan_code' => "jan12345",
            'name' => "test_item",
            'shop_id' => 1,
            // 'buy_date' => "2016-11-29",
            'number' => 1,
            'buy_price' => 1000,
            'sell_price' => 20000,
            'payment_id' => 1,
            'condition_id' => 1,
            'sale_place_id' => 1,
            'description' => "good description",
            // 'description_1' => "good description1",
            // 'description_2' => "good description2",
            // 'memo' => "hello memo",
            // 'ebay_id' => "1",
            // 'ebay_memo' => "ebaymemo",
            // 'free' => 1,
            // 'free_memo' => "free_memo",
            // 'sku2' => "sku2",
            // 'shipping_type' => 1,
            // 'is_active' =>1
        ];


        // Login form test case scenario
        $this->visit('/admin/login')
          ->hold(1)
          ->submitForm('#login-form', $loginInput)
          ->seePageIs('/admin')
          ->hold(1)
          ->visit('/admin/inventories/create')
          ->submitForm('#inventory-create', $inventoryInput)
          // ->seePageIs('/admin/inventories')

          ->visit('/admin/inventories/')
          ->click('test_asin')
          ->see('test_asin')

          //遷移確認 
          ->visit('/admin/shops')
          ->visit('admin/shop_lists')
          ->visit('admin/shop_lists')
          ->visit('admin/shop_lists')

          ->visit('/admin/users')
          ->visit('/admin/users/create')
          ->visit('/admin/rss-read')
          ->visit('/tool/maps');


    }
}
