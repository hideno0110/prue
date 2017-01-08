<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;

class MasterAdminMerchantController extends Controller
{
    
    public function __construct()
    {
        //masterユーザーのみを通す
        $this->middleware('auth:master');
    
    }    
    
    public function index()
    {
        //merchant 一覧
        $merchants = Merchant::all();
        return view('master.admin-merchant.index', compact('merchants'));
    }

}
