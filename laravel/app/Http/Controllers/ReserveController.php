<?php

namespace App\Http\Controllers;

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

    $persons = DB::table('persons')
    ->get();   
    $customers = DB::table('customers')
    ->get();  
    $products = DB::table('products')
    ->get();   
    $customers = DB::table('customers')
    ->get();   
    $users = DB::table('users')
        ->where('permissions_id','=',2)//論理削除されてないもの
        ->get(); 
        $products_options = DB::table('products_options')
        ->get();   
        $fortunes = DB::table('fortunes')
        ->get();   

        $orders = DB::table('orders')
        ->where('is_delete','=',0)//論理削除されてないもの
        ->where('orders_is_reserve_finished','=',0)//論理削除されてないもの
        ->get();   


        

        return ["users"=>$users,"persons"=>$persons,"products"=>$products,"products_options"=>$products_options,"orders"=>$orders,"customers"=>$customers,"fortunes"=>$fortunes];
    }




//検索画面
 // public function ajax_search(Request $request) {

 //        $orders = DB::table('orders')
 //        ->where('persons_id','like','%'.$request->persons_id.'%')//論理削除されてないもの
 //        ->where('orders_id','like','%'.$request->orders_id.'%')//論理削除されてないもの
 //        ->where('is_delete','=',0)//論理削除されてないもの
 //        ->get();  

 //    return ["orders"=>$orders];

 //    }


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

}