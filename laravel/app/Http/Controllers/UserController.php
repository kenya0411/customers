<?php
namespace App\Http\Controllers;
//DB
use App\Users;
use App\User;

//post系？
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


//ユーザー認証
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{

        public function show_list($request,$redirect){

             $param = ['is_delete' => 0];
             $lines_customers = DB::select('select * from lines_customers where is_delete=:is_delete', $param);
             $lines_persons = DB::select('select * from lines_persons where is_delete=:is_delete', $param);
             $lines_messages = DB::select('select * from lines_messages where is_delete=:is_delete', $param);

             return view($redirect);

             // return view($redirect)->with('lines_customers', $lines_customers)->with('lines_persons', $lines_persons)->with('lines_messages', $lines_messages);
     }



/*--------------------------------------------------- */
/* viewページ
/*--------------------------------------------------- */


public function index(Request $request)
{


        // $data = $this->show_list($request,'setting.user_list');
        // return $data->with('post_status', $request->old());

             return view('setting.user_list');

    }

/*--------------------------------------------------- */
/* 一覧画面のajax
/*--------------------------------------------------- */
public function ajax_index(Request $request) {



        $lines_customers = DB::table('lines_customers')
        ->where('is_delete','=',0)//論理削除されてないもの
        ->get();     

        // $lines_persons = DB::table('lines_persons')
        // ->where('is_delete','=',0)//論理削除されてないもの
        // ->get();     

        // $lines_messages = DB::table('lines_messages')
        // ->where('is_delete','=',0)//論理削除されてないもの
        // ->get();     
  $lines_list = [];

        if(!empty($lines_customers)){


                foreach ($lines_customers as $key => $value) {
        
                    // //顧客情報
                    $customers_data = DB::table('customers')
                    ->where('customers_id',$value->customers_id)
                    ->get();    

                    //鑑定士
                    $persons_data = DB::table('persons')
                    ->where('persons_id',$value->persons_id)
                    ->get(); 

                    //鑑定内容
                    $lines_messages_data = DB::table('lines_messages')
                    ->where('lines_customers_userid',$value->lines_customers_userid)
                    ->get();    

                    //空の際に配列だけ用意
                    // $empty_products = ['products_id'=>0];
                    // $empty_products_options = ['products_options_id'=>0];
                    // $empty_users = ['id'=>0];
                    $lines_list[$key] =array(
                        'lines_customers' => $value,
                        'customers' => !empty($customers_data[0]) ? $customers_data[0] : 0,
                        'lines_messages' => !empty($lines_messages_data[0]) ? $lines_messages_data[0] : 0,
                        'persons' => !empty($persons_data[0]) ? $persons_data[0] : 0,
                    );
                }
        }

        return [
            "lines_customers"=>$lines_customers,  
            "lines_list"=>$lines_list,
        ];
}






}

