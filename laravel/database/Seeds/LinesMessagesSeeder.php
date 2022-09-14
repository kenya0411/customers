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
            'lines_customers_userid'  => 'U346ddc4e9619ed125a707dc5f690bfe7',
            'lines_messages_replytoken'  => '980d7fa4b714480da3deb8a946cf8cb5',
            'lines_messages_text'  => 'testメッセージOppo',
            'lines_messages_from_userid'  => 'U346ddc4e9619ed125a707dc5f690bfe7',
            'lines_messages_to_userid'  => 'U9a6c97c1212b4fa8a5f6c76068fac1ad',
            'lines_messages_webhook_event_id'  => '01GCNKBA717DF8C6YH89Y5BAQ5',
            ],
            [
            // 'lines_messages_id'  => 0,
            'lines_customers_userid'  => 'Ucb7718e5d65232dca709bdbe33f600c2',
            'lines_messages_replytoken'  => 'd11134e215e44ccf92608cc2d24a5ad6',
            'lines_messages_text'  => 'メッセージあああだよおお',
            'lines_messages_from_userid'  => 'Ucb7718e5d65232dca709bdbe33f600c2',
            'lines_messages_to_userid'  => 'U9a6c97c1212b4fa8a5f6c76068fac1ad',
            'lines_messages_webhook_event_id'  => '01GCM9MT6XCA6P8EG5QKPP3JF0',
            ],
            [
            // 'lines_messages_id'  => 0,
            'lines_customers_userid'  => 'Ucb7718e5d65232dca709bdbe33f600c2',
            'lines_messages_replytoken'  => '',
            'lines_messages_text'  => '返信メッセージだよ',
            'lines_messages_from_userid'  => '',
            'lines_messages_to_userid'  => 'Ucb7718e5d65232dca709bdbe33f600c2',
            'lines_messages_webhook_event_id'  => '',
            ],



        ]);
    }
}
