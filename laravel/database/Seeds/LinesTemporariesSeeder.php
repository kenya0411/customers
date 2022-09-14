<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinesTemporariesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lines_temporaries')->insert([
            [
            // 'lines_messages_id'  => 0,
            // 'lines_temporaries_id'  => 0,
            'lines_customers_userid'  => 'U346ddc4e9619ed125a707dc5f690bfe7',
            'lines_messages_text'  => 'testメッセージOppo',
            'users_id'  => 5,
            ],


        ]);
    }
}
