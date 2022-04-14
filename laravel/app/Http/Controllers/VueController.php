<?php

namespace App\Http\Controllers;
use App\Product;
use App\Person;
use App\Order;
use App\Customer;
use App\Fortune;
use App\products_options;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VueController extends Controller
{
    




    public function index(Request $request) {
    $users = Order::paginate(2);
    // $users = Order::query()->get();
// return ["users"=>$users];
// 元になるデータ

// Load users
$users = Order::all();

// Export all users
(new FastExcel($users))->export('csv/file.csv');

 return view('vue')->with('users', $users);
// return $users;
    }


    public function csv_export(Request $request) {

// Load users
$orders = Order::all();
(new FastExcel($orders))->export('csv/orders.csv');

$fortunes = Fortune::all();
(new FastExcel($fortunes))->export('csv/fortunes.csv');

$customers = Customer::all();
(new FastExcel($customers))->export('csv/customers.csv');

 
    }
public function csv_import(Request $request) {


for ($i=1; $i <=12 ; $i++) { 
$csv = 'csv/import/sale - 2021-'.$i.'.csv';


$fortunes = (new FastExcel)->import($csv, function ($line) {
    return Fortune::create([
        'id' => $line['id'],
        'orders_id' => $line['orders_id'],
        'fortunes_worry' => $line['fortunes_worry'],
        'fortunes_answer' => $line['fortunes_answer'],
        'fortunes_reply1' => $line['fortunes_reply1'],
        'updated_at' => $line['updated_at'],
        'created_at' => $line['created_at'],
    ]);
});



$orders = (new FastExcel)->import($csv, function ($line) {
    return Order::create([
        'id' => $line['id'],
        'orders_id' => $line['orders_id'],
        'customers_id' => $line['customers_id'],
        'products_id' => $line['products_id'],
        // 'products_options_id' => $line['products_options_id'],
        'persons_id' => $line['persons_id'],
        'users_id' => $line['users_id'],
        'orders_price' => $line['orders_price'],
        'orders_is_reserve_finished' => $line['orders_is_reserve_finished'],
        'orders_is_ship_finished' => $line['orders_is_ship_finished'],
        'updated_at' => $line['updated_at'],
        'created_at' => $line['created_at'],
    ]);
});


}



}



public function csv_import_customers(Request $request) {



$customers = (new FastExcel)->import('csv/import/customers.csv', function ($line) {
    return Customer::create([
        'customers_id' => $line['customers_id'],
        'customers_nickname' => trim($line['customers_nickname'], "\r"),
        'customers_name' => trim($line['customers_name']),
        'customers_address' => $line['customers_address'],
        'persons_id' => $line['persons_id'],
        'updated_at' => $line['updated_at'],
        'created_at' => $line['created_at'],
    ]);
});



}



public function csv_import_products(Request $request) {



$products = (new FastExcel)->import('csv/import/products.csv', function ($line) {
    return Product::create([
        'products_id' => $line['products_id'],
        'products_name' => $line['products_name'],
        'products_price' => $line['products_price'],
        'products_method' => $line['products_method'],
        'products_detail' => $line['products_detail'],
        'persons_id' => $line['persons_id'],
    ]);
});



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