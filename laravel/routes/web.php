<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    // return view('welcome');
    return view('auth/login');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return redirect('/orders');
    });

});
Route::get('/home', function () {
    // redirect関数にパスを指定する方法
    return redirect('/orders');
});
/*--------------------------------------------------- */
/* person
/*--------------------------------------------------- */
Route::get('persons', 'PersonController@index');
// Route::get('persons', 'PersonController@index')->name('home')->middleware('can:admin');;
Route::post('persons', 'PersonController@post');

// Route::get('person/edit', 'PersonController@edit');
Route::post('person/edit', 'PersonController@update');

Route::get('person/add', 'PersonController@add');
Route::post('person/add', 'PersonController@create');

Route::get('person/delete', 'PersonController@delete');
Route::post('person/delete','PersonController@remove');

/*--------------------------------------------------- */
/* product
/*--------------------------------------------------- */
Route::get('products', 'ProductController@index');
Route::post('products', 'ProductController@post');

//検索
// Route::get('products/search', 'ProductController@search');

//修正
Route::post('products/edit', 'ProductController@update');

//追加
Route::get('products/add', 'ProductController@add');
Route::post('products/add', 'ProductController@create');


//削除
Route::get('products/delete', 'ProductController@delete');
Route::post('products/delete','ProductController@remove');

//複製
// Route::post('products/clone', 'ProductController@clone');
Route::get('products/ajax','ProductController@ajax_index');
Route::get('products/ajax_search', 'ProductController@ajax_search');

/*--------------------------------------------------- */
/* products_options
/*--------------------------------------------------- */
Route::get('products_options', 'ProductOptionController@index');
Route::post('products_options', 'ProductOptionController@post');

//追加
Route::get('products_options/add', 'ProductOptionController@add');
Route::post('products_options/add', 'ProductOptionController@create');
// Route::get('products_options/add_option_ajax', 'ProductOptionController@ajax_products');
// Route::post('products/add_option_ajax', 'ProductController@ajax_products');

//修正
Route::post('products_options/edit', 'ProductOptionController@update');

//削除
Route::get('products_options/delete', 'ProductOptionController@delete_option');
Route::post('products_options/delete','ProductOptionController@remove_option');


Route::get('products_options/ajax','ProductOptionController@ajax_index');
Route::get('products_options/ajax_search', 'ProductOptionController@ajax_search');


/*--------------------------------------------------- */
/* Orders
/*--------------------------------------------------- */
Route::get('orders', 'OrderController@index');
Route::post('orders', 'OrderController@post');

Route::get('orders/ajax', 'OrderController@ajax_index');
Route::get('orders/ajax_search', 'OrderController@ajax_search');


/*--------------------------------------------------- */
/* Reserves
/*--------------------------------------------------- */
Route::get('reserves', 'ReserveController@index');
Route::post('reserves', 'ReserveController@post');

Route::get('reserves/ajax', 'ReserveController@ajax_index');
Route::get('reserves/ajax_update', 'ReserveController@ajax_update');
// Route::get('reserves/ajax_search', 'ReserveController@ajax_search');

/*--------------------------------------------------- */
/* Customers
/*--------------------------------------------------- */
Route::get('customers', 'CustomerController@index');
Route::post('customers', 'CustomerController@post');

Route::get('customers/ajax', 'CustomerController@ajax_index');
Route::get('customers/ajax_search', 'CustomerController@ajax_search');







/*--------------------------------------------------- */
/* Customers
/*--------------------------------------------------- */
// Route::get('customers', 'CustomerController@index');
// Route::post('customers', 'CustomerController@post');

// Route::get('customers/ajax', 'CustomerController@ajax_customers_index');
// Route::get('customers/ajax_search', 'CustomerController@ajax_customers_search');




// //検索
// Route::get('customers/search', 'CustomerController@search');

// //修正
// Route::post('customers/edit', 'CustomerController@update');

// //追加
// Route::get('customers/add', 'CustomerController@add');
// Route::post('customers/add', 'CustomerController@create');
// // Route::post('customers/ajax/add_product_ajax', 'CustomerController@add_product_ajax');
// // Route::post('customers/ajax/add_product_option_ajax', 'CustomerController@add_product_option_ajax');
// Route::get('customers/ajax/add', 'CustomerController@ajax_products');
// Route::get('customers/ajax/add_option', 'CustomerController@ajax_products_options');

// //削除
// Route::get('customers/delete', 'CustomerController@delete');
// Route::post('customers/delete','CustomerController@remove');



// //詳細
// Route::get('customers/detail', 'CustomerController@detail');
// Route::post('customers/detail/edit', 'CustomerController@detail_edit');

// Route::get('customers/detail/ajax', 'CustomerController@ajax_customers');
// Route::get('customers/detail/ajax_change', 'CustomerController@ajax_change');



// //予約
// //
// Route::get('customers/reserve', 'CustomerController@reserve');
// Route::post('customers/reserve', 'CustomerController@reserve_post');
// Route::get('customers/reserve_ajax', 'CustomerController@reserve_ajax');
// Route::post('customers/reserve_send', 'CustomerController@reserve_send');



// Route::get('ajax/vue', 'VueController@ajax_products');
// Route::get('ajax/vue_option', 'VueController@ajax_products_options');
Route::get('vue', 'VueController@index');
Route::get('vue/ajax', 'VueController@ajax_index');



// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'OrderController@index')->name('home');
