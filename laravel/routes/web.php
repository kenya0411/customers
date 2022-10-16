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


/*--------------------------------------------------- */
/* LINE
/*--------------------------------------------------- */

// LINE メッセージ受信
Route::get('/line/webhook', 'LineMessengerController@webhook')->name('line.webhook');
Route::post('/line/webhook', 'LineMessengerController@webhook')->name('line.webhook');
 
// LINE メッセージ送信用
Route::get('/line/message', 'LineMessengerController@message');
// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/', function () {
//         return redirect('/home');
//     });

// });

// Route::group(['middleware' => ['auth','can:ship']], function () {
// Route::get('/home', function () {
//     return redirect('/ships');
//     });
    
// });

// Route::group(['middleware' => ['auth','can:admin']], function () {
// Route::get('/home', function () {
//     return redirect('/orders');
//     });

// });
// Route::group(['middleware' => ['auth','can:fortune']], function () {
// Route::get('/home', function () {
//     return redirect('/orders');
//     });

// });


// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/', function () {
//         return redirect('/home');
//     });

// });


    

//ログイン済みのみ
Route::group(['middleware' => ['auth']], function () {

/*--------------------------------------------------- */
/* person
/*--------------------------------------------------- */
Route::get('persons', 'PersonController@index');
// Route::get('persons', 'PersonController@index')->name('home')->middleware('can:admin');;
Route::post('persons', 'PersonController@post');

// Route::get('person/edit', 'PersonController@edit');
Route::post('person/edit', 'PersonController@update');

Route::get('persons/add', 'PersonController@add');
Route::post('persons/add', 'PersonController@create');

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


Route::post('products_options/add/ajax_change_products', 'ProductOptionController@ajax_change_products');//占い師や商品の監視用


/*--------------------------------------------------- */
/* Orders
/*--------------------------------------------------- */
Route::get('orders', 'OrderController@index');
Route::post('orders', 'OrderController@post');

Route::get('orders/ajax', 'OrderController@ajax_index');
Route::post('orders/ajax_search', 'OrderController@ajax_search');

Route::post('orders/ajax_modal_fortunes', 'OrderController@ajax_modal_fortunes');//鑑定結果の表示用（モーダルウインドウ）
Route::post('orders/ajax_get_total_price', 'OrderController@ajax_get_total_price');//月の合計料金を出力


//注文詳細
Route::get('orders/detail', 'OrderController@detail_index');
Route::get('orders/detail/ajax', 'OrderController@ajax_detail_index');//表示用
Route::post('orders/detail/ajax_update', 'OrderController@ajax_detail_update');//修正用
Route::get('orders/detail/ajax_change_products', 'OrderController@ajax_change_products');
Route::post('orders/detail/ajax_change_products', 'OrderController@ajax_change_products');//占い師や商品の監視用
Route::post('orders/detail/ajax_get_temporary_price', 'OrderController@ajax_get_temporary_price');//金額の取得
Route::post('orders/detail/ajax_delete', 'OrderController@ajax_delete');//注文情報を削除





//新規注文
Route::get('orders/add', 'OrderController@add_index');
Route::get('orders/add/ajax', 'OrderController@ajax_add_index');
Route::post('orders/add/ajax_add_commission_price', 'OrderController@ajax_add_commission_price');//手数料を表示
Route::post('orders/add/ajax_search_customers', 'OrderController@ajax_search_customers');//リピーターかどうかを確認
Route::post('orders/add/ajax_get_data_repeater', 'OrderController@ajax_get_data_repeater');//リピーターの場合情報を取得
Route::get('orders/add/ajax_add_update', 'OrderController@ajax_add_update');//新規注文用

Route::post('orders/add/ajax_add_update', 'OrderController@ajax_add_update');//新規注文用



/*--------------------------------------------------- */
/* Reserves
/*--------------------------------------------------- */
Route::get('reserves', 'ReserveController@index');
Route::post('reserves', 'ReserveController@post');

Route::get('reserves_test', 'ReserveController@index_test');

// Route::get('reserves/ajax', 'ReserveController@ajax_index');
Route::post('reserves/ajax', 'ReserveController@ajax_index');
Route::post('reserves/ajax_update', 'ReserveController@ajax_update');

Route::get('reserves/ajax_clipboard_copy', 'ReserveController@ajax_clipboard_copy');//クリップボードコピー用
Route::get('reserves/ajax_reserve_ship', 'ReserveController@ajax_reserve_ship');//発送確認用
Route::post('reserves/ajax_reserve_ship', 'ReserveController@ajax_reserve_ship');//発送確認用
Route::get('reserves/ajax_name_check', 'ReserveController@ajax_name_check');//名前確認用


/*--------------------------------------------------- */
/* Customers
/*--------------------------------------------------- */
Route::get('customers', 'CustomerController@index');
Route::post('customers', 'CustomerController@post');

Route::get('customers/ajax', 'CustomerController@ajax_index');
Route::get('customers/ajax_search', 'CustomerController@ajax_search');



//詳細ページ
Route::get('customers/detail', 'CustomerController@detail_index');
Route::get('customers/detail/ajax', 'CustomerController@ajax_detail_index');//表示用
Route::post('customers/detail/ajax_update', 'CustomerController@ajax_detail_update');//修正用



/*--------------------------------------------------- */
/* Ships
/*--------------------------------------------------- */

Route::get('ships', 'ShipController@index');
Route::post('ships', 'ShipController@post');
Route::get('ships_test', 'ShipController@index_test');

Route::get('ships/ajax', 'ShipController@ajax_index');
Route::post('ships/ajax_update', 'ShipController@ajax_update');
Route::post('ships/ajax_search', 'ShipController@ajax_search');

Route::post('ships/ajax_ship_shipped', 'ShipController@ajax_ship_shipped');//発送確認用
Route::post('ships/ajax_ship_finished', 'ShipController@ajax_ship_finished');//発送報告確認用



/*--------------------------------------------------- */
/* Lines
/*--------------------------------------------------- */
Route::get('lines', 'LineMessengerController@index');
Route::post('lines', 'LineMessengerController@post');
Route::get('lines/ajax', 'LineMessengerController@ajax_message');//ここ修正
Route::post('lines/ajax', 'LineMessengerController@ajax_message');
Route::post('lines/ajax_customers_search', 'LineMessengerController@ajax_customers_search');

//メッセージ送受信
Route::get('lines/messages', 'LineMessengerController@message_index');
Route::post('lines/messages', 'LineMessengerController@message_post');
Route::post('lines/messages/ajax', 'LineMessengerController@ajax_message');

// Route::get('lines/customers', 'LineMessengerController@ajax_lines_customers_update');
Route::post('lines/customers', 'LineMessengerController@lines_customers_update');//LINENユーザー情報編集
Route::post('lines/temporaries', 'LineMessengerController@lines_temporaries_post');//LINE投稿内容DBに保存
// Route::post('lines/customers/ajax', 'LineMessengerController@ajax_lines_customers_update');


/*--------------------------------------------------- */
/* Lines_mail
/*--------------------------------------------------- */
//メール設定
Route::get('lines/mails', 'LineMailController@index');
Route::post('lines/mails', 'LineMailController@index');

//ロード時にDBからデータを取得
Route::post('lines/mails/ajax', 'LineMailController@ajax_mail_index');

//新規メールアドレス追加
Route::post('lines/mails/ajax_new', 'LineMailController@ajax_mail_new');
//メールアドレス情報の修正
Route::post('lines/mails/ajax_update', 'LineMailController@ajax_mail_update');




/*--------------------------------------------------- */
/* Lines_person
/*--------------------------------------------------- */
//公式LINE設定
Route::get('lines/persons', 'LineMessengerController@person_index');
Route::post('lines/persons', 'LineMessengerController@person_index');


//ロード時にDBからデータを取得
Route::post('lines/persons/ajax', 'LineMessengerController@ajax_person_index');

//新規メールアドレス追加
Route::post('lines/persons/ajax_new', 'LineMessengerController@ajax_person_new');
//メールアドレス情報の修正
Route::post('lines/persons/ajax_update', 'LineMessengerController@ajax_person_update');



/*--------------------------------------------------- */
/* 設定
/*--------------------------------------------------- */
Route::get('setting/users', 'UserController@index');
Route::post('setting/users', 'UserController@post');
Route::post('setting/users/ajax', 'UserController@ajax_index');


//メールアドレス情報の修正
Route::post('setting/users/ajax_update', 'UserController@ajax_user_update');

/*--------------------------------------------------- */
/* テスト用
/*--------------------------------------------------- */
Route::get('vue', 'VueController@index');
Route::get('vue/ajax', 'VueController@ajax_index');


// Route::get('import_orders', 'VueController@csv_import_orders');
// Route::get('import_customers', 'VueController@csv_import_customers');
// Route::get('import_products', 'VueController@csv_import_products');
// Route::get('import_products_options', 'VueController@csv_import_products_options');
// Route::get('import', 'VueController@csv_import_all');

});

//省略
Route::group(['middleware'=>'auth'],function(){
//中略
        Route::get('/password/change','ChangePasswordController@edit')->name('password.form');
        Route::put('/password/change','ChangePasswordController@update')->name('password.change');
});

Auth::routes();
