<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class AdminFbaInventoriesController extends Controller
{

    public function __construct()
           {
             $this->middleware('auth:admin');
    }


    public function index()
        {
            $this_month = date("Y-m");

            $fba_invs =DB::select("
                    SELECT  
                        fi.sku as sku,
                        inventories.asin as asin,
                        inventories.name as name,
                        fi.fnsku as fnsku,

                        fi.number as number,
                        fi.status as status,
                        inventories.buy_date as buy_date,
                        
                        DATEDIFF(DATE(NOW()),inventories.buy_date)  as diffdate,
                        
                        CASE  
                          WHEN  DATEDIFF(DATE(NOW()),inventories.buy_date) < 30 THEN '30日未満'
                          WHEN  DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 30 AND 59 THEN '60日未満'
                          WHEN  DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 60 AND 89 THEN '90日未満'                          
                          WHEN  DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 90 AND 119 THEN '120日未満' 
                          WHEN  DATEDIFF(DATE(NOW()),inventories.buy_date) >=120 THEN '120日以上' 
                        END as diffterm,
                          
                        DATEDIFF(DATE(NOW()),inventories.buy_date)  as diffdate,
                        inventories.buy_price as buy_price
                    from fba_inventories fi
                    left join inventories on fi.sku =  (case when inventories.sku2 = '' then inventories.sku else inventories.sku2 end)
                    ");




            //        $mws_sells = $mws_sells->paginate(50);

            return view('admin.mws.fba_inv.index', compact('fba_invs'));

    }
}
