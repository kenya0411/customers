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
                'email' => '0',
                'password' => 'test',
                'permissions_id' => '1',
            ],

            [
                'name' => 'miyakawa',
                'email' => '1',
                'password' => 'test',
                'permissions_id' => '2',
            ],
           [
                'name' => 'rui',
                'email' => '2',
                'password' => 'test',
                'permissions_id' => '2',
            ],
           [
                'name' => 'yamashita',
                'email' => '3',
                'password' => 'test',
                'permissions_id' => '3',
            ],
                       [
                'name' => 'makino',
                'email' => '4',
                'password' => 'test',
                'permissions_id' => '4',
            ],
        ]);
    }
}