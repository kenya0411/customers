<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'master',
                'nickname' => '管理者',
                'password' => Hash::make('test'),
                'permissions_id' => 1,
            ],

            [
                'name' => 'miyakawa',
                'nickname' => '宮川',
                'password' => Hash::make('test'),
                'permissions_id' => 2,
            ],
           [
                'name' => 'rui',
                'nickname' => 'ルイ',
                'password' => Hash::make('test'),
                'permissions_id' => 2,
            ],
           [
                'name' => 'etc',
                'nickname' => 'その他',
                'password' => Hash::make('test'),
                'permissions_id' => 3,
            ],
                       [
                'name' => 'yamashita',
                'nickname' => '山下',
                'password' => Hash::make('test'),
                'permissions_id' => 3,
            ],
        ]);
    }
}