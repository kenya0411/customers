<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinesMailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lines_mails')->insert([
            [
            'lines_mails_mailaddress'  => 'shimoda.kenya@gmail.com',
            'users_id'  => 1,
            ],
            [
            'lines_mails_mailaddress'  => 'kenya411.number.one@gmail.com',
            'users_id'  => 2,
            ],


        ]);
    }
}
