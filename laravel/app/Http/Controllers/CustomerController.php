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
   public function detail_index(Request $request)
    {

    $data = $this->show_list($request,'customers.customer_detail');
    return $data;

    }



/*--------------------------------------------------- */
/* 一覧画面のajax
/*--------------------------------------------------- */
public function ajax_index(Request $request) {

     $customers = DB::table('customers')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->paginate(30);   


return ["customers"=>$customers];
}




//検索画面
 public function ajax_search(Request $request) {



    $customers = Customer::query();
    $customers=$customers->where('is_delete','=',0);//論理削除
    //ニックネームか本名をor検索
    $customers=$customers->where('customers_name','like','%'.$request->customers_name.'%')
    ->orWhere('customers_nickname','like','%'.$request->customers_name.'%');

    $customers=$customers->paginate(100);
    $data=$customers->sortBy('created_at')->values()->toArray();
    // $customers=$customers->get();

    return [
        "customers"=>$customers,
        "data"=>$data,
    ];

    }



/*--------------------------------------------------- */
/* 詳細ページのajax
/*--------------------------------------------------- */
public function ajax_detail_index(Request $request) {

    //顧客情報
    $customers = DB::table('customers')
    ->where('customers_id','=',$request->id)//今年
    ->get();

return ["customers"=>$customers];
}

/*--------------------------------------------------- */
/* 編集用
/*--------------------------------------------------- */
public function ajax_detail_update(Request $request) {


    // //DB【customers】の修正
    $param = ['customers_id' => $request->customers['customers_id'],
    'customers_name' => $request->customers['customers_name'],
    'customers_nickname' => $request->customers['customers_nickname'],
    'customers_address' => $request->customers['customers_address'],
    'customers_note' => $request->customers['customers_note'],
    'updated_at' => date( "Y-m-d H:i:s" , time() ),

    ];
    DB::update('update customers set 
    customers_name=:customers_name,
    customers_nickname=:customers_nickname,
    customers_address=:customers_address,
    customers_note=:customers_note,
    updated_at=:updated_at
    where customers_id=:customers_id'
    , $param);



}


}











