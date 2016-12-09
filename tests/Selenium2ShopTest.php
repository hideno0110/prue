<?php

use Modelizer\Selenium\SeleniumTestCase;

class SeleniumShopTest extends SeleniumTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
  public function testBasic() {

        $loginInput = [
            'email' => 'u1@u.com',
            'password' => 'user1'
        ];   
        
        
        $this->visit('/')
             ->hold(5)
             ->visit('/?page=2')
             ->hold(1)
             ->visit('/?page=3')
             ->hold(3)
             ->visit('/20')
             ->hold(3)
             ->submitForm('#purchase','')
             ->hold(3)
             ->submitForm('#login-form', $loginInput)
             ->hold(3)
             ->click('購入する')
             ->hold(3);
    }
}
