<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * アプリケーションをテストするときのベースURL
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost:8000';

    /**
     * アプリケーションの生成
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
