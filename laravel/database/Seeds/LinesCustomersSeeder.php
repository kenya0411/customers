<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LinesCustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lines_customers')->insert([
            [
            // 'lines_customers_id'  => 0,
            'lines_customers_userid'  => '234352jjt34r54',
            'lines_customers_name'  => 'ken1',
            'customers_id'  => 1327,
            'persons_id'  => 1,
            ], 
            [
            // 'lines_customers_id'  => 0,
            'lines_customers_userid'  => '4ggrrete34535',
            'lines_customers_name'  => 'tanaka',
            'customers_id'  => 1127,
            'persons_id'  => 1,
            ],



        ]);

    }
}
