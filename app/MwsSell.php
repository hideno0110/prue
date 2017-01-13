<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class MwsSell extends Model
{
//    use  Sortable;

//    protected $sortable = ['id'
//    ];
//comment 2016/11/20

    // mwsの販売リスト
    static function mws_sells_list() 
    {
        $mws_sells = DB::select("
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
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"VariableClosingFee\" THEN ms.`item-related-fee-amount` END) as VariableClosingFee,
            sum(CASE  WHEN ms.`promotion-type`=  \"Shipping\" THEN ms.`direct-payment-type` END) as PromotionShipping
        FROM `mws_sells`  ms
            left join inventories on ms.sku =  (case when inventories.sku2 = '' then inventories.sku else inventories.sku2 end)
        where ms.`transaction-type` = 'Order'
        group by ms.`order-item-code`
        ORDER BY ms.`price-amount`
        ");

        return $mws_sells;
    }


    // mwsの返品リスト
    static function mws_refunds_list() 
    {
        $mws_refunds = DB::select("
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
            sum(CASE  WHEN ms.`item-related-fee-type`=  \"VariableClosingFee\" THEN ms.`item-related-fee-amount` END) as VariableClosingFee,
            sum(CASE  WHEN ms.`promotion-type`=  \"Shipping\" THEN ms.`direct-payment-type` END) as PromotionShipping
        FROM `mws_sells`  ms
            left join inventories on ms.sku =  (case when inventories.sku2 = '' then inventories.sku else inventories.sku2 end)
        where ms.`transaction-type` = 'Refund'
        group by ms.`order-item-code`
        ORDER BY ms.`price-amount`
        ");
    
        return $mws_refunds;
    }    


    // mwsの手数料リスト
    static function mws_fees() 
    {
        $mws_fees = DB::select("
        SELECT 
            ms.`transaction-type`,
            ms.`posted-date`,
            ms.`other-amount`
        FROM `mws_sells`  ms
            where ms.`transaction-type` <> 'Order' and ms.`transaction-type` <> 'Refund' and ms.`transaction-type` <> '' 
        ");
        return $mws_fees;
    }


    // mwsの統計情報
    static function mws_sums() 
    {
        $mws_sums = DB::select("
        SELECT 
            DATE_FORMAT(ms.`posted-date`, '%Y-%m') as posted_time,
            sum(CASE  WHEN ms.`transaction-type`=  \"Order\" THEN ms.`price-amount` END) as sales,
            sum(CASE  WHEN ms.`transaction-type`=  \"Order\" THEN ms.`item-related-fee-amount` END) +  sum(CASE  WHEN ms.`transaction-type`=  \"Order\" THEN ms.`promotion-amount` END) as sales_fee,
            sum(CASE  WHEN ms.`transaction-type`=  \"Refund\" THEN ms.`price-amount` END) as refund,
            sum(CASE  WHEN ms.`transaction-type`=  \"Refund\" THEN ms.`item-related-fee-amount` END) +  sum(CASE  WHEN ms.`transaction-type`=  \"Order\" THEN ms.`promotion-amount` END) as refund_fee,
            sum(`other-amount`) as merchant_fee,
            sum(`price-amount`) + sum(`item-related-fee-amount`) + sum(`promotion-amount`) + sum(`other-amount`) as sales_profit,
            sum(CASE  WHEN ms.`price-type`=  \"Principal\" THEN  inventories.buy_price END) as buy_price,
            sum(`price-amount`) + sum(`item-related-fee-amount`) + sum(`promotion-amount`) + sum(`other-amount`) -  sum(CASE  WHEN ms.`price-type`=  \"Principal\" THEN  inventories.buy_price END) as profit
        FROM `mws_sells`  ms
            left join inventories on ms.sku =  (case when inventories.sku2 = '' then inventories.sku else inventories.sku2 end)
        GROUP BY
        DATE_FORMAT(ms.`posted-date`, '%Y%m');
        ");

        return $mws_sums;
    }

} 
