<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\AdminContactRequest;
use App\AdminContact;
use App\Admin;
use Mail;

class AdminContactController extends Controller 
{
    public function __construct() 
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    } 

    public function index() 
    {
        return view('admin.contact.index');
    }

    public function store(AdminContactRequest $request) 
    {
        try {
            // データベースに登録
            AdminContact::create($request->all());
        } catch (Exception $e) {  
            return redirect::back();     
        } 
        
        // ブラウザリロード等での二重送信防止
        $request->session()->regenerateToken();

        //slackへ登録を通知
        $user = new \App\Admin;
        $user->notify(new \App\Notifications\SlackPosted);

        //メール通知
        $email = Admin::findOrFail($request->admin_id)->email;
        Mail::send(['admin.mail.contact', 'admin.mail.contact_txt'], ['contact' => $request], function($message) use($email) {
            $message->to($email)->subject('Prue:お問い合わせありがとうございました');
        });
        
        return view('admin.contact.thanks');
    }
}
