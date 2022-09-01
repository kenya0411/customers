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

        // そこからtypeをとりだし、$message_typeに代入
        $message_type=$inputs['events'][0]['type'];


        // メッセージが送られた場合、$message_typeは'message'となる。その場合処理実行。
        if($message_type=='message') {
  
             $message_arr= $inputs['events'][0]["message"];
             $message= $message_arr['text'];
      
            // replyTokenを取得
            $reply_token=$inputs['events'][0]['replyToken'];
 
            // LINEBOTSDKの設定
            $http_client = new CurlHTTPClient(config('services.line.channel_token'));

            $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);
            // 送信するメッセージの設定
            $reply_message='メッセージありがとうございます';
            $user_id=$inputs['events'][0]['source']['userId'];




        $textMessageBuilder = new TextMessageBuilder($reply_message);
      file_put_contents("return.txt", var_export( $textMessageBuilder , true));

        // $response    = $bot->pushMessage($user_id, $textMessageBuilder);

            // return $reply;
        }else{
            return 'ok';
            
        }
    }else{
            return 'okaaa';

    }


    }


    public function test(Request $request) {
$raw = file_get_contents('php://input'); 
$receive = json_decode($raw, true); // イベントを取得 
$event = $receive['events'][0]; // 返信するトークンを取得 
$replyToken = $event['replyToken']; // 返事するメッセージを作成 // テキスト 
$message = [ 'type' => 'text',
    'text' => 'こんにちは！',
];
      file_put_contents("return.txt", var_export( $event , true));

// アクセストークン
$accessToken = config('services.line.channel_token');

// ヘッダーを設定
$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer '.$accessToken,
];

// ボディーを設定
$body = json_encode([
            'replyToken' => $replyToken,
            'messages'   => [
                $message,
            ]
        ]);

// CURLオプションを設定
$options = [
    CURLOPT_URL            => 'https://api.line.me/v2/bot/message/reply',
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => $headers,
    CURLOPT_POSTFIELDS     => $body,
];

// 返信
$curl = curl_init();
curl_setopt_array($curl, $options);
curl_exec($curl);
curl_close($curl);

        }
    }

