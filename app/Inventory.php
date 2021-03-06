<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Inventory extends Model
{
    use  Sortable;

    protected $fillable = [
        'asin',
        'jan_code',
        'item_code',
        'item_master_id',
        'sku',
        'sku2',
        'name',
        'admin_id',
        'shop_id',
        'buy_date',
        'number',
        'buy_price',
        'sell_price',
        'payment_id',
        'sale_place_id',
        'stock_id',
        'condition_id',
        'description',
        'description_1',
        'description_2',
        'memo',
        'free',
        'free_memo',
        'ebay_id',
        'ebay_memo',
        'is_active',
        'merchant_id',
        'update_admin_id',
        'batteries_required'
      ];

    protected $sortable = [
        'id',
        'asin',
        'jan_code',
        'sku',
        'name',
        // 'shop_id',
        'shop_branch_id',    
        'buy_date',
        'number',
        'buy_price',
        'sell_price',
        'payment_id',
        'condition_id',
        'description',
        'memo',
        'free',
        'is_active',
        'created_at',
        'updated_at'
    ];


    public function merchant() 
    {
        return $this->belongsTo('App\Merchant');
    }

    public function inv_photo()
    {
        return $this->hasMany('App\InvPhoto');
    }
    
    public function shop() 
    {
        return $this->belongsTo('App\Shop');
    }
    
    public function shop_branch()
    {
        return $this->belongsTo('App\ShopBranch');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
    
    public function condition()
    {
        return $this->belongsTo('App\Condition');
    }
    
    public function sale_place()
    {
        return $this->belongsTo('App\SalePlace');
    }
    
    public function carts() 
    {
        return $this->hasMany('App\Cart');
    }

    public function invStock() 
    {
        return $this->hasOne('App\InvStock');
    }
    
    public function item_master()
    {
        return $this->belongsTo('App\ItemMaster');
    }
    
    public function inv_stock()
    {
        return $this->belongsTo('App\InvStock');
    }
    
    public function monthly_purchase_price($merchant_id)
    {
        //仕入れ比較
        $monthly_purchase = DB::select("
             SELECT
                DATE_FORMAT(buy_date, '%Y/%m') as month,
                sum(number) as num,
                FORMAT(SUM(buy_price),0 )as price 
             FROM inventories 
             where merchant_id = $merchant_id
             GROUP BY month order by month DESC ");
        return $monthly_purchase;
    }

    public function monthly_purchase_times() 
    {
        //仕入れ回数
        $fba_data =DB::select("
            SELECT
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) < 30 THEN 1 ELSE null END ) as 'under30',
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 30 and 59 THEN 1 ELSE null END ) as 'under60',
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 60 and 89 THEN 1 ELSE null END ) as 'under90',
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 90 and 119 THEN 1 ELSE null END ) as 'under120',
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 120 and 149 THEN 1 ELSE null END ) as 'under150',
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 150 and 179 THEN 1 ELSE null END ) as 'under180',
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) >= 90 THEN 1 ELSE null END ) as 'over90',
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) >= 120 THEN 1 ELSE null END ) as 'over120',
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) >= 150 THEN 1 ELSE null END ) as 'over150',
                count( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) >= 180 THEN 1 ELSE null END ) as 'over180',
                count( fi.sku ) as 'total_count',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) < 30  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'under30sum',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 30 and 59  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'under60sum',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 60 and 89  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'under90sum',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 90 and 119  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'under120sum',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 120 and 149  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'under150sum',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) BETWEEN 150 and 179  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'under180sum',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) >= 90  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'over90sum',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) >= 120  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'over120sum',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) >= 150  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'over150sum',
                FORMAT(sum( CASE WHEN DATEDIFF(DATE(NOW()),inventories.buy_date) >= 180  THEN fi.number * inventories.buy_price  ELSE null END ),0 ) as 'over180sum',
                FORMAT(sum(fi.number * inventories.buy_price),0 ) as 'total_sum'
              from fba_inventories fi
              left join inventories on fi.sku =  (case when inventories.sku2 = '' then inventories.sku else inventories.sku2 end)
              ");
        return $fba_data;
    }
  
    public function inv_expect_profit($this_month, $merchant_id)
    {
        //仕入れ予想利益
        $profit = DB::selectOne("
              SELECT cast(sum(case when buy_date like '%$this_month%' 
                 then sell_price *0.85 - buy_price else 0 end) as SIGNED)as a 
                 from inventories
                 where merchant_id = $merchant_id");
        return  number_format($profit->a);
    }

    public function inv_count($merchant_id) 
    {
        //これまで仕入れた商品の数
        $inv_count = Inventory::where('is_active', 1)->where('merchant_id', $merchant_id)->count();
        return $inv_count;
    }
  
    public function inv_month_num($this_month, $merchant_id) 
    {
        $inv_month_num = Inventory::where('buy_date','like', '%'.$this_month.'%')->where('merchant_id', $merchant_id)->count();
        return $inv_month_num;
    }
  
    public function inv_month_money($this_month, $merchant_id) 
    {
        $inv_month_money = Inventory::where('buy_date', 'like', '%'.$this_month.'%')->where('merchant_id',$merchant_id)->sum('buy_price');
        return $inv_month_money;
    }

}
