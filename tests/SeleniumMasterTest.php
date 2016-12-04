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
            'email' => 'master@m.com',
            'password' => 'master'
        ];

        // Login form test case scenario
        $this->visit('/master/login')
          ->hold(1)
          ->submitForm('#login-form', $loginInput)
          ->seePageIs('/master')
          ->hold(1)
          ->visit('/master/admin-merchant')
          ->visit('/master/admin-user')
          ->visit('/master/admin-inventory')
          ->visit('/master/admin-shop')
          ->visit('/master/admin-rss')
          ->visit('/master/shop-user');
    }
}
