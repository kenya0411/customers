<?php

namespace App\Http\Controllers;
use App\Products;
use App\Person;
use App\products_options;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VueController extends Controller
{
    

    public function ajax_products(Request $request) {
    //productの商品ナンバーを取得
    $value = $request->persons_id;

    // 商品を取得
    $products = products::where('persons_id', '=', $value)->get();
    return $products;

    }
    public function ajax_products_options(Request $request) {
    //productの商品ナンバーを取得
    $value = $request->products_id;
    $products = products::where('products_id', '=', $value)->first();
    $products_number = $products->products_number;

    // オプションを取得
    $products_options = products_options::where('products_number', '=', $products_number)->get();
    return $products_options;

    }

    public function index(Request $request) {
    $persons = Person::all();

        return view('vue')->with('persons', $persons);

    }






}