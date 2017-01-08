<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminContact;

class MasterAdminContactController extends Controller
{
    public function __construct()
    {
        //masterユーザーのみを通す
        $this->middleware('auth:master');
    }    
    
    public function index() 
    {
        //merchant userからの問い合わせ一覧
        $admin_contacts = AdminContact::all();
        return view('master.admin-contact.index',compact('admin_contacts'));
    }
    
}
