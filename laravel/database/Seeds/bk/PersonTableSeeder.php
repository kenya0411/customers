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
            'persons_platform_url' => 'https://jp.mercari.com/transaction/',
            'persons_platform_fee' => 10,
            ],
            [
            'persons_name'  => '恋霊(れんれい)',
            'persons_platform_name' => 'ココナラ',
            'persons_platform_url' => 'https://coconala.com/talkrooms/',
            'persons_platform_fee' => 20,
            ],
            [
            'persons_name'  => 'フェアリース',
            'persons_platform_name' => 'メルカリ',
            'persons_platform_url' => 'https://jp.mercari.com/transaction/',
            'persons_platform_fee' => 10,
            ],
        ]);


    }
}
