<?php
namespace App\Http\Controllers;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use App\Models\User;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
 
use Illuminate\Http\Request;

class LineMessengerController extends Controller
{
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



}

