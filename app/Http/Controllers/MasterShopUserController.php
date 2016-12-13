<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MasterShopUserController extends Controller
{
    public function __construct()
    {
        //masterユーザーのみを通す
        $this->middleware('auth:master');
    }

    public function index()
    {
        $shop_users = User::all();
        return view('master.shop-user.index', compact('shop_users'));
    }
}
