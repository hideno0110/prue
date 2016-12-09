<?php

use Modelizer\Selenium\SeleniumTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SeleniumMasterTest extends SeleniumTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginForm()
    {
        $loginInput = [
            'email' => 'm@m.com',
            'password' => 'master'
        ];

        // Login form test case scenario
        $this->visit('/master/login')
          ->hold(2)
          ->submitForm('#login-form', $loginInput)
          ->hold(1)
          ->visit('/master/admin-merchant')
          ->hold(5)
          ->visit('/master/admin-user')
          ->hold(2)
          ->visit('/master/admin-inventory')
          ->hold(2)
          ->visit('/master/admin-shop')
          ->hold(2)
          ->visit('/master/admin-rss')
          ->hold(2)
          ->visit('/master/shop-user')
          ->hold(2);
    }
}
