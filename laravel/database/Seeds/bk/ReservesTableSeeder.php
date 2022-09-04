<?php

use Illuminate\Database\Seeder;

class ReserveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reserves')->insert([
            [
            'reserves_id'  => 1,
            'orders_is_reserve_finished'  => 1,
            'orders_id'  => 'm59648008140',
            'customers_id'  => 3,
            ],
            [
            'reserves_id'  => 2,
            'orders_is_reserve_finished'  => 1,
            'orders_id'  => 'm66373406825',
            'customers_id'  => 2,
            ],
            [
            'reserves_id'  => 3,
            'orders_is_reserve_finished'  => 0,
            'orders_id'  => '8402616',
            'customers_id'  => 4,
            ],


        ]);


    }
}
