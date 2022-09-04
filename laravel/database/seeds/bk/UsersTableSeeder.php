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
                'name' => 'master1',
                'nickname' => '管理者',
                'password' => Hash::make('SXKVn5Bv5v'),
                'permissions_id' => 1,
            ],

            [
                'name' => 'miyagawa02',
                'nickname' => '宮川',
                'password' => Hash::make('9EHkXYmpuK'),
                'permissions_id' => 2,
            ],
           [
                'name' => 'rui04502',
                'nickname' => 'ルイ',
                'password' => Hash::make('mJk3NGHcUW'),
                'permissions_id' => 2,
            ],
           [
                'name' => 'etc06403',
                'nickname' => 'その他',
                'password' => Hash::make('rRLuL7QUbg'),
                'permissions_id' => 2,
            ],
            [
                'name' => 'yamashita03',
                'nickname' => '山下',
                'password' => Hash::make('3RsaJqjrcM'),
                'permissions_id' => 3,
            ],
            [
                'name' => 'comment04',
                'nickname' => 'コメント返信者',
                'password' => Hash::make('SZ7gqZjxhD'),
                'permissions_id' => 4,
            ],
        ]);
    }
}