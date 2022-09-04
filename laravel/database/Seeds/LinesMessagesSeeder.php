<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinesMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lines_messages')->insert([
            [
            // 'lines_messages_id'  => 0,
            'lines_customers_userid'  => '234352jjt34r54',
            'lines_messages_replytoken'  => 'f704807c06004a53a18e5676a6e704b5',
            'lines_messages_text'  => 'あかさたあふこんにちは',
            'lines_messages_from_userid'  => '234352jjt34r54',
            'lines_messages_to_userid'  => 'Ucb7718e5d65232dca709bdbe33f600c2',
            'lines_messages_webhook_event_id'  => '01GBWSGJYMD5HSAFNM77DDSEY9',
            ],
            [
            // 'lines_messages_id'  => 0,
            'lines_customers_userid'  => '234352jjt34r54',
            'lines_messages_replytoken'  => '34242',
            'lines_messages_text'  => '２個め',
            'lines_messages_from_userid'  => '234352jjt34r54',
            'lines_messages_to_userid'  => 'Ucb7718e5d65232dca709bdbe33f600c2',
            'lines_messages_webhook_event_id'  => '01GBWSGJYMD5HSAFNM77DDSEY9',
            ],


        ]);
    }
}
