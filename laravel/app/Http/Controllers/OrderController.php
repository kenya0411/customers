<?php

namespace App\Http\Controllers;
use App\Order;
use App\Products;
use App\products_options;

// use App\Http\Requests\HelloRequest;バリデーション用
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //日付を取得し絞り込み
// public function show($request,$dates,$redirect){
//         if(empty($dates)){

//        $dates = array(
//             'year' => $request->search_date_year,
//             'month' => $request->search_date_month,
//             'persons_id' => $request->search_persons_id,
//         );
//         };


//         $customers = DB::table('customers')
//         ->where('date_year','like','%'.$dates["year"].'%')
//         ->where('date_month','like','%'.$dates["month"].'%')
//         ->get();   
//         $products = DB::table('products')
//         ->where('persons_id','like','%'.$dates["persons_id"].'%')
//         ->where('date_year','like','%'.$dates["year"].'%')
//         ->where('date_month','like','%'.$dates["month"].'%')
//         ->get();   
//         $products_options = DB::table('products_options')
//         ->where('date_year','like','%'.$dates["year"].'%')
//         ->where('date_month','like','%'.$dates["month"].'%')
//         ->get();   

//         $users = DB::table('users')
//         ->where('permission_id','like','%'.'2'.'%')
//         ->get();   
//       $persons = DB::select('select * from persons');
//         // $products = DB::select('select * from products');
//         // $products_options = DB::select('select * from products_options');
//         return view($redirect)->with('products', $products)->with('persons', $persons)->with('dates', $dates)->with('products_options', $products_options)->with('customers', $customers)->with('users', $users);

// }




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

    $data = $this->show_list($request,'orders.list_order');
    return $data;

}

//     public function post(Request $request)
//     {
//         // $dates = array(
//         //     'year' => $request->date_month,
//         //     'month' => $request->date_year,
//         //     'persons_id' => $request->persons_id,
//         // );
// $data = $this->show($request,'','customers.index');

// return $data;


//     }


//     public function search(Request $request)
//     {

// $data = $this->show($request,'','customers.index');


// return $data;


//     }



//     public function delete(Request $request)
//     {
//         $validator = Validator::make($request->query(), ['id' => 'required'], ['id' => 'IDを指定してください。']);
//         if ($validator->fails()) {
//             return redirect('customers')->withErrors($validator);
//         }

//         $param = ['id' => $request->id];
//         $customers = DB::select('select * from customers where id=:id', $param);
//         return view('customers.delete', ['form' => $customers[0]]);
//     }


//     public function remove(Request $request)
//     {
//         $param = ['id' => $request->id];
//         DB::delete('delete from customers where id=:id', $param);
// $data = $this->show($request,'','customers.index');

// return $data;
//     }


//     public function update(Request $request)
//     {
//         //半角数字のみ出力
//         if(!empty($customers_etc_price)){
//             $customers_etc_price = preg_replace('/[^0-9]/', '', $request->customers_etc_price);
//         $customers_etc_price = mb_convert_kana($customers_etc_price, "n");
//     }else{
//             $customers_etc_price = $request->customers_etc_price;

//     }

//         $param = [
//         'persons_id' => $request->persons_id,
//         'id' => $request->id,
//         'customers_id' => $request->customers_id,
//         'customers_nickname' => $request->customers_nickname,
//         'customers_name' => $request->customers_name,
//         'customers_product_id' => $request->customers_product_id,
//         'products_id' => $request->products_id,
//         'products_options_id' => $request->products_options_id,
//         'customers_etc_price' => $customers_etc_price,
//         'customers_address' => $request->customers_address,
//         'customers_worry' => $request->customers_worry,
//         'customers_deliver_notice' => $request->customers_deliver_notice,
//         'customers_deliver_add_product' => $request->customers_deliver_add_product,
//         'users_id' => $request->users_id,
//         'customers_ship_is_finished' => $request->customers_ship_is_finished,
//         'customers_fortune_is_finished' => $request->customers_fortune_is_finished,
//         ];
//         DB::update('update customers set 
//             persons_id=:persons_id,
//             customers_id=:customers_id, 
//             customers_nickname=:customers_nickname, 
//             customers_name=:customers_name, 
//             customers_product_id=:customers_product_id, 
//             products_id=:products_id, 
//             products_options_id=:products_options_id, 
//             customers_etc_price=:customers_etc_price, 
//             customers_address=:customers_address, 
//             customers_worry=:customers_worry, 
//             customers_deliver_notice=:customers_deliver_notice, 
//             customers_deliver_add_product=:customers_deliver_add_product, 
//             users_id=:users_id, 
//             customers_ship_is_finished=:customers_ship_is_finished,
//             customers_fortune_is_finished=:customers_fortune_is_finished
//             where id=:id'
//             , $param);            

// $data = $this->show($request,'','customers.index');
// return $data;
//     }

//     public function detail_edit(Request $request)
//     {
//         //半角数字のみ出力
//     //     if(!empty($customers_etc_price)){
//     //         $customers_etc_price = preg_replace('/[^0-9]/', '', $request->customers_etc_price);
//     //     $customers_etc_price = mb_convert_kana($customers_etc_price, "n");
//     // }else{
//     //         $customers_etc_price = $request->customers_etc_price;

//     // }

//         $param = [
//         'id' => $request->id,
//         'date_year' => $request->date_year,
//         'date_month' => $request->date_month,
//         'date_day' => $request->date_day,
//         'customers_product_id' => $request->customers_product_id,
//         'customers_nickname' => $request->customers_nickname,
//         'customers_name' => $request->customers_name,
//         'persons_id' => $request->persons_id,
//         'products_id' => $request->products_id,
//         'products_options_id' => $request->products_options_id,
//         'customers_worry' => $request->customers_worry,
//         'customers_answer' => $request->customers_answer,
//         'users_id' => $request->users_id,
//         'customers_fortune_is_finished' => $request->customers_fortune_is_finished,
//         'customers_ship_is_finished' => $request->customers_ship_is_finished,
//         'customers_note' => $request->customers_note,
//         'customers_address' => $request->customers_address,
//         'customers_deliver_notice' => $request->customers_deliver_notice,
//         'customers_deliver_add_product' => $request->customers_deliver_add_product,
//         ];
//         DB::update('update customers set 
//             date_year=:date_year,
//             date_month=:date_month, 
//             date_day=:date_day, 
//             customers_product_id=:customers_product_id, 
//             customers_nickname=:customers_nickname, 
//             customers_name=:customers_name, 
//             persons_id=:persons_id, 
//             products_id=:products_id, 
//             products_options_id=:products_options_id, 
//             customers_worry=:customers_worry, 
//             customers_answer=:customers_answer, 
//             users_id=:users_id, 
//             customers_fortune_is_finished=:customers_fortune_is_finished, 
//             customers_ship_is_finished=:customers_ship_is_finished, 
//             customers_note=:customers_note,
//             customers_address=:customers_address,
//             customers_deliver_notice=:customers_deliver_notice,
//             customers_deliver_add_product=:customers_deliver_add_product
//             where id=:id'
//             , $param);            
//        $dates = array(
//             'year' => $request->date_year,
//             'month' => $request->date_month,
//             'persons_id' => $request->persons_id,
//         );
// $data = $this->show($request,$dates,'customers.index');
// return $data;
// // 
// // 
//     }







//     public function add(Request $request)
//     {
//        $persons = DB::select('select * from persons');
//        return view('customers.add', ['persons' => $persons]);
//    }

//     // public function create(HelloRequest $request)
//    public function create(Request $request)
//    {
//     $products = DB::select('select * from products');
//     $products_number = end($products)->products_id +1;
//     $customers = DB::select('select * from customers');
//     $customers_id =  substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0,12);
// /////商品ネーム取得
//    $persons_name= ''; 
//    $products_name= ''; 
//    $products_options_name= ''; 
// if($request->persons_id){
//   $persons_name = DB::table('persons')
//         ->where('persons_id','=',$request->persons_id)
//         ->get(); 
//    $persons_name = $persons_name[0]->persons_name;
// }
// if($request->products_id){

//   $products_name = DB::table('products')
//         ->where('products_id','=',$request->products_id)
//         ->get(); 
//    $products_name = $products_name[0]->products_name;

//     }

// if($request->products_options_id){
//    $products_options_name = DB::table('products_options')
//         ->where('products_options_id','=',$request->products_options_id)
//         ->get(); 
//    $products_options_name = $products_options_name[0]->products_options_name;
//         }
// ///ここまで
//     $param = [
//         'date_year' => $request->date_year,
//         'date_month' => $request->date_month,
//         'date_day' => $request->date_day,
//         'persons_id' => $request->persons_id,
//         'customers_id' => $customers_id,
//         'customers_nickname' => $request->customers_nickname,
//         'customers_name' => $request->customers_name,
//         'customers_product_id' => $request->customers_product_id,
//         'products_id' => $request->products_id,
//         'products_options_id' => $request->products_options_id,
//         'customers_etc_price' => $request->customers_etc_price,
//         'customers_address' => $request->customers_address,
//         'customers_worry' => $request->customers_worry,
//         'persons_name' => $persons_name,
//         'products_name' => $products_name,
//         'products_options_name' => $products_options_name,
//     ];
//     DB::insert('insert into customers 
//         ( date_year, date_month, date_day, persons_id, customers_id, customers_nickname, customers_name, customers_product_id, customers_address, customers_worry, products_id, products_options_id, customers_etc_price, persons_name, products_name, products_options_name) values 
//         (:date_year,:date_month,:date_day,:persons_id,:customers_id,:customers_nickname,:customers_name,:customers_product_id,:customers_address,:customers_worry,:products_id,:products_options_id,:customers_etc_price,:persons_name,:products_name,:products_options_name)', $param);

//     return redirect('customers');
// }








   //  public function add_product_ajax(Request $request)
   //  {
   //      //personを選択する事で商品データを絞り込み
   //      $products = DB::table('products')
   //      ->where('date_year','like','%'.$request->date_year.'%')
   //      ->where('date_month','like','%'.$request->date_month.'%')
   //      ->where('persons_id','like','%'.$request->persons_id.'%')
   //      ->get();   
   //      return view('customers.ajax.add_product_ajax')->with('products', $products);
   // }

   //  public function add_product_option_ajax(Request $request)
   //  {
   //      //personを選択する事で商品データを絞り込み
   //      //
   //      $products_options = DB::table('products_options')
   //      ->where('date_year','like','%'.$request->date_year.'%')
   //      ->where('date_month','like','%'.$request->date_month.'%')
   //      ->where('products_number','like','%'.$request->products_id.'%')//scriptがごっちゃになったせい
   //      ->where('persons_id','like','%'.$request->persons_id.'%')
   //      ->get();   
   //      return view('customers.ajax.add_product_option_ajax')->with('products_options', $products_options);
   // }


/*--------------------------------------------------- */
/* 一覧画面のajax
/*--------------------------------------------------- */
//     public function ajax_customers_index(Request $request) {
//         // if(empty($dates)){

//         $time = time();
//         $dates = [
//             'date_year' => date("Y", $time),
//             'date_month' => date("n", $time),
//             'persons_id' => '',
//         ];
//     // }
// $products_options = '';
// $customers = '';
// $persons = '';
// $users = '';
// $products = '';
//         //personを選択する事で商品データを絞り込み
//         $customers = DB::table('customers')
//         ->where('date_month','=',$dates["date_month"])
//         ->where('date_year','=',$dates["date_year"])
//         ->get();   
//         $persons = DB::table('persons')
//         ->get();   
//         $products = DB::table('products')
//         ->where('date_month','=',$dates["date_month"])
//         ->where('date_year','=',$dates["date_year"])
//         ->get();   

//       //productの商品ナンバーを取得
//       // $value = $customers[0]->products_id;
//       // $products_number = products::where('products_id', '=', $value)->first();
//       //  $products_number = $products_number->products_number;
//       //  $products_options = DB::table('products_options')
//       //   ->where('products_number','=',$products_number)
//       //   ->where('date_month','=',$dates->date_month)
//       //   ->where('date_year','=',$dates->date_year)
//       //   ->get();   

//         $users = DB::table('users')
//         ->where('permission_id','=',2)
//         ->get();   


//     return ["customers"=>$customers,"persons"=>$persons,"products"=>$products,"products_options"=>$products_options,"users"=>$users];
//     }

/*--------------------------------------------------- */
/* 詳細画面のajax
/*--------------------------------------------------- */
//     public function ajax_customers(Request $request) {
// $products_options = '';
// $customers = '';
// $persons = '';
// $users = '';
// $products = '';
//         //personを選択する事で商品データを絞り込み
//         $customers = DB::table('customers')
//         ->where('id','=',$request->id)
//         ->get();   
//         $persons = DB::table('persons')
//         ->get();   
//         if($customers[0]->products_id){

//         $products = DB::table('products')
//         ->where('date_month','=',$customers[0]->date_month)
//         ->where('date_year','=',$customers[0]->date_year)
//         ->get();   
// };

//         if($customers[0]->products_options_id){
//       //productの商品ナンバーを取得
//       $value = $customers[0]->products_id;
//       $products_number = products::where('products_id', '=', $value)->first();
//        $products_number = $products_number->products_number;
//        $products_options = DB::table('products_options')
//         ->where('products_number','=',$products_number)
//         ->where('date_month','=',$customers[0]->date_month)
//         ->where('date_year','=',$customers[0]->date_year)
//         ->get();   
//         }

//         $users = DB::table('users')
//         ->where('permission_id','=',2)
//         ->get();   
//     return ["customers"=>$customers,"persons"=>$persons,"products"=>$products,"products_options"=>$products_options,"users"=>$users];
//     }


//     public function ajax_customers_search(Request $request) {
// $products_options = '';
// $customers = '';
// $persons = '';
// $users = '';
// $products = '';
//         $customers = DB::table('customers')
//         ->where('date_month','=',$request->date_month)
//         ->where('date_year','=',$request->date_year)
//         ->get();   
// //         $persons = DB::table('persons')
// //         ->get();   
// //         if($customers[0]->products_id){

// //         $products = DB::table('products')
// //         ->where('date_month','=',$request->date_month)
// //         ->where('date_year','=',$request->date_year)
// //         ->get();   
// // };

// //         if($customers[0]->products_options_id){
// //       //productの商品ナンバーを取得
// //       $value = $customers[0]->products_id;
// //       $products_number = products::where('products_id', '=', $value)->first();
// //        $products_number = $products_number->products_number;
// //        $products_options = DB::table('products_options')
// //         ->where('products_number','=',$products_number)
// //         ->where('date_month','=',$request->date_month)
// //         ->where('date_year','=',$request->date_year)
// //         ->get();   
// //         }

// //         $users = DB::table('users')
// //         ->where('permission_id','=',2)
// //         ->get();   
//     return ["customers"=>$customers];
//     }



    // public function reserve(Request $request) {

    //     return view('customers.reserve');


    // // return ["customers"=>$customers];
    // }
    // public function reserve_post(Request $request) {

    //     return view('customers.reserve');

    // }


    // public function reserve_ajax(Request $request) {
    //     $customers = DB::table('customers')
    //     ->where('customers_fortune_is_finished','=',null)
    //     ->get(); 

    // return ["customers"=>$customers];
    // }



        // public function reserve_send(Request $request)
        // {

        //     $param = [
        //     'id' => $request->id,
        //     'customers_fortune_is_finished' => 'true',
        //     ];
        //     DB::update('update customers set 
        //         customers_fortune_is_finished=:customers_fortune_is_finished
        //         where id=:id'
        //         , $param);            
        // return view('customers.reserve');

        // }









//     public function ajax_products(Request $request) {

//         //personを選択する事で商品データを絞り込み
//         $products = DB::table('products')
//         ->where('date_year','like','%'.$request->date_year.'%')
//         ->where('date_month','like','%'.$request->date_month.'%')
//         ->where('persons_id','like','%'.$request->persons_id.'%')
//         ->get(); 
//     return $products;
//     }

//     public function ajax_change(Request $request) {
// $persons = '';
// $products = '';
// $products_options = '';
//         $persons = DB::table('persons')
//         ->get();   
//         //personを選択する事で商品データを絞り込み

//         $products = DB::table('products')
//         ->where('date_year','like','%'.$request->date_year.'%')
//         ->where('date_month','like','%'.$request->date_month.'%')
//         ->where('persons_id','like','%'.$request->persons_id.'%')
//         ->get(); 

// if($request->products_id){

//     $value = $request->products_id;
//       $products_number = products::where('products_id', '=', $value)->first();
//       if($products_number ){

//        $products_number = $products_number->products_number;

//        $products_options = DB::table('products_options')
//         ->where('products_number','=',$products_number)
//         ->where('date_month','=',$request->date_month)
//         ->where('date_year','=',$request->date_year)
//         ->get(); 
//       }

// }

//     return ["persons"=>$persons,"products"=>$products,"products_options"=>$products_options];
//     }



    // public function ajax_products_options(Request $request) {
    // //productの商品ナンバーを取得
    // $value = $request->products_id;
    // $products = products::where('products_id', '=', $value)->first();
    // $products_number = $products->products_number;
    //     $products_options = DB::table('products_options')
    //     ->where('date_year','like','%'.$request->date_year.'%')
    //     ->where('date_month','like','%'.$request->date_month.'%')
    //     ->where('persons_id','like','%'.$request->persons_id.'%')
    //     ->where('products_number','like','%'.$products_number.'%')
    //     ->get(); 
    // // オプションを取得
    // return $products_options;

    // }














public function detail_index(Request $request)
{


    $data = $this->show_list($request,'orders.form_detail');
    return $data;
}



/*--------------------------------------------------- */
/* 一覧画面のajax
/*--------------------------------------------------- */
    //order以外の情報を取得
public function ajax_index(Request $request) {

    $persons = DB::table('persons')
    ->get();   

    $products = DB::table('products')
    ->get();   
    $customers = DB::table('customers')
    ->get();   
    $users = DB::table('users')
    ->get(); 
    $products_options = DB::table('products_options')
    ->get();   
        // $orders = DB::table('orders')
        // ->where('is_delete','=',0)//論理削除されてないもの
        // ->whereYear('created_at','=',date("Y"))//今年
        // ->whereMonth('created_at','=',date("m"))//今月
        // ->paginate(2);   



    return ["users"=>$users,"persons"=>$persons,"products"=>$products,"products_options"=>$products_options,"customers"=>$customers];
}




//検索画面用（orderのみ）
public function ajax_search(Request $request) {

    $year = '';  
    $month = '';  
    $person = '';  



    $orders = Order::query();
    $orders=$orders->where('is_delete','=',0);//論理削除
    $orders=$orders->where('orders_id','like','%'.$request->orders_id.'%');//商品ID






    // 鑑定士で絞り込み
    if(!empty($request->persons_id)){
        $person = $request->persons_id;
        $orders->when($person, function($orders, $person) { 
            return $orders->where('persons_id','=',$person);
        }) ;
    }

    // 年で絞り込み
    if(!empty($request->year)){
        $year = $request->year;
        $orders->when($year, function($orders, $year) { 
            return $orders->whereYear('created_at','=',$year);
        }) ;
    }

    // 月で絞り込み
    if(!empty($request->month)){
        $month = $request->month;
        $orders->when($month, function($orders, $month) { 
            return $orders->whereMonth('created_at','=',$month);
        }) ;
    }

    $orders=$orders->paginate(30);

    return ["orders"=>$orders];

}



/*--------------------------------------------------- */
/* 詳細一覧
/*--------------------------------------------------- */
   //order以外の情報を取得
public function ajax_detail_index(Request $request) {
        //注文
    $orders = DB::table('orders')
        ->where('id','=',$request->id)//今年
        ->get(); 

        //顧客情報
        $customers = DB::table('customers')
        ->where('customers_id','=',$orders[0]->customers_id)//今年
        ->get();

        //占い師 
        $persons = DB::table('persons')
        ->get();


        //選択した占い師 
        $persons_selected = DB::table('persons')
        ->where('persons_id','=',$orders[0]->persons_id)//今年
        ->get();

        //商品
        $products = DB::table('products')
        ->where('persons_id','=',$orders[0]->persons_id)//占い師
        ->get();

        //外注
        $users = DB::table('users')
        ->where('permissions_id','=',2)//鑑定者の外注のみ表示
        ->get(); 

        //商品オプション
        $products_options = DB::table('products_options')
        ->where('persons_id','=',$orders[0]->persons_id)//占い師
        ->where('products_id','=',$orders[0]->products_id)//商品
        ->get();  

        $fortunes = DB::table('fortunes')
        ->where('id','=',$orders[0]->id)//今年
        ->get();  

        
        return ["users"=>$users,"persons"=>$persons,"products"=>$products,"products_options"=>$products_options,"customers"=>$customers,"orders"=>$orders,"fortunes"=>$fortunes,"persons_selected"=>$persons_selected];
    }


    /*--------------------------------------------------- */
/* 編集用
/*--------------------------------------------------- */
//order以外の情報を取得
public function ajax_detail_update(Request $request) {
    //DB【orders】の修正
    $param = ['id' => $request->id,
    'orders_id' => $request->orders_id,
    'persons_id' => $request->persons_id,
    'products_id' => $request->products_id,
    'products_options_id' => $request->products_options_id,
    'orders_price' => $request->orders_price,
    'users_id' => $request->users_id,
    'orders_notice' => $request->orders_notice,
    'updated_at' => date( "Y-m-d H:i:s" , time() ),
];
DB::update('update orders set 
 orders_id=:orders_id,
 persons_id=:persons_id,
 products_id=:products_id,
 products_options_id=:products_options_id,
 orders_price=:orders_price,
 users_id=:users_id,
 orders_notice=:orders_notice,
 updated_at=:updated_at
 where id=:id'
 , $param);


    //DB【customers】の修正
$param = ['customers_id' => $request->customers_id,
'customers_name' => $request->customers_name,
'customers_nickname' => $request->customers_nickname,
'customers_address' => $request->customers_address,
'updated_at' => date( "Y-m-d H:i:s" , time() ),

];
DB::update('update customers set 
 customers_name=:customers_name,
 customers_nickname=:customers_nickname,
 customers_address=:customers_address,
 updated_at=:updated_at
 where customers_id=:customers_id'
 , $param);


    //DB【fortunes】の修正
$param = ['id' => $request->id,
'fortunes_worry' => $request->fortunes_worry,
'fortunes_answer' => $request->fortunes_answer,
'updated_at' => date( "Y-m-d H:i:s" , time() ),

];
DB::update('update fortunes set 
 fortunes_worry=:fortunes_worry,
 fortunes_answer=:fortunes_answer,
 updated_at=:updated_at
 where id=:id'
 , $param);





    // $test =  date( "Y/m/d" , time() );
    // return ["test"=>$test];

}

/*--------------------------------------------------- */
/* 占い師や商品を選択時に自動で情報を変更させる
/*--------------------------------------------------- */
   //order以外の情報を取得
public function ajax_change_products(Request $request) {
        //注文
        // $orders = DB::table('orders')
        // ->where('id','=',$request->id)//今年
        // ->get(); 

        //顧客情報
        // $customers = DB::table('customers')
        // ->where('customers_id','=',$orders[0]->customers_id)//今年
        // ->get();

        // //占い師 
        // $persons = DB::table('persons')
        // ->get();

        //商品
    $products = DB::table('products')
        ->where('persons_id','=',$request->persons_id)//占い師
        ->get();

        //商品オプション
        $products_options = DB::table('products_options')
        ->where('persons_id','=',$request->persons_id)//占い師
        ->where('products_id','=',$request->products_id)//商品
        ->get();  


        return [
            "products"=>$products,
            "products_options"=>$products_options,
        ];
    }





}