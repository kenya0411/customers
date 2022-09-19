<?php

namespace App\Http\Controllers\Components;
use Illuminate\Support\Facades\Facade;

// use App\Http\Requests\HelloRequest;バリデーション用
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class CommonFunction extends Facade{



public static function change_persons_name ($before_name){
    

    $persons = CommonFunction::basic_persons_name();
    $text = $before_name;

    foreach ($persons['name'] as $key => $value) {
        // $text = $value;

        // $text = str_replace($before_name, $persons['afterName'], $value);


    };
    // $text = str_replace($key, $afterName, $fortunes[0]->fortunes_worry);
    file_put_contents("test/return.txt", var_export( $before_name , true));


    return $persons ;

}
public static function basic_persons_name (){
    $result = [
        'name'=>['けいらん', '恵蘭', '慧蘭','ケイラン','れんれい','レンレイ','恋霊','フェアリース'],
        'afterName'=>'Rise',

    ];
    return $result ;

}


}