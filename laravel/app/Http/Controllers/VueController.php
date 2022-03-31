<?php

namespace App\Http\Controllers;
use App\Products;
use App\Person;
use App\Order;
use App\products_options;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VueController extends Controller
{
    




    public function index(Request $request) {
    $users = Order::paginate(2);
    // $users = Order::query()->get();
// return ["users"=>$users];
        return view('vue')->with('users', $users);
// return $users;
    }




/*--------------------------------------------------- */
/* 一覧画面のajax
/*--------------------------------------------------- */
    public function ajax_index(Request $request) {
    // $users = Order::paginate(1);
        $users = DB::table('orders')->paginate(2);    
return $users;

//         $persons = DB::table('persons')
//         ->get();   
// $persons = 'test';
//         $products = DB::table('products')
//         ->get();   
//         $customers = DB::table('customers')
//         ->get();   
//         $users = DB::table('users')
//         ->get(); 
//         $products_options = DB::table('products_options')
//         ->get();   
//         $orders = DB::table('orders')
//         ->where('is_delete','=',0)//論理削除されてないもの
//         ->whereYear('created_at','=',date("Y"))//今年
//         ->whereMonth('created_at','=',date("m"))//今月
//         ->get();   



//     return ["users"=>$users,"persons"=>$persons,"products"=>$products,"products_options"=>$products_options,"orders"=>$orders,"customers"=>$customers];
    }



}