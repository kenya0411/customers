<?php

use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persons')->insert([
            [
            'persons_name'  => '慧蘭(けいらん)',
            'persons_platform_name' => 'メルカリ',
            'persons_platform_url' => 'https://jp.mercari.com/',
            'persons_platform_fee' => 10,
            // 'created_at' => now(),
            // 'updated_at' => now(),
            ],

        ]);


    }
}
