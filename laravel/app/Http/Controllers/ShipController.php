<?php

namespace App\Http\Controllers;
use App\Users;

// use App\Http\Requests\HelloRequest;バリデーション用
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipController extends Controller
{




    public function show_list($request,$redirect){

     $param = ['is_delete' => 0];
     $persons = DB::select('select * from persons');
     $orders = DB::select('select * from orders where is_delete=:is_delete', $param);
     return view($redirect)->with('orders', $orders)->with('persons', $persons);
 }

 /*--------------------------------------------------- */
/* product & ptoduct_option
/*--------------------------------------------------- */


public function index(Request $request)
{

    $data = $this->show_list($request,'ships.list_ship');
    return $data;

}








/*--------------------------------------------------- */
/* 一覧画面のajax
/*--------------------------------------------------- */
public function ajax_index(Request $request) {

    //鑑定士
    $persons = DB::table('persons')
    ->get(); 



    //商品情報
    $products = DB::table('products')
    ->get();

    //顧客管理   
    $customers = DB::table('customers')
    ->get();   
    
    //外注用
    $users = DB::table('users')
        ->where('permissions_id','=',2)//論理削除されてないもの
        ->get(); 

        //追加オプション
        $products_options = DB::table('products_options')
        ->get();

        //鑑定結果   
        $fortunes = DB::table('fortunes')
        ->get();   
        
        //注文
        $orders = DB::table('orders')
        ->where('is_delete','=',0)//論理削除されてないもの
        ->where('orders_is_ship_finished','=',0)
        ->where('orders_is_reserve_finished','=',1)
        ->get(); 

          //注文
        $ships = DB::table('ships')
        ->where('is_delete','=',0)//論理削除されてないもの
        ->where('orders_is_ship_finished','=',0)
        ->get();     

        //順番とIDを取得（vueで値を表示する為に必須）
        $orders_id=[];
        if(!empty($orders)){
            foreach ($orders as $key => $value) {
                $orders_id[] = array(
                    'index' => $key,
                    'id' => $value->id,
                );

            }
        }

        

        return [
            // "users"=>$users,
            "persons"=>$persons,
            "products"=>$products,
            "products_options"=>$products_options,
            "orders"=>$orders,
            "customers"=>$customers,
            "fortunes"=>$fortunes,
            "orders_id"=>$orders_id,
            "ships"=>$ships
        ];
    }





    /*--------------------------------------------------- */
//データベース上書き
    /*--------------------------------------------------- */
    
    public function ajax_update(Request $request)
    {

        // //悩みと鑑定結果の上書き
        // if(!empty($request->fortunes_worry) || !empty($request->fortunes_answer) ){

        //     $param = [
        //         'id' => $request->id,
        //         'fortunes_worry' => $request->fortunes_worry,
        //         'fortunes_answer' => $request->fortunes_answer,
        //     ];
        //     DB::update('update fortunes set 
        //         fortunes_worry=:fortunes_worry,
        //         fortunes_answer=:fortunes_answer
        //         where id=:id'
        //         , $param); 
        // }

        //備考、外注、発送の上書き
        if(!empty($request->ships_notice)){
            $param2 = [
                'id' => $request->id,
                'ships_is_other_name' => !empty($request->ships_is_other_name) ? $request->ships_is_other_name : null,
                'ships_notice' => !empty($request->ships_notice) ? $request->ships_notice : null,
                'ships_add_product1' => !empty($request->ships_add_product1) ? $request->ships_add_product1 : null,
                'ships_add_product2' => !empty($request->ships_add_product2) ? $request->ships_add_product2 : null,
                'ships_add_product3' => !empty($request->ships_add_product3) ? $request->ships_add_product3 : null,
            ];
            DB::update('update ships set 
                ships_is_other_name=:ships_is_other_name,
                ships_notice=:ships_notice,
                ships_add_product1=:ships_add_product1,
                ships_add_product2=:ships_add_product2,
                ships_add_product3=:ships_add_product3
                where id=:id'
                , $param2); 
        }


        // $fortunes = DB::table('fortunes')->get();   
        // $test = $request->fortunes_worry;

        // return ["fortunes"=>$fortunes,"test"=>$test];

    }



/*--------------------------------------------------- */
/* 発送完了用（外注用）
/*--------------------------------------------------- */
public function ajax_ship_shipped(Request $request)
{

    $param = [
        'id' => $request->id,
        'orders_is_ship_shipped' => 1,
    ];
    DB::update('update ships set 
        orders_is_ship_shipped=:orders_is_ship_shipped
        where id=:id'
        , $param); 

}


/*--------------------------------------------------- */
/* 発送報告完了用
/*--------------------------------------------------- */
public function ajax_ship_finished(Request $request)
{

    $param = [
        'id' => $request->id,
        'orders_is_ship_finished' => 1,
    ];
    //ships
    DB::update('update ships set 
        orders_is_ship_finished=:orders_is_ship_finished
        where id=:id'
        , $param); 

    //orders
    DB::update('update orders set 
        orders_is_ship_finished=:orders_is_ship_finished
        where id=:id'
        , $param); 

}


// /*--------------------------------------------------- */
// /* 名前確認用
// /*--------------------------------------------------- */
// public function ajax_name_check(Request $request)
// {
//      global $str,$name;

//     //鑑定結果の取得
//     $fortunes = DB::table('fortunes')
//     ->where('id','=',$request->id)//論理削除されてないもの
//     ->get(); 

//     $html = $fortunes[0]->fortunes_answer;//鑑定結果
//     $name= [];

//     //取得する文字列（文字がいくつあるか取得）
//     $count1 = substr_count( $html, "様" );
//     $count2 = substr_count( $html, "さま" );

//     //文字列取得用の関数
//     function get_name_check($count,$html,$text,$startNum,$endNum){
//         global $str,$name;
            
//             for ($i=0; $i <$count ; $i++) { 
//               $start = '';
//               $start = mb_strpos( $html, $text );//指定の文字の開始数を取得

//               //取得する文字列が無くなったらループ終了
//               if(empty($start)){
//                 break;
//             }

//             //数がマイナスになるのを防ぐ
//             if($start > $startNum){
//                 $start = $start - $startNum;
//             }

//             //文字を切り取り
//             $str = mb_substr( $html, $start, $endNum );
//             $str = str_replace("。", "", $str);
//             $str = str_replace("、", "", $str);
//             $html = str_replace($str, "", $html,$n);

//             //文字列をnameに追加
//             $name[]= $str;
//         }

//     }
//     //「様」の文字列を取得
//     if(!empty($count1)){
//         get_name_check($count1,$html,"様",3,4);
//     }
    
//     //「さま」の文字列を取得
//     if(!empty($count2)){
//         get_name_check($count2,$html,"さま",3,5);
//     }


//     $html = $name;
//     return ["html"=>$html];

// }



}