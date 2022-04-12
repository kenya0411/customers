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
            'id'  => 1,
            'orders_ship_is_finished'  => 0,
            'ships_is_other_name'  => '',
            ],
            [
            'id'  => 2,
            'orders_ship_is_finished'  => 0,
            'ships_is_other_name'  => '田中太郎',
            ],
            [
            'id'  => 3,
            'orders_ship_is_finished'  => 0,
            'ships_is_other_name'  => 0,
            ],


        ]);


    }
}
