<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
            'products_name'  => 'foratune',
            'products_price'  => '1780',
            'products_method'  => 'test',
            'products_detail'  => '詳細',
            'persons_id'  => '1',
            // 'created_at' => now(),
            // 'updated_at' => now(),
            ],

        ]);


    }
}
