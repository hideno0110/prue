<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminContact;
use Mail;

class LpController extends Controller
{
  public function index() {
    return view('admin.lp.index');
  }


  public function store(Request $request) {


    try {
      // データベースに登録
       AdminContact::create($request->all());
    
    } catch (Exception $e) {  
      return redirect::back();     
    } 
    
    // ブラウザリロード等での二重送信防止
    $request->session()->regenerateToken();
    $email = $request->email;
    
    // //slackへ登録を通知
    // $user = new \App\Admin;
    // $user->notify(new \App\Notifications\SlackPosted);

    Mail::send(['admin.mail.lp.contact', 'admin.mail.lp.contact_txt'],
         ['contact' => $request], function($message) use($email) {

      $message->to($email)->subject('Prue:お問い合わせありがとうございました');
    });
    
    return redirect('/admin/lp')->with('flash_message','お問い合わせありがとうございました。');
    
  }






}
