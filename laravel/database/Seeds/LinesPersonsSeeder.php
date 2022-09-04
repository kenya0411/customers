<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinesPersonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lines_persons')->insert([
            [
            // 'lines_persons_id'  => 0,
            'persons_id'  => 1,
            'lines_persons_userid'  => 1,
            'lines_persons_channel_id'  => 1657402582,
            'lines_persons_channel_secret'  => '845191daab69d06ed2aeb5d086335460',
            'lines_persons_access_token'  => 'xdK4psB3g40LlSAHsycfDsaRvA8//bFRrB0XnFNiRGd2R/dUN02YH+Q5GwHAxpCRERnxoGnb8p3Y0KAKEAEtb9ZQn0RG+jI5lA8IDY7crY+A/7UonUkWiZku0O3Va/BZLt8mcAbOt4mDrh6d8R4xMwdB04t89/1O/w1cDnyilFU=',
            ],



        ]);

    }
}
