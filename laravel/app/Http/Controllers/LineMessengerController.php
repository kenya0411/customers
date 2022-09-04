<?php
namespace App\Http\Controllers;
//DB
use App\Customer;
use App\Order;
use App\Ship;
use App\Fortune;
use App\Products;
use App\products_options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//Line系
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
// use App\Models\User;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LineMessengerController extends Controller
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
        $data = $this->show_list($request,'lines.list_line');
        return $data;


    }
public function message_index(Request $request)
{
        $data = $this->show_list($request,'lines.message_line');
        return $data;


    }



    public function webhook(Request $request) {
        // LINEから送られた内容を$inputsに代入

        $inputs=$request->all();

        if(!empty($inputs['events'])) {

        $data = $this->get_message($request);
        return $data;
        }else{
        
        $reply = '111';
        $user_id = 'Ucb7718e5d65232dca709bdbe33f600c2';
        $data =$this->push_message($request,$user_id,$reply) ;

        }

    }

    public function get_message(Request $request) {
 
        $inputs=$request->all();

        // そこからtypeをとりだし、$message_typeに代入
        $message_type=$inputs['events'][0]['type'];

      file_put_contents("test/return.txt", var_export( $message_type , true));

        // メッセージが送られた場合、$message_typeは'message'となる。その場合処理実行。
        if($message_type=='message') {
  
             $message_arr= $inputs['events'][0]["message"];
             $message= $message_arr['text'];
      
            // replyTokenを取得
            $reply_token=$inputs['events'][0]['replyToken'];
      file_put_contents("test/return.txt", var_export( $reply_token , true));
 
            // LINEBOTSDKの設定
            $http_client = new CurlHTTPClient(config('services.line.channel_token'));

            $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);
            $user_id=$inputs['events'][0]['source']['userId'];
            // return  $user_id;
            // file_put_contents("return.txt", var_export( $textMessageBuilder , true));
        }else{
            return 'ok';
            
        }



    }

    public function push_message(Request $request,$user_id,$reply) {
$accessToken = config('services.line.messenger_secret');
$user_id = $user_id;

$text = [
    [
    'type' => 'text',
    'text' => $reply
    ],
];

$message = [
    'to' => $user_id,
    'messages' => $text,
    // 'client_id'     => $client_id,
    // 'client_secret' => $client_secret
];

$message = json_encode($message);

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $accessToken, 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/push');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$message = curl_exec($ch);
curl_close($ch);

        }
//     public function push_message(Request $request,$massage) {
// $raw = file_get_contents('php://input'); 
// $receive = json_decode($raw, true); // イベントを取得 
// $event = $receive['events'][0]; // 返信するトークンを取得 
// $replyToken = $event['replyToken']; // 返事するメッセージを作成 // テキスト 
// $message = [ 'type' => 'text',
//     'text' => 'こんにちは！',
// ];

// // アクセストークン
// $accessToken = config('services.line.messenger_secret');
//       file_put_contents("return.txt", var_export( $accessToken , true));

// // ヘッダーを設定
// $headers = [
//     'Content-Type: application/json',
//     'Authorization: Bearer '.$accessToken,
// ];

// // ボディーを設定
// $body = json_encode([
//             'replyToken' => $replyToken,
//             'messages'   => [
//                 $message,
//             ]
//         ]);

// // CURLオプションを設定
// $options = [
//     CURLOPT_URL            => 'https://api.line.me/v2/bot/message/reply',
//     CURLOPT_CUSTOMREQUEST  => 'POST',
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_HTTPHEADER     => $headers,
//     CURLOPT_POSTFIELDS     => $body,
// ];

// // 返信
// $curl = curl_init();
// curl_setopt_array($curl, $options);
// curl_exec($curl);
// curl_close($curl);

//         }


/*--------------------------------------------------- */
/* ajax
/*--------------------------------------------------- */




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



/*--------------------------------------------------- */
/* 一覧画面のajax
/*--------------------------------------------------- */
public function ajax_message(Request $request) {


    $lines_userid = $request->userid;

        $lines_customers = DB::table('lines_customers')
        ->where('is_delete','=',0)//論理削除されてないもの
        ->where('lines_customers_userid','=',$lines_userid)
        ->get();  

    $customers_id = $lines_customers[0]->customers_id;
    $persons_id = $lines_customers[0]->persons_id;

        $lines_messages = DB::table('lines_messages')
        ->where('lines_customers_userid','=',$lines_userid)
        ->where('is_delete','=',0)//論理削除されてないもの
        ->get();     

  $lines_list = [];
        if(!empty($lines_messages)){
                foreach ($lines_messages as $key => $value) {
        
                    // //顧客情報
                    $customers_data = DB::table('customers')
                    ->where('customers_id',$customers_id)
                    ->get();    

                    //鑑定士
                    $persons_data = DB::table('persons')
                    ->where('persons_id',$persons_id)
                    ->get(); 
         

                    $lines_list[$key] =array(
                        'lines_messages' => $value,
                        'customers' => !empty($customers_data[0]) ? $customers_data[0] : 0,
                        'persons' => !empty($persons_data[0]) ? $persons_data[0] : 0,
                    );
                }
        }
 file_put_contents("test/return.txt", var_export( $lines_list , true));


        return [
            "lines_customers"=>$lines_customers,  
            "lines_list"=>$lines_list,
        ];
}




}

