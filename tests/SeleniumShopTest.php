<?php

use Modelizer\Selenium\SeleniumTestCase;

class SeleniumShopTest extends SeleniumTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasic()
    {
        // This is a sample code you can change as per your current scenario
        $this->visit('/')
             ->see('Prue')
             ->hold(3);

        //ログインページ
        $this->visit('/login')
             ->see('Prue')
             ->hold(3); 

        //ログアウトページ
        $this->visit('/register')
             ->see('Prue')
             ->hold(3);
    }

    /**
     * A basic submission test example.
     *
     * @return void
     */
    public function testLoginForm()
    {
        $loginInput = [
            'email' => 'user1@u.com',
            'password' => 'user1'
        ];

        // Login form test case scenario
        $this->visit('/login')
             ->submitForm('#login-form', $loginInput)
             ->see('ログアウト')  // Expected Result
             ->click('ログアウト')
             ->seePageIs('/');

    }
}
