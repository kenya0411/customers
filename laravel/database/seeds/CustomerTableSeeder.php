<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'customers_nickname' => 'aroha',
                'customers_name' => '松尾 千春',
                'customers_address' => '〒806-0043
福岡県 北九州市八幡西区 青山1丁目4-3-501
松尾 千春 様',
                'customers_note' => '無し',
                'customers_age' => '24',
                'customers_prefecture' => '福岡県',
            ],
            [
                'customers_nickname' => 'Smile',
                'customers_name' => '奥平姫音',
                'customers_address' => '〒906-0012
沖縄県 宮古島市 平良西里1472-36
The nature 101
奥平 姫音 様',
                'customers_note' => '無し',
                'customers_age' => '28',
                'customers_prefecture' => '沖縄県',
            ],
            [
                'customers_nickname' => '*MOOMIN*',
                'customers_name' => '田中 恵里奈',
                'customers_address' => '〒216-0025
神奈川県 川崎市宮前区 白幡台２ー１ー２６
田中 恵里奈 様',
                'customers_note' => '無し',
                'customers_age' => '18',
                'customers_prefecture' => '神奈川県',
            ],

            [
                'customers_nickname' => 'mayu sa',
                'customers_name' => '西塔万祐子',
                'customers_address' => '',

                'customers_note' => '',
                'customers_age' => '38',
                'customers_prefecture' => '',
            ],



        ]);
    }
}