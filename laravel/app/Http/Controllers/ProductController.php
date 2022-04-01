<?php

namespace App\Http\Controllers;
use App\Product;
use App\products_options;

// use App\Http\Requests\HelloRequest;バリデーション用
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


public function show_list($request,$redirect){

         $param = ['is_delete' => 0];
         $persons = DB::select('select * from persons');
        $products = DB::select('select * from products where is_delete=:is_delete', $param);
        return view($redirect)->with('products', $products)->with('persons', $persons);
}

/*--------------------------------------------------- */
/* 表示
/*--------------------------------------------------- */


    public function index(Request $request)
    {


$data = $this->show_list($request,'products.list_product');
return $data;

    }

    public function post(Request $request)
    {

$data = $this->show_list($request,'products.list_product');
return $data;



    }


    public function search(Request $request)
    {
   
$data = $this->show($request,'','products.list_product');
  

return $data;


    }





/*--------------------------------------------------- */
/* 削除
/*--------------------------------------------------- */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->query(), ['products_id' => 'required'], ['products_id' => 'IDを指定してください。']);
        if ($validator->fails()) {
            return redirect('person')->withErrors($validator);
        }

        $param = ['products_id' => $request->products_id];
        $products = DB::select('select * from products where products_id=:products_id', $param);
        return view('products.delete', ['form' => $products[0]]);
    }


    public function remove(Request $request)
    {
       
        $param = [
            'products_id' => $request->products_id,
            'is_delete' => 1,
        ];
        // DB::delete('delete from persons where persons_id=:persons_id', $param);
        DB::update('update products set is_delete=:is_delete where products_id=:products_id', $param);
        // return view('products.list_product');
        return redirect('products');

    }




/*--------------------------------------------------- */
/* 編集
/*--------------------------------------------------- */
    public function update(Request $request)
    {
        //半角数字のみ出力
        $products_price = preg_replace('/[^0-9]/', '', $request->products_price);
        $products_price = mb_convert_kana($products_price, "n");
        $param = [
            'products_id' => $request->products_id,
            'products_name' => $request->products_name,
            'products_price' => $products_price,
            'products_method' => $request->products_method,
            'products_detail' => $request->products_detail,
        ];
        DB::update('update products set 
            products_name=:products_name, 
            products_price=:products_price, 
            products_method=:products_method, 
            products_detail=:products_detail 
            where products_id=:products_id'
            , $param);            

        return redirect('products');

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

        $persons = DB::table('persons')
        ->get();   

        // $products = DB::table('products')
        // ->where('is_delete','=',0)//論理削除されてないもの
        // ->get();   


 
        

    return ["persons"=>$persons];
    }


 public function ajax_search(Request $request) {
$products = '';
    $person = '';  


    $products = Product::query();
    $products=$products->where('is_delete','=',0);//論理削除

    if(!empty($request->persons_id)){
    $person = $request->persons_id;
    $products->when($person, function($products, $person) { 
    return $products->where('persons_id','=',$person);
    }) ;
    }
    $products=$products->paginate(30);


        // $products = DB::table('products')
        // ->where('persons_id','=',$request->persons_id)//占い師のID
        // ->where('is_delete','=',0)//論理削除されてないもの
        // ->paginate(1);  
 
    return ["products"=>$products];

    }



}