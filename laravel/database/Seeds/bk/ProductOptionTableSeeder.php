<?php

use Illuminate\Database\Seeder;

class ProductOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_options')->insert([
            [
            'products_options_name'  => '新月コース',
            'products_options_price'  => '1780',
            'products_options_detail'  => '',
            'products_id'  => '1',
            'persons_id'  => '1',
            ],
            [
            'products_options_name'  => '三日月コース',
            'products_options_price'  => '2980',
            'products_options_detail'  => '●オラクルカードのアドバイス',
            'persons_id'  => '1',
            'products_id'  => '1',
            ],
                        [
            'products_options_name'  => '満月コース',
            'products_options_price'  => '4980',
            'products_options_detail'  => '●オラクルカードのアドバイス
●思念伝達で縁結び',
            'persons_id'  => '1',
            'products_id'  => '1',
            ],
            [
            'products_options_name'  => '新月コース',
            'products_options_price'  => '1780',
            'products_options_detail'  => '',
            'persons_id'  => '1',
            'products_id'  => '2',
            ],
            [
            'products_options_name'  => '三日月コース',
            'products_options_price'  => '2980',
            'products_options_detail'  => '●オラクルカードのアドバイス',
            'persons_id'  => '1',
            'products_id'  => '2',
            ],

            // [
            // 'products_options_name'  => 'おひねり(500円)',
            // 'products_options_price'  => '500',
            // 'products_options_detail'  => '',
            // 'persons_id'  => '2',
            // 'products_id'  => '0',
            // ],
            // [
            // 'products_options_name'  => 'おひねり(1,000円)',
            // 'products_options_price'  => '100',
            // 'products_options_detail'  => '',
            // 'persons_id'  => '2',
            // 'products_id'  => '0',
            // ],


            

        ]);


    }
}
