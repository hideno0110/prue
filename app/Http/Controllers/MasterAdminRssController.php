<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RssUrl;

class MasterAdminRssController extends Controller
{
    public function __construct()
    {
        //masterユーザーのみを通す
        $this->middleware('auth:master');
    }
  
    public function index()
    {
        $rss_lists = RssUrl::all();
        return view('master.admin-rss.index', compact('rss_lists'));
    }
}
