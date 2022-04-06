<?php

namespace App\Http\Controllers;
use App\Users;

// use App\Http\Requests\HelloRequest;バリデーション用
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
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

    $data = $this->show_list($request,'reserves.list_reserve');
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
        ->where('orders_is_reserve_finished','=',0)
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

        

        return ["users"=>$users,"persons"=>$persons,"products"=>$products,"products_options"=>$products_options,"orders"=>$orders,"customers"=>$customers,"fortunes"=>$fortunes,"orders_id"=>$orders_id];
    }





    /*--------------------------------------------------- */
//データベース上書き
    /*--------------------------------------------------- */
    
    public function ajax_update(Request $request)
    {

        //悩みと鑑定結果の上書き
        if(!empty($request->fortunes_worry) || !empty($request->fortunes_answer) ){

            $param = [
                'id' => $request->id,
                'fortunes_worry' => $request->fortunes_worry,
                'fortunes_answer' => $request->fortunes_answer,
            ];
            DB::update('update fortunes set 
                fortunes_worry=:fortunes_worry,
                fortunes_answer=:fortunes_answer
                where id=:id'
                , $param); 
        }

        //備考、外注、発送の上書き
        if(!empty($request->orders_notice)){
            $param2 = [
                'id' => $request->id,
                'orders_notice' => $request->orders_notice,
                'users_id' => $request->users_id,
                'orders_is_ship_finished' => $request->orders_is_ship_finished,
            ];
            DB::update('update orders set 
                orders_notice=:orders_notice,
                users_id=:users_id,
                orders_is_ship_finished=:orders_is_ship_finished
                where id=:id'
                , $param2); 
        }


        // $fortunes = DB::table('fortunes')->get();   
        // $test = $request->fortunes_worry;

        // return ["fortunes"=>$fortunes,"test"=>$test];

    }


    /*--------------------------------------------------- */
//クリップボードにコピー
    /*--------------------------------------------------- */

    public function ajax_clipboard_copy(Request $request) {

        //注文
        $orders = DB::table('orders')
        ->where('is_delete','=',0)//論理削除されてないもの
        ->where('id','=',$request->id)//論理削除されてないもの
        ->get();   
        
        //鑑定者
        $users = DB::table('users')
        ->where('id','=',$orders[0]->users_id)//論理削除されてないもの
        ->get(); 

        //商品一覧
        $products = DB::table('products')
        ->where('products_id','=',$orders[0]->products_id)//論理削除されてないもの
        ->get();   

        //商品オプション
        if(!empty($orders[0]->products_options_id)){

            $products_options = DB::table('products_options')
        ->where('products_options_id','=',$orders[0]->products_options_id)//論理削除されてないもの
        ->get();   
        $products_options_detail = $products_options[0]->products_options_detail;

    }else{
        $products_options_detail = '';
    }



        //鑑定結果
    $fortunes = DB::table('fortunes')
        ->where('id','=',$orders[0]->id)//論理削除されてないもの
        ->get(); 


//コピー用
        $html = "■鑑定者\n";
        $html .= $users[0]->nickname."\n\n";
        $html .= "■鑑定方法\n";
        $html .= $products[0]->products_method."\n\n";
        $html .= "■商品ID\n";
        $html .= $orders[0]->orders_id."\n\n";
        $html .= "■悩みのジャンル\n";
        $html .= $products[0]->products_name."\n\n";
        $html .= "■ご相談内容\n";
        $html .= $fortunes[0]->fortunes_worry."\n\n";
        $html .= "■鑑定内容\n\n";
        $html .= "■商品自体の内容\n";
        $html .= $products[0]->products_detail."\n";
        $html .= $products_options_detail."\n\n";
        $html .= "■備考\n";
        $html .= $orders[0]->orders_notice."\n\n";
        

        return ["html"=>$html];
    }



    /*--------------------------------------------------- */
/* 発送予約
/*--------------------------------------------------- */
public function ajax_reserve_ship(Request $request)
{

        //悩みと鑑定結果の上書き

    $param = [
        'id' => $request->id,
        'orders_is_reserve_finished' => 1,
    ];
    DB::update('update orders set 
        orders_is_reserve_finished=:orders_is_reserve_finished
        where id=:id'
        , $param); 

}


/*--------------------------------------------------- */
/* 名前確認用
/*--------------------------------------------------- */
public function ajax_name_check(Request $request)
{

        //悩みと鑑定結果の上書き
        //注文
        // $orders = DB::table('orders')
        // ->where('id','=',$request->id)//論理削除されてないもの
        // ->get();   
    $fortunes = DB::table('fortunes')
        ->where('id','=',$request->id)//論理削除されてないもの
        ->get(); 
        $html = $fortunes[0]->fortunes_answer;
        $name= [];
        $count1 = substr_count( $html, "様" );
        $count2 = substr_count( $html, "さま" );
    //     if(!empty($count1)){
    //         for ($i=0; $i <$count1 ; $i++) { 
    //           $start = '';
    //           $start = mb_strpos( $html, '様' );
    //           if(empty($start)){
    //             break;
    //         }
    //         if($start > 3){
    //             $start = $start - 3;
    //         }
    //         $test = mb_substr( $html, $start, 4 );
    //         $test = str_replace("。", "", $test);
    //         $test = str_replace("、", "", $test);
    //         $html = str_replace($test, "", $html,$n);
    //         $name.= $test."\n";
    //     }//for
    // }//if
    function test($count,$html,$text,$startNum,$endNum){
        global $test,$name;
            for ($i=0; $i <$count ; $i++) { 
              $start = '';
              $start = mb_strpos( $html, $text );
              if(empty($start)){
                break;
            }
            if($start > $startNum){
                $start = $start - $startNum;
            }
            $test = mb_substr( $html, $start, $endNum );
            $test = str_replace("。", "", $test);
            $test = str_replace("、", "", $test);
            $html = str_replace($test, "", $html,$n);
            $name[]= $test;
        }//for

    }
       if(!empty($count1)){

test($count1,$html,"様",3,4);
    }//if
       if(!empty($count2)){

test($count2,$html,"さま",3,5);
    }//if
        global $test,$name;

    $test2 = $name;
    $html = $name;
    return ["html"=>$html,"test"=>$test,"test2"=>$test2];

}



}