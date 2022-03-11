<?php

use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 商品データを追加
        $item = Person::create([
            'persons_name'    => '8C 8T 3.6GHz LGA1151',
            'persons_platform_name' => 43464,
            'persons_platform_url' => 10,
            'persons_platform_fee' => 10,
            'created_at' => now(),
            'updated_at' => now(),
            'is_delete' => false,
        ]);

    }
}
