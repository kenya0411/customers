<?php

namespace App\Http\Controllers;
use App\Product;
use App\products_options;

// use App\Http\Requests\HelloRequest;バリデーション用
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //日付を取得し絞り込み
public function show($request,$dates,$redirect){
        if(empty($dates)){

       $dates = array(
            'year' => $request->search_date_year,
            'month' => $request->search_date_month,
            'persons_id' => $request->search_persons_id,
        );
        };

        if(!empty($dates['persons_id'])){

        $products = DB::table('products')
        ->where('persons_id','like','%'.$dates['persons_id'].'%')
        ->where('date_year','like','%'.$dates["year"].'%')
        ->where('date_month','like','%'.$dates["month"].'%')
        ->get();
        $products_options = DB::table('products_options')
        ->where('persons_id','like','%'.$dates['persons_id'].'%')
        ->where('date_year','like','%'.$dates["year"].'%')
        ->where('date_month','like','%'.$dates["month"].'%')
        ->get();   
        }else{
        $products = DB::table('products')
        ->where('date_year','like','%'.$dates["year"].'%')
        ->where('date_month','like','%'.$dates["month"].'%')
        ->get();   

        $products_options = DB::table('products_options')
        ->where('date_year','like','%'.$dates["year"].'%')
        ->where('date_month','like','%'.$dates["month"].'%')
        ->get();   
        }

        $persons = DB::select('select * from persons');
        // return view('products.index')->with('products', $products)->with('persons', $persons)->with('dates', $dates)->with('products_options', $products_options);
        return view($redirect)->with('products', $products)->with('persons', $persons)->with('dates', $dates)->with('products_options', $products_options);

}

/*--------------------------------------------------- */
/* product & ptoduct_option
/*--------------------------------------------------- */


    public function index(Request $request)
    {
        $time = time();
        $dates = array(
            'year' => date("Y", $time),
            'month' => date("n", $time),
            'persons_id' => '',

        );
$data = $this->show($request,$dates,'products.list_product');
return $data;
    }

    public function post(Request $request)
    {
        // $dates = array(
        //     'year' => $request->date_month,
        //     'month' => $request->date_year,
        //     'persons_id' => $request->persons_id,

        // );
$data = $this->show($request,'','products.list_product');

return $data;


    }


    public function search(Request $request)
    {
   
$data = $this->show($request,'','products.list_product');
  

return $data;


    }



    public function clone(Request $request)
    {
        $date_year = $request->clone_date_year;
        $date_month = $request->clone_date_month;
        $new_date_month = $request->new_date_month;
        $new_date_year = $request->new_date_year;

        //商品リストの複製
        $products = DB::table('products')
        ->where('date_year','like','%'.$date_year.'%')
        ->where('date_month','like','%'.$date_month.'%')
        ->get();

        foreach ($products as $key => $value) {
        $param = [
            'persons_id' => $value->persons_id,
            'products_number' => $value->products_number,
            'products_name' => $value->products_name,
            'products_price' => $value->products_price,
            'products_method' => $value->products_method,
            'products_detail' => $value->products_detail,
            'date_year' => $new_date_year,
            'date_month' => $new_date_month,
        ];
   
    DB::insert('insert into products 
        ( products_number, persons_id, products_name, products_price, products_method, products_detail, date_year, date_month) values 
        (:products_number,:persons_id,:products_name,:products_price,:products_method,:products_detail,:date_year,:date_month)', $param);
        }


        //オプションリストの複製
      $products_options = DB::table('products_options')
        ->where('date_year','like','%'.$date_year.'%')
        ->where('date_month','like','%'.$date_month.'%')
        ->get();

        foreach ($products_options as $key => $value) {
        $param = [
            'products_options_name' => $value->products_options_name,
            'products_options_price' => $value->products_options_price,
            'products_options_detail' => $value->products_options_detail,
            'products_number' => $value->products_number,
            'persons_id' => $value->persons_id,
            'date_year' => $new_date_year,
            'date_month' => $new_date_month,
        ];
   
    DB::insert('insert into products_options 
        ( products_options_name, products_options_price, products_options_detail, products_number, persons_id, date_year, date_month) values 
        (:products_options_name,:products_options_price,:products_options_detail,:products_number,:persons_id,:date_year,:date_month)', $param);
        };

        $dates = array(
            'year' => $request->new_date_year,
            'month' => $request->new_date_month,
            'persons_id' => '',

        );
       $data = $this->show($request,$dates,'products.index');
return $data;
    }



/*--------------------------------------------------- */
/* ptoduct
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
        $param = ['products_id' => $request->products_id];
        DB::delete('delete from products where products_id=:products_id', $param);
$data = $this->show($request,'','products.index');

return $data;
    }


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
        // return redirect('products');

$data = $this->show($request,'','products.index');
return $data;
    }



    public function add(Request $request)
    {
       $persons = DB::select('select * from persons');
       return view('products.add', ['persons' => $persons]);
   }








    // public function create(HelloRequest $request)
   public function create(Request $request)
   {
    $products = DB::select('select * from products');
    
    //作成したIDと同数にする為、最後のID＋1にしてる
    if(empty($products[0]->products_id)){
        $products_number = 1;//初めて商品を作成する場合
    
}else{
   $products_number = end($products)->products_id +1; 
}
    $param = [
        'date_year' => $request->date_year,
        'date_month' => $request->date_month,
        'persons_id' => $request->persons_id,
        'products_name' => $request->products_name,
        'products_number' => $products_number,
        'products_price' => $request->products_price,
        'products_method' => $request->products_method,
        'products_detail' => $request->products_detail,
            // 'products_id' => $request->id,
    ];
    DB::insert('insert into products 
        ( date_year, date_month, persons_id, products_name, products_number, products_price, products_method, products_detail) values 
        (:date_year,:date_month,:persons_id,:products_name,:products_number,:products_price,:products_method,:products_detail)', $param);
    return redirect('products');
 
}




/*--------------------------------------------------- */
/* ptoduct_option
/*--------------------------------------------------- */
    public function add_option(Request $request)
    {

       $persons = DB::select('select * from persons');
        $products = DB::select('select * from products');
        return view('products.add_option')->with('products', $products)->with('persons', $persons);

   }


  public function create_option(Request $request)
   {
    $products = DB::select('select * from products');
    $products_options = DB::select('select * from products_options');
    

    $param = [
        'date_year' => $request->date_year,
        'date_month' => $request->date_month,
        'products_number' => $request->products_number,
        'persons_id' => $request->persons_id,
        'products_options_name' => $request->products_options_name,
        'products_options_price' => $request->products_options_price,
        'products_options_detail' => $request->products_options_detail,
    ];
    DB::insert('insert into products_options 
        ( date_year, date_month, products_number, persons_id, products_options_name, products_options_price, products_options_detail) values 
        (:date_year,:date_month,:products_number,:persons_id,:products_options_name,:products_options_price,:products_options_detail)', $param);
    return redirect('products');
}


    public function update_option(Request $request)
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
            
  $data = $this->show($request,'','products.index');

return $data;
    }

    public function delete_option(Request $request)
    {
        $validator = Validator::make($request->query(), ['products_options_id' => 'required'], ['products_options_id' => 'IDを指定してください。']);
        if ($validator->fails()) {
            return redirect('products')->withErrors($validator);
        }

        $param = ['products_options_id' => $request->products_options_id];
        $products_options = DB::select('select * from products_options where products_options_id=:products_options_id', $param);
        return view('products.delete_option', ['form' => $products_option[0]]);
    }



    public function remove_option(Request $request)
    {
        $param = ['products_options_id' => $request->products_options_id];
        DB::delete('delete from products_options where products_options_id=:products_options_id', $param);
$data = $this->show($request,'','products.index');

return $data;
    }


   //  public function add_option_ajax(Request $request)
   //  {
   //      //personを選択する事で商品データを絞り込み
   //      $products = DB::table('products')
   //      ->where('date_year','like','%'.$request->date_year.'%')
   //      ->where('date_month','like','%'.$request->date_month.'%')
   //      ->where('persons_id','like','%'.$request->persons_id.'%')
   //      ->get();   
   //      return view('products.add_option_ajax')->with('products', $products);
   // }

    public function ajax_products(Request $request) {

        //personを選択する事で商品データを絞り込み
        $products = DB::table('products')
        ->where('date_year','like','%'.$request->date_year.'%')
        ->where('date_month','like','%'.$request->date_month.'%')
        ->where('persons_id','like','%'.$request->persons_id.'%')
        ->get(); 
    return $products;

    }








}