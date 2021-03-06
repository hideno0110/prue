<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 認証デフォルト
    |--------------------------------------------------------------------------
    |
    | このオプションはアプリケーションで用いる認証のデフォルト"guard"と
    | パスワードリセットオプションをコントロールします。これらのデフォルト値は
    | 自由に変更できますが、ほとんどのアプリケーションではこのままでよいでしょう。
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | 認証Guard
    |--------------------------------------------------------------------------
    |
    | 次に、アプリケーションの全認証Guardを定義します。
    | もちろん、「セッション」ストレージとEloquentユーザーを元に利用する、
    | もちろん、セッションストレージとEloquentユーザーを元に利用する、
    |
    | 全認証ドライバーはユーザープロバイダーを持っています。アプリケーションで
    | ユーザー情報を保管するために使用しているデータベースやストレージ
    | メカニズムから実際にどのようにユーザーを取り出すかをドライバーは定義しています。
    |
    | サポートドライバー： "session", "token"
    |
    */

    'guards' => [
        'master' => [
            'driver' => 'session',
            'provider' => 'masters',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ユーザープロバイダー
    |--------------------------------------------------------------------------
    |
    | 全認証ドライバーはユーザープロバイダーを持っています。アプリケーションで
    | ユーザー情報を保管するために使用しているデータベースやストレージ
    | メカニズムから実際にどのようにユーザーを取り出すかをドライバーは定義しています。
    |
    | 複数のユーザーテーブルやモデルが存在している場合、それぞれの
    | モデルやテーブルを表す複数のソースを設定してください。それからこうした
    | ソースへあなたが定義した認証Guardを追加でアサインする必要があるでしょう。
    |
    | サポートドライバー： "database", "eloquent"
    |
    */

    'providers' => [
        'masters' => [
            'driver' => 'eloquent',
            'model' => App\Master::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ],

        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | パスワードリセット
    |--------------------------------------------------------------------------
    |
    | アプリケーションで複数のユーザーテーブルやモデルを使用している場合、
    | 複数のパスワードリセット設定が必要になるでしょう。そして特定の
    | ユーザータイプに応じて、パスワードリセット設定を分けたくなるでしょう。
    |
    | 有効時間の"expire"に指定する分数は、良く考えてください。
    | このトークン保存時間はセキュリティー機能で、短い時間ほど
    | 安全になります。ですが、必要に応じ変更可能です。
    |
    */

    'passwords' => [
        'masters' => [
            'provider' => 'masters',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
