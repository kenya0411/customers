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
            'lines_customers_userid'  => 'Ucb7718e5d65232dca709bdbe33f600c2',
            'lines_customers_name'  => 'kenya',
            'lines_customers_display_name'  => 'kenya',
            'lines_customers_picture_url'  => 'https://profile.line-scdn.net/0m0228838c72518280fa90a95e1d70985a3921baafb511',
            'customers_id'  => 1633,
            'persons_id'  => 1,
            ],
            [
            'lines_customers_userid'  => 'U346ddc4e9619ed125a707dc5f690bfe7',
            'lines_customers_name'  => 'oppo',
            'lines_customers_display_name'  => 'oppo',
            'lines_customers_picture_url'  => 'https://profile.line-scdn.net/0m0228838c72518280fa90a95e1d70985a3921baafb511',
            'customers_id'  => 1631,
            'persons_id'  => 1,
            ],



        ]);

    }
}
