<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => '管理者',
            ],
            [
                'id' => 2,
                'name' => '鑑定者',
            ],
            [
                'id' => 3,
                'name' => '発送者',
            ],
            [
                'id' => 4,
                'name' => 'コメント返信者',
            ],




        ]);
    }
}