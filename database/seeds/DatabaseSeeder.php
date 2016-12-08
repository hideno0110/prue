<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {
        //Define table
        $this->call(PaymentTableSeeder::class);
        $this->call(SalePlaceTableSeeder::class);
        $this->call(ConditionTableSeeder::class);
        $this->call(RoleTableSeeder::class);

        //master 
        $this->call(MasterTableSeeder::class);
        
        
        
        // Shop
        $this->call(UserTableSeeder::class);

        // Admin CMS
        $this->call(RssUrlTableSeeder::class);
        $this->call(MerchantTableSeeder::class);
        $this->call(MwsSellTableSeeder::class);
        $this->call(FbaInventoryTableSeeder::class);
        //relationがあるので順番を変更しない
        // $this->call(PhotoTableSeeder::class);
        $this->call(AdminTableSeeder::class);

        //relationがあるので順番を変更しない
        $this->call(ShopListTableSeeder::class);
        // $this->call(ShopTableSeeder::class);
        // $this->call(InventoryTableSeeder::class);
        $this->call(InvPhotoTableSeeder::class);
    }
}
