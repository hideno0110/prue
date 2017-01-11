<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Inventory;
use App\MwsSell;

class AdminMwsSellsController extends Controller
{
    public function index()
    {
        $this_month = date("Y-m");

//        $mws_sell =DB::select("
//                             SELECT
//                                DATE_FORMAT(buy_date, '%Y/%m') as month,
//                                sum(number) as num,
//                                 FORMAT(SUM(buy_price),0 )as price FROM inventories GROUP BY DATE_FORMAT(buy_date, '%Y%m') order by month DESC ");

        $mws_sells =DB::select("
        SELECT 

            ms.`order-id`,
            ms.`sku`,
            inventories.id  as inv_id,
            inventories.asin  as asin,
            inventories.name as name,
            ms.`quantity-purchased`,
            ms.`price-type`,
            ms.`order-item-code`,
            ms.`posted-date`,
            sum(ms.`price-amount`) as `price-amount`,
            inventories.buy_price as buy_price,
            inventories.buy_date as buy_date,
            DATEDIFF(ms.`posted-date`,inventories.buy_date) as date,
            sum(ms.`price-amount` + ms.`item-related-fee-amount`) - inventories.buy_price as profit,
            concat(cast((sum(ms.`price-amount` + ms.`item-related-fee-amount`) - inventories.buy_price) / sum(ms.`price-amount`) * 100 as signed),'%' ) as profit_per,
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"FBAWeightBasedFee\" THEN ms.`item-related-fee-amount` END) as FBAWeightBasedFee,
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"FBAPerUnitFulfillmentFee\" THEN ms.`item-related-fee-amount` END) as FBAPerUnitFulfillmentFee,
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"Commission\" THEN ms.`item-related-fee-amount` END) as Commission,
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"CODFee\" THEN ms.`item-related-fee-amount` END) as CODFee,
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"GiftwrapChargeback\" THEN ms.`item-related-fee-amount` END) as GiftwrapChargeback,
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"ShippingChargeback\" THEN ms.`item-related-fee-amount` END) as ShippingChargeback,
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"ShippingHB\" THEN ms.`item-related-fee-amount` END) as ShippingHB,
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"RefundCommission\" THEN ms.`item-related-fee-amount` END) as RefundCommission,
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"VariableClosingFee\" THEN ms.`item-related-fee-amount` END) as VariableClosingFee
            FROM `mws_sells`  ms
            left join inventories on ms.sku =  (case when inventories.sku2 = '' then inventories.sku else inventories.sku2 end)
            where ms.`transaction-type` = 'Order'
            group by ms.`order-item-code`
            ORDER BY ms.`price-amount`
        ");

//        $mws_sells = $mws_sells->paginate(50);

        return view('admin.mws.sell.index', compact('mws_sells'));

    }
}
