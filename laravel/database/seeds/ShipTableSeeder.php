<?php

use Illuminate\Database\Seeder;

class ShipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ships')->insert([
            [
            'ships_id'  => 1,
            'orders_ship_is_finished'  => 1,
            'orders_id'  => 'm59648008140',
            'customers_id'  => 3,
            'ships_is_other_name'  => 0,
            'ships_for_name'  => '',
            ],
            [
            'ships_id'  => 2,
            'orders_ship_is_finished'  => 1,
            'orders_id'  => 'm66373406825',
            'customers_id'  => 2,
            'ships_is_other_name'  => 1,
            'ships_for_name'  => '田中太郎',
            ],
            [
            'ships_id'  => 3,
            'orders_ship_is_finished'  => 0,
            'orders_id'  => '8402616',
            'customers_id'  => 4,
            'ships_is_other_name'  => 0,
            'ships_for_name'  => '',
            ],


        ]);


    }
}
