<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Products;
use App\products_options;

// use App\Http\Requests\HelloRequest;バリデーション用
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{


 
public function show_list($request,$redirect){

         $param = ['is_delete' => 0];
         $persons = DB::select('select * from persons');
        $customers = DB::select('select * from customers where is_delete=:is_delete', $param);
        return view($redirect)->with('customers', $customers)->with('persons', $persons);
}

/*--------------------------------------------------- */
/* 
/*--------------------------------------------------- */


    public function index(Request $request)
    {

$data = $this->show_list($request,'customers.list_customer');
return $data;

    }

    public function post(Request $request)
    {
$data = $this->show($request,'','customers.index');

return $data;


    }









/*--------------------------------------------------- */
/* 一覧画面のajax
/*--------------------------------------------------- */
    public function ajax_index(Request $request) {

         $customers = DB::table('customers')
        ->where('is_delete','=',0)//論理削除されてないもの
        ->paginate(1);   


        // $customers = DB::table('customers')
        // ->where('is_delete','=',0)//論理削除されてないもの
        // ->get();   

        // $customers = DB::table('customers')->paginate(10);


    return ["customers"=>$customers];
    }




//検索画面
 public function ajax_search(Request $request) {



    $customers = Customer::query();
    $customers=$customers->where('is_delete','=',0);//論理削除
    //ニックネームか本名をor検索
    $customers=$customers->where('customers_name','like','%'.$request->customers_name.'%')
    ->orWhere('customers_nickname','like','%'.$request->customers_name.'%');

    $customers=$customers->paginate(1);
    // $customers=$customers->get();

    return ["customers"=>$customers];

    }



}











