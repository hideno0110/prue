<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FbaInventory extends Model
{
    // mwsの販売リスト
    static function fba_inventories()
    {
        $fba_invs = DB::select("
          SELECT  
                    fi.sku as sku,
                    inventories.asin as asin,
                    item_masters.name,
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
                left join inventories on fi.sku =  (case when inventories.sku2 != '' then inventories.sku2 else inventories.sku end)
                left join item_masters on inventories.item_master_id = item_masters.id
        ");
    return $fba_invs;
    }


}
