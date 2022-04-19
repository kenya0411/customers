<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Order;
use App\Ship;
use App\Fortune;
use App\Products;
use App\products_options;

// use App\Http\Requests\HelloRequest;バリデーション用
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

		public function show_list($request,$redirect){

			 $param = ['is_delete' => 0];
			 $persons = DB::select('select * from persons');
			 $orders = DB::select('select * from orders where is_delete=:is_delete', $param);
			 return view($redirect)->with('orders', $orders)->with('persons', $persons);
	 }

/*--------------------------------------------------- */
/* viewページ
/*--------------------------------------------------- */


public function index(Request $request)
{
		$data = $this->show_list($request,'orders.list_order');
		return $data;

}

public function detail_index(Request $request)
{

		$data = $this->show_list($request,'orders.form_detail');
		return $data;
}

public function add_index(Request $request)
{

		$data = $this->show_list($request,'orders.order_add_form');
		return $data;
}

/*---------------------------------------------------------------------------------------------------- */
//注文一覧

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



		return [
			"users"=>$users,
			"persons"=>$persons,
			"products"=>$products,
			"products_options"=>$products_options,
			"customers"=>$customers];
}



/*--------------------------------------------------- */
/* //検索画面用（orderのみ）
/*--------------------------------------------------- */

public function ajax_search(Request $request) {

	$year = '';	
	$month = '';	
	$person = '';	
	$customers = '';	
	$test = '';	




	//注文情報
	// $orders = Order::query();
	$orders = Order::orderBy('created_at', 'desc');//購入順
	$orders=$orders->where('is_delete','=',0);//論理削除
	$orders=$orders->where('orders_id','like','%'.$request->orders_id.'%');//商品ID
	
	//顧客名で検索
	if(!empty($request->customers_name)){
			//顧客情報をDBから取得
			$customers = Customer::query();
			$customers=$customers->where('is_delete','=',0);//論理削除
			//ニックネームか本名をor検索
			$customers=$customers->where('customers_name','like','%'.$request->customers_name.'%')
			->orWhere('customers_nickname','like','%'.$request->customers_name.'%');
			$customers=$customers->get();
		//顧客IDを連想配列化
		$customers_id = [];
		foreach ($customers as $key => $value) {
			$customers_id[$key] = $value['customers_id'];
		};
		//絞り込み
		$orders=$orders->whereIn('customers_id',$customers_id);

	}

	
	if(!empty($request->customers_name)){

	}


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

// $test = $orders->last_page();


	//index用の配列
    $get_id=[];
    if(!empty($orders)){
        foreach ($orders as $key => $value) {
            $get_id[] = array(
                'index' => $key,
                'id' => !empty($value->id) ? $value->id - 1 : 0,
                'customers_id' => !empty($value->customers_id) ? $value->customers_id - 1 : 0,
                'persons_id' => !empty($value->persons_id) ? $value->persons_id - 1 : 0,
                'products_id' => !empty($value->products_id) ? $value->products_id - 1 : 0,
                'products_options_id' => !empty($value->products_options_id) ? $value->products_options_id - 1 : 0,
                'users_id' => !empty($value->users_id) ? $value->users_id - 1 : 0,
            );

        }
    };


	return [
		"orders"=>$orders,
		"get_id"=>$get_id,
	];

}




/*--------------------------------------------------- */
/* 月の合計料金を出力
/*--------------------------------------------------- */

public function ajax_get_total_price(Request $request) {
	$orders = Order::query();
	$orders=$orders->where('is_delete','=',0);//論理削除
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
	$orders=$orders->get();

$total_price = 0;
foreach ($orders as $key => $value) {
	$total_price = $total_price + $value['orders_price'];
};
$total_price = number_format($total_price);

		return [
			"orders"=>$orders,
			"total_price"=>$total_price,
		];
}





/*---------------------------------------------------------------------------------------------------- */
//詳細画面

/*--------------------------------------------------- */
/* 詳細一覧
/*--------------------------------------------------- */
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

	
	return [
	"users"=>$users,
	"persons"=>$persons,
	"products"=>$products,
	"products_options"=>$products_options,
	"customers"=>$customers,
	"orders"=>$orders,
	"fortunes"=>$fortunes,
	"persons_selected"=>$persons_selected
	];
}









/*--------------------------------------------------- */
/* 編集用
/*--------------------------------------------------- */
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
	'orders_is_reserve_finished' => $request->orders_is_reserve_finished,
	'orders_is_ship_finished' => $request->orders_is_ship_finished,
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
	orders_is_reserve_finished=:orders_is_reserve_finished,
	orders_is_ship_finished=:orders_is_ship_finished,
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
	'fortunes_reply1' => $request->fortunes_reply1,
	'updated_at' => date( "Y-m-d H:i:s" , time() ),

	];
	DB::update('update fortunes set 
	fortunes_worry=:fortunes_worry,
	fortunes_answer=:fortunes_answer,
	fortunes_reply1=:fortunes_reply1,
	updated_at=:updated_at
	where id=:id'
	, $param);



	//DB【ships】の修正
	// $param = ['id' => $request->id,
	// 'orders_is_reserve_finished' => $request->orders_is_reserve_finished,
	// 'orders_is_ship_finished' => $request->orders_is_ship_finished,
	// 'updated_at' => date( "Y-m-d H:i:s" , time() ),

	// ];
	// DB::update('update ships set 
	// orders_is_reserve_finished=:orders_is_reserve_finished,
	// orders_is_ship_finished=:orders_is_ship_finished,
	// updated_at=:updated_at
	// where id=:id'
	// , $param);


$data = [
  'id' => $request->id,
   'orders_is_ship_finished' => $request->orders_is_ship_finished,
   'updated_at' => date( "Y-m-d H:i:s" , time() )

];

ship::upsert($data,['id'], [ 'orders_is_ship_finished', 'updated_at']);




}

/*--------------------------------------------------- */
/* 占い師や商品を選択時に自動で情報を変更させる
/*--------------------------------------------------- */
public function ajax_change_products(Request $request) {

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



/*--------------------------------------------------- */
/* 商品の金額を取得
/*--------------------------------------------------- */
public function ajax_get_temporary_price(Request $request) {

		$products_options_price=0;
		$products_price=0;
		//商品
		$products = DB::table('products')
		->where('products_id','=',$request->products_id)//占い師
		->get();

		//商品オプション
		$products_options = DB::table('products_options')
		->where('products_options_id','=',$request->products_options_id)//商品
		->get();	

		//商品とオプションの料金を足す
		if(!empty($products_options[0])){
			$products_options_price=$products_options[0]->products_options_price;
		}
		if(!empty($products[0])){
			$products_price=$products[0]->products_price;
		}
		$temporary_price = $products_price + $products_options_price;

		return [
		"temporary_price"=>$temporary_price,
		];
}





/*--------------------------------------------------- */
/* 鑑定結果の表示用（モーダルウインドウ）
/*--------------------------------------------------- */
public function ajax_modal_fortunes(Request $request) {

		//鑑定結果の取得
		$fortunes = DB::table('fortunes')
		->where('id','=',$request->id)//論理削除されてないもの
		->get(); 

		$modal_fortunes = $fortunes[0];
		return [
		"modal_fortunes"=>$modal_fortunes,
		];

}


/*---------------------------------------------------------------------------------------------------- */
//新規注文

/*--------------------------------------------------- */
/* 新規注文画面
/*--------------------------------------------------- */
//order以外の情報を取得
public function ajax_add_index(Request $request) {

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

	return [
	"users"=>$users,
	"persons"=>$persons,
	"products"=>$products,
	"products_options"=>$products_options,
	"customers"=>$customers
];
}


/*--------------------------------------------------- */
/* 手数料を表示
/*--------------------------------------------------- */
public function ajax_add_commission_price(Request $request) {

	$persons = DB::table('persons')
	->where('persons_id','=',$request->persons_id)//論理削除されてないもの
	->get();	 

	$persons_platform_fee=$persons[0]->persons_platform_fee;

	return [
	"persons_platform_fee"=>$persons_platform_fee,
	];
}

/*--------------------------------------------------- */
/*顧客名で検索（リピーターかどうかを確認）
/*--------------------------------------------------- */
public function ajax_search_customers(Request $request) {

    if(!empty($request->customers_name) || !empty($request->customers_nickname)){
        $customers = Customer::query();
        $customers=$customers->where('is_delete','=',0);//論理削除
        $customers=$customers->where('customers_name','like','%'.$request->customers_name.'%');
        $customers=$customers->where('customers_nickname','like','%'.$request->customers_nickname.'%');
        $customers=$customers->get();

    }else{
        $customers = [];
    }

    return ["customers"=>$customers];
}

/*--------------------------------------------------- */
/*リピーターの場合情報を取得
/*--------------------------------------------------- */
public function ajax_get_data_repeater(Request $request) {

        $customers = Customer::query();
        $customers=$customers->where('customers_id','=',$request->customers_id);
        $customers=$customers->get();


    return ["customers"=>$customers];
}

/*--------------------------------------------------- */
/* 新規注文用
/*--------------------------------------------------- */
public function ajax_add_update(Request $request) {


 
    //新規顧客の場合、customersに情報を追加
    if(empty($request->customers_id)){
        $customers = new Customer();
        $customers->create([
        'customers_nickname' => !empty($request->customers_nickname) ? $request->customers_nickname : null,
        'customers_name' => !empty($request->customers_name) ? $request->customers_name : null,
        'customers_address' => !empty($request->customers_address) ? $request->customers_address : null,
        'customers_note' => !empty($request->customers_note) ? $request->customers_note : null,
        'persons_id' => $request->persons_id,
      ]);
        $customers_id = Customer::latest()->first();
        $customers_id =  $customers_id->customers_id;   
    }else{
		//リピーターの場合はIDのみ取得
		$customers_id =  $request->customers_id;   

    }

    //注文情報を追加
    $orders = new Order();
    $orders->create([
		'orders_id' => !empty($request->orders_id) ? $request->orders_id : 0,
		'customers_id' => $customers_id,
		'products_id' => !empty($request->products_id) ? $request->products_id : 0,
		'products_options_id' => !empty($request->products_options_id) ? $request->products_options_id : 0,
		'orders_price' => !empty($request->orders_price) ? $request->orders_price : 0,
		'orders_notice' => !empty($request->orders_notice) ? $request->orders_notice : null,
		'persons_id' => $request->persons_id,
		'orders_is_ship_finished' => $request->orders_is_ship_finished,
    ]);
    //注文情報(orders)のIDと悩み(fortune)のIDを同じにする。
    $id = Order::latest()->first();
    $id =  $id->id;   



    //鑑定の悩みを追加
    $fortunes = new Fortune();
    $fortunes->create([
		'id' => $id,
		'fortunes_worry' => !empty($request->fortunes_worry) ? $request->fortunes_worry : null,
    ]);



}




/*--------------------------------------------------- */
/*注文情報の削除（論理削除）
/*--------------------------------------------------- */
public function ajax_delete(Request $request) {

	$param = [
	'id' => $request->id,
	'is_delete' => 1,
	'updated_at' => date( "Y-m-d H:i:s" , time() ),

	];

	//DB【fortunes】の削除
	DB::update('update fortunes set 
	is_delete=:is_delete,
	updated_at=:updated_at
	where id=:id'
	, $param);


	//DB【orders】の削除
	DB::update('update orders set 
	is_delete=:is_delete,
	updated_at=:updated_at
	where id=:id'
	, $param);


}

}