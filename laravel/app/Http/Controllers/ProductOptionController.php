<?php

namespace App\Http\Controllers;
use App\Product;
use App\products_options;

// use App\Http\Requests\HelloRequest;バリデーション用
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductOptionController extends Controller
{
    

public function show_list($request,$redirect){

         $param = ['is_delete' => 0];//論理削除されてないものを取得
         $persons = DB::select('select * from persons');
         $products = DB::select('select * from products');
        $products_options = DB::select('select * from products_options where is_delete=:is_delete', $param);
        return view($redirect)->with('products', $products)->with('persons', $persons)->with('products_options', $products_options);
}

/*--------------------------------------------------- */
/* 表示
/*--------------------------------------------------- */


    public function index(Request $request)
    {


$data = $this->show_list($request,'products.list_product_option');
return $data;

    }

    public function post(Request $request)
    {

$data = $this->show_list($request,'products.list_product_option');
return $data;



    }


    public function search(Request $request)
    {
   
$data = $this->show($request,'','products.list_product_option');
  

return $data;


    }





/*--------------------------------------------------- */
/* 削除
/*--------------------------------------------------- */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->query(), ['products_options_id' => 'required'], ['products_options_id' => 'IDを指定してください。']);
        if ($validator->fails()) {
            return redirect('person')->withErrors($validator);
        }

        $param = ['products_options_id' => $request->products_options_id];
        $products_options = DB::select('select * from products where products_options_id=:products_options_id', $param);
        return view('products_options.delete', ['form' => $products_options[0]]);
    }


    public function remove(Request $request)
    {
       
        $param = [
            'products_options_id' => $request->products_options_id,
            'is_delete' => 1,
        ];
        // DB::delete('delete from persons where persons_id=:persons_id', $param);
        DB::update('update products_options set is_delete=:is_delete where products_options_id=:products_options_id', $param);
        // return view('products.list_product');
        return redirect('products_options');

    }




/*--------------------------------------------------- */
/* 編集
/*--------------------------------------------------- */
    public function update(Request $request)
    {
        //半角数字のみ出力
        $products_options_price = preg_replace('/[^0-9]/', '', $request->products_options_price);
        $products_options_price = mb_convert_kana($products_options_price, "n");
        $param = [
            'products_options_id' => $request->products_options_id,
            'products_options_name' => $request->products_options_name,
            'products_options_price' => $products_options_price,
            'products_options_detail' => $request->products_options_detail,
        ];
        DB::update('update products_options set 
            products_options_name=:products_options_name, 
            products_options_price=:products_options_price, 
            products_options_detail=:products_options_detail 
            where products_options_id=:products_options_id'
            , $param);            

        return redirect('products_options');

    }


/*--------------------------------------------------- */
/* 追加
/*--------------------------------------------------- */
    public function add(Request $request)
    {


         $param = ['is_delete' => 0];
        $persons = DB::select('select * from persons where is_delete=:is_delete', $param);
       return view('products.add', ['persons' => $persons]);
   }




   public function create(Request $request)
   {
    $products = DB::select('select * from products');
    
  
    $param = [
        'persons_id' => $request->persons_id,
        'products_name' => $request->products_name,
        'products_price' => $request->products_price,
        'products_method' => $request->products_method,
        'products_detail' => $request->products_detail,
    ];
    DB::insert('insert into products 
        ( persons_id, products_name, products_price, products_method, products_detail) values 
        (:persons_id,:products_name,:products_price,:products_method,:products_detail)', $param);
    return redirect('products');
 
}




/*--------------------------------------------------- */
/* 一覧画面のajax
/*--------------------------------------------------- */
    public function ajax_index(Request $request) {

$persons = '';
$products = '';
$products_options = '';

        $persons = DB::table('persons')
        ->get();   
        $products = DB::table('products')
        ->get();   
        $products_options = DB::table('products_options')
        ->where('is_delete','=',0)
        ->get();   


        // $users = DB::table('users')
        // ->where('permission_id','=',2)
        // ->get();   
        

    return ["persons"=>$persons,"products"=>$products,"products_options"=>$products_options];
    }


 public function ajax_search(Request $request) {
$products_options = '';

        $products_options = DB::table('products_options')
        ->where('persons_id','=',$request->persons_id)
        ->get();  
 
    return ["products_options"=>$products_options];
    // return ["persons"=>$persons,"products"=>$products];

    }





}