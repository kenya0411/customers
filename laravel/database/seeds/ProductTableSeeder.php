<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
            'products_name'  => '片思い占い',
            'products_price'  => '0',
            'products_method'  => '霊感霊視',
            'products_detail'  => '●彼のあなたへの気持ちや深層心理、彼があなたに対して望んでいる事
●二人の今後
●別れや彼の気持ちが離れる原因
●彼があなたに隠している事
●彼は最終的にあなたと、どうなりたいと思ってる？
●彼との絆を深める方法
●総合的なアドバイス',
            'persons_id'  => '1',
            ],
        [
            'products_name'  => '妊娠占い',
            'products_price'  => '0',
            'products_method'  => '霊感タロット',
            'products_detail'  => '●何ヶ月以内に妊娠できる？
●子供ができやすい時期
●子供が出来ない原因
●夫婦の相性を良くする方法
●妊娠のチャンスを大きくする方法',
            'persons_id'  => '1',
            ],
        [
            'products_name'  => '妊娠占い',
            'products_price'  => '0',
            'products_method'  => '霊感・霊視',
            'products_detail'  => '●いつごろ妊娠は出来る？不妊治療をすべきかどうか
●妊娠しやすい時期や月はいつ？
●子供が出来ない原因は？
●パートナーとの相性はどう？
●将来恵まれる子供の人数と性別は？
●妊娠の確率を上げる方法を教えてほしい等
●無事に出産出来るか
●総合的なアドバイス',
            'persons_id'  => '2',
            ],

        ]);


    }
}
