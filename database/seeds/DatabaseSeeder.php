<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Shop
        $this->call(UserTableSeeder::class);

        // Admin CMS
        $this->call(MerchantTableSeeder::class);
        $this->call(MwsSellTableSeeder::class);
        $this->call(FbaInventoryTableSeeder::class);
        $this->call(RssUrlTableSeeder::class);
        //relationがあるので順番を変更しない
        $this->call(RoleTableSeeder::class);
        // $this->call(PhotoTableSeeder::class);
        $this->call(AdminTableSeeder::class);

        //relationがあるので順番を変更しない
        $this->call(ShopListTableSeeder::class);
        $this->call(ShopTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(SalePlaceTableSeeder::class);
        $this->call(ConditionTableSeeder::class);
        $this->call(InventoryTableSeeder::class);
        $this->call(InvPhotoTableSeeder::class);
        //master 
        $this->call(MasterTableSeeder::class);
    }
}
