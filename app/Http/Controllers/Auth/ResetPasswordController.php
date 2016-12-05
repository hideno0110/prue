<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | パスワードリセットコントローラ
    |--------------------------------------------------------------------------
    |
    | このコントローラはパスワードリセットリクエストの処理に責任を持ち、その
    | 振る舞いを取り込むために、シンプルなトレイトを使用しています。望み通りに
    | 調整するため、このトレイトを使い、メソッドをオーバーライドしてください。
    |
    */

    use ResetsPasswords;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * 新しいコントローラインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
