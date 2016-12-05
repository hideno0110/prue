<?php

/*
|--------------------------------------------------------------------------
| モデルファクトリー
|--------------------------------------------------------------------------
|
| ここに全部のモデルファクトリーを定義してください。モデルファクトリーは
| テストのためにデータベースの初期値を用意したモデルを作成する便利な方法です。
| モデルがどのように見えれば良いのかをファクトリーに指示するだけです。
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
