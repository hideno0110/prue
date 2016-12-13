<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class MasterAdminUserController extends Controller
{
    public function __construct()
    {
        //masterユーザーのみを通す
        $this->middleware('auth:master');
    }
  
    public function index()
    {
        $admin_users = Admin::all();
        return view('master.admin-user.index', compact('admin_users'));
    }
}
