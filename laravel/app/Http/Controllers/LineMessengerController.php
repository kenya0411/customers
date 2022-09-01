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
      file_put_contents("return.txt", var_export( $inputs , true));
 
        if(!empty($inputs['events'])) {

        // そこからtypeをとりだし、$message_typeに代入
        $message_type=$inputs['events'][0]['type'];


        // メッセージが送られた場合、$message_typeは'message'となる。その場合処理実行。
        if($message_type=='message') {
  
             $message_arr= $inputs['events'][0]["message"];
             $message= $message_arr['text'];
       file_put_contents("test/test.txt", var_export($inputs, true));
      
            // replyTokenを取得
            $reply_token=$inputs['events'][0]['replyToken'];
 
            // LINEBOTSDKの設定
            $http_client = new CurlHTTPClient(config('services.line.channel_token'));

            $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);
            // 送信するメッセージの設定
            $reply_message='メッセージありがとうございます';
            $user_id=$inputs['events'][0]['source']['userId'];

// $textMessageBuilder = new LINEBot\MessageBuilder\TextMessageBuilder('hello');
// $response = $bot->replyMessage($reply_token, $textMessageBuilder);
      file_put_contents("test/return.txt", var_export( $user_id , true));
       file_put_contents("test/message.txt", var_export($reply_message, true));
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();






            // ユーザーにメッセージを返す
            $reply=$bot->replyText($reply_token, $reply_message);
            
            return $reply;
        }else{
            return 'ok';
            
        }
    }else{
            return 'okaaa';

    }


    }


    public function test(Request $request) {
//データ取得
$json_string = file_get_contents('php://input');
$json_object = json_decode($json_string);
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('xdK4psB3g40LlSAHsycfDsaRvA8//bFRrB0XnFNiRGd2R/dUN02YH+Q5GwHAxpCRERnxoGnb8p3Y0KAKEAEtb9ZQn0RG+jI5lA8IDY7crY+A/7UonUkWiZku0O3Va/BZLt8mcAbOt4mDrh6d8R4xMwdB04t89/1O/w1cDnyilFU=');
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '845191daab69d06ed2aeb5d086335460']);
        $response = $bot->getMessageContent('0');
        if ($response->isSucceeded()) {
        $tempfile = tmpfile();
        fwrite($tempfile, $response->getRawBody());
        } else {
        error_log($response->getHTTPStatus() . ' ' . $response->getRawBody());
        }
        file_put_contents("test.txt", var_export($json_object, true));
        return 'test_ok';


        }
    }

