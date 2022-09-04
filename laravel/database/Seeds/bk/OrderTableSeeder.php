<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'orders_id' => 'm59648008140',
                'customers_id' => 3,
                'products_id' => 1,
                'products_options_id' => 1,
                'persons_id' => 1,
                'users_id' => 2,
                'orders_price' => 2980,
            ],
  
          [
                'orders_id' => 'm66373406825',
                'customers_id' => 2,
                'products_id' => 2,
                'products_options_id' => 0,
                'persons_id' => 1,
                'users_id' => 3,
                'orders_price' => 1780,
            ],
  
          [
                'orders_id' => '8402616',
                'customers_id' => 4,
                'products_id' => 3,
                'products_options_id' => 0,
                'persons_id' => 1,
                'users_id' => 3,
                'orders_price' => 2000,
            ],
  


        ]);
    }
}