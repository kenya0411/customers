<?php
namespace App\Http\Controllers;
//DB
// use App\Users;
// use App\User;
// use App\Customer;
use App\Line_customer;
use App\Line_message;
// use App\Line_person;
use App\Line_temporary;
// use App\Line_mail;
use App\Http\Controllers\Components\CommonFunction;


//post系？
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//Line系
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

//ユーザー認証
use Illuminate\Support\Facades\Auth;

//メール機能
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class LineMessengerController extends Controller
{

   


/*--------------------------------------------------- */
/* viewページ
/*--------------------------------------------------- */


public function index(Request $request)
{

        return view('lines.message_list')->with('post_status', $request->old());



    }




/*--------------------------------------------------- */
/* webhook
/*--------------------------------------------------- */

    public function webhook(Request $request) {
        // $lstep = $this->push_lstep($request);//受信したメッセージをLステップに送信
        // LINEから送られた内容を$inputsに代入
        $inputs=$request->all();

        $post_type = !empty($request->post_type) ? $request->post_type : null;
        //メッセージを受信した場合
        if(!empty($inputs['events'])) {

        $data = $this->get_message($request);//受信したメッセージをDBに保存
        return [];
        
        }else{

        if(!empty($post_type)){
            //メッセージを送信or削除する場合
            $data = $this->send_temporary_deta($request);
            return $data;  
        }else{
        //公式LINEのユーザーIDを取得
        $data = $this->get_oficial_lineid($request,$inputs);
        // return $data;  

        }
        

        }

    }


public function push_lstep(Request $request) {
        $inputs=$request->all();
        $headers=$request->headers;
        // $test=$request;
    // $id=$inputs['events'];
    file_put_contents("test/return.txt", var_export($inputs, true));

    $inputs = json_encode($inputs);

    $channelSecret = 'ece0b2e527723fa0afe948179bd700ea';//零
    // $channelSecret = '845191daab69d06ed2aeb5d086335460';//test

    $httpRequestBody = file_get_contents('php://input');
    $json_object = json_decode($httpRequestBody);

    $hash  = hash_hmac('sha256', $httpRequestBody, $channelSecret, true);
    $signature = base64_encode($hash);

    // Webhooks送信用URLの作成
    $url = "https://rcv.linestep.net/v2/1657628128" ;
    $accessToken = "OnGkg+/VDypGzfiA2UDepij1Id7QWTJysF7QhrzGSa/P8h4C8K+5kU1SaA86IgLCpm5rfSK507E7ToJn/R8yp4t0XDdcytwT9kMmcFibEWyd+P4SggWHrX7mUXvUoHuRCaDa39If0JDg1xUvyz0Q0QdB04t89/1O/w1cDnyilFU=";//零
    // $accessToken = "xdK4psB3g40LlSAHsycfDsaRvA8//bFRrB0XnFNiRGd2R/dUN02YH+Q5GwHAxpCRERnxoGnb8p3Y0KAKEAEtb9ZQn0RG+jI5lA8IDY7crY+A/7UonUkWiZku0O3Va/BZLt8mcAbOt4mDrh6d8R4xMwdB04t89/1O/w1cDnyilFU=";//test
    // $url = "https://webhook.site/aa9f4cd9-ae5d-4b96-98d7-f1e79d5aee86" ;
    // $url = "http://webhook.site/8325f84b-87e6-40d1-b58c-59eb37cdabb1" ;

    // $http_client = new CurlHTTPClient($accessToken);
    // $bot = new LINEBot($http_client, ['channelSecret' => $channelSecret]);
    // $getMessageContent = $bot->getMessageContent($id);

    $curl = curl_init();
    $user_agent = $headers->get('user-agent');
    // $user_agent = "LineBotWebhook/2.0";
    // $head1 = 'Authorization: Bearer ' . $accessToken;
    // $head2 = 'Content-Type: application/json; charset=utf-8';
    // $head3 = 'x-line-signature: '.$signature;
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array( $head2,$head3));
    
    $header= array(
        'x-line-signature: '.$headers->get('x-line-signature'),
        'content-type: '.$headers->get('content-type'),
        // 'host: '.$headers->get('host'),
        'accept: ',
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    // HTTPでのPOST設定を行います
    curl_setopt($curl, CURLOPT_POST, 1);
    // 通信実施後の戻り値を、文字列に設定する
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // POSTパラメーターを設定します
    curl_setopt($curl, CURLOPT_POSTFIELDS, $inputs);

    // 通信の実行
    $response = curl_exec($curl);
    // $info = htmlspecialchars($response); 
    
    // if($response){
    //   return true;
    // }else{
    //   return false;
    // }

    // URLセッションを閉じる
    curl_close($curl);

    return $response;







// /*
// * getallheadersが使えなかったので代用
// */
// function getallheaders_not() {
//     if (!function_exists('getallheaders')) {
//         $headers = array();
//         foreach ($_SERVER as $name => $value) {
//             if (substr($name, 0, 5) == 'HTTP_') {
//                 $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
//             }
//         }
//         return $headers;
//     }
// }



    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $accessToken, 'Content-Type: application/json'));
    // curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/push');
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
}


/*--------------------------------------------------- */
/* webhook
/*--------------------------------------------------- */

public function get_oficial_lineid(Request $request,$inputs) {



if($inputs['destination']){


    $site_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] ;
    $data = [
        'name' => "ken",//送信元メールアドレス
        'from_email' => "info@customer.neobingostyle.com",//送信元メールアドレス
        'to_email' => "shimoda.kenya@gmail.com",//宛先
        'destination' => $inputs['destination'],
        'view' => "lines.components.mail.userid_mail",
        'subject' => "LINEのユーザーIDです。",//タイトル
        'site_name' => "注文管理システム",//サイトネーム
        'site_url' => $site_url ,//サイトネーム

    ];
        Mail::send(new SendMail($data));//メール送信




}


}

/*--------------------------------------------------- */
/* メッセージの送信or削除
/*--------------------------------------------------- */

public function send_temporary_deta(Request $request) {
     // 押したボタンの内容を判断
    $submit = $request->submit;
    $lines_customers_userid = $request->lines_customers_userid;//LINEの送信先ユーザーID

    //送信ボタンを押した場合、メッセージを送信
    if($submit == 'send'){
        $lines_messages_text = $request->lines_messages_text;//文章
        $send =$this->push_message($request,$lines_customers_userid,$lines_messages_text);//メッセージを送信
        $delete =$this->delete_temporary_deta($request);//DBから倫理削除

        return $send;

    }else{//取り消しボタンを押した場合、送信せずDBから論理削除
        $delete =$this->delete_temporary_deta($request);//DBから倫理削除
        //アラート用
        $post_status = array(
            'status' => 'delete',
            'type' => 'delete_mail_request',
        );
        //リダイレクト
        $get_status = redirect('/lines?userid='.$request->lines_customers_userid)->withInput($post_status);
        return  $get_status ;
    }


}

/*--------------------------------------------------- */
/* 一時保存した投稿データを削除
/*--------------------------------------------------- */
public function delete_temporary_deta(Request $request) {

    $param = [
    'lines_temporaries_id' => $request->lines_temporaries_id,
    'is_delete' => 1,
    'updated_at' => date( "Y-m-d H:i:s" , time() ),
    ];

    //DB情報を倫理削除
    DB::update('update lines_temporaries set 
    is_delete=:is_delete,
    updated_at=:updated_at
    where lines_temporaries_id=:lines_temporaries_id'
    , $param);

}


/*--------------------------------------------------- */
/* メッセージを送信
/*--------------------------------------------------- */
public function push_message(Request $request,$user_id,$reply) {
    // $accessToken = config('services.line.messenger_secret');
    
    //公式LINEの管理者の情報取得
    $lines_persons = DB::table('lines_persons')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_persons_id','=',$request->lines_persons_id)//既にメッセージがDBに保存されてるか確認
    ->first(); 

    //一番最後の取得からのメッセージを取得
    $lines_messages = DB::table('lines_messages')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_customers_userid','=',$user_id)//既にメッセージがDBに保存されてるか確認
    ->where('lines_messages_replytoken', '!=', '')//replytokenに値があるもの
    ->orderBy('lines_messages_id', 'desc')  // IDで降順にソート
    ->first();
    
    //返信用のリプライトークンを取得
    $replyToken = $lines_messages->lines_messages_replytoken;


    //アクセストークン
    $accessToken = $lines_persons->lines_persons_access_token;

    $text = [
        [
        'type' => 'text',
        'text' => $reply
        ],
    ];

    $message = [
        'replyToken' => $replyToken,
        'messages' => $text,
    ];

    $message = json_encode($message);

    $data =$this->push_message_add_database($request,$user_id,$reply);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $accessToken, 'Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/reply');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $message = curl_exec($ch);
    $err = curl_error($ch);//追記・エラーログ
    curl_close($ch);
    

    if ($err) {
        // cURLエラーが発生した場合、エラーメッセージをログに出力
        error_log("cURL Error: " . $err);
    }

    // $lines_messages や $replyToken のデータをログに出力
    error_log("lines_messages: " . print_r($lines_messages, true));
    error_log("replyToken: " . $replyToken);

    //アラート用
    $post_status = array(
        'status' => 'success',
        'type' => 'send_mail',
    );
    //リダイレクト
    $get_status = redirect('/lines?userid='.$request->lines_customers_userid)->withInput($post_status);
    return  $get_status ;
}
/*--------------------------------------------------- */
/* 送信したメッセージをＤＢに保存
/*--------------------------------------------------- */
public function push_message_add_database(Request $request,$user_id,$reply) {


    $Line_message = new Line_message();
    $Line_message->create([
        'lines_customers_userid' => $user_id,
        'lines_messages_text' => $reply,
        'lines_messages_from_userid' => "",
        'lines_messages_number' => 0,
        'lines_messages_replytoken' => "",
        'lines_messages_to_userid' => $user_id,
        'lines_messages_webhook_event_id' => "",
    ]);

}





/*--------------------------------------------------- */
/* 受信メッセージが来た時
/*--------------------------------------------------- */
    public function get_message(Request $request) {
        $inputs=$request->all();
        // そこからtypeをとりだし、$message_typeに代入
        $message_type=$inputs['events'][0]['type'];

        //カスタマー情報が存在するか確認
        $get_customer =$this->get_customer_add_database($request);


        // メッセージが送られた場合、$message_typeは'message'となる。その場合処理実行。
        if($message_type=='message') {
        //メッセージの種類を確認
        $type=$message_type=$inputs['events'][0]['message']['type'];

        $get_message_type =$this->get_message_type($request,$inputs);

 
            
        }
    }

/*--------------------------------------------------- */
/* LINEのユーザー情報を取得
/*--------------------------------------------------- */
public function get_user_profile(Request $request,$inputs,$user_id) {

    $lines_persons =$this->get_message_person($request,$inputs);//公式LINEの受信先を確認
    // $user_id=$inputs['events'][0]['source']['userId'];//顧客のユーザーIDを取得


    //LINEの情報にアクセス
    $http_client = new CurlHTTPClient($lines_persons['lines_persons_access_token']);
    $bot = new LINEBot($http_client, ['channelSecret' => $lines_persons['lines_persons_channel_secret']]);
    $response = $bot->getProfile($user_id);

    $result = [];

    if ($response->isSucceeded()) {
        //ユーザー情報取得
        $profile = $response->getJSONDecodedBody();

    $result = array(
      'userId' => $profile['userId'],//ユーザーID
      'displayName' => $profile['displayName'],//LINEの表示名
      'pictureUrl' => $profile['pictureUrl'],//プロフィール画像
      'persons_id' => $lines_persons['persons_id'],//担当者の番号
      'lines_persons_id' => $lines_persons['lines_persons_id'],//担当者のLINEの番号
      'lines_persons_userid' => $lines_persons['lines_persons_userid'],//担当者のLINEユーザーID
    );


}


return $result;

}

/*--------------------------------------------------- */
/* メッセージの内容を確認し、DBに保存＋メールを送信
/*--------------------------------------------------- */
public function get_message_type(Request $request,$inputs) {

             $message_arr= $inputs['events'][0]["message"];
             $message= $message_arr['text'];
        
            //受信メッセージが重複しないように
            $lines_messages = DB::table('lines_messages')
            ->where('is_delete','=',0)//論理削除されてないもの
            ->where('lines_messages_number','=',$message_arr['id'])//既にメッセージがDBに保存されてるか確認
            ->first(); 

            //新規のメッセージの場合
            if(empty($lines_messages)):
                //受信メッセージをデータベースに保存
               $data =$this->get_message_add_database($request,$inputs);//メッセージをDBに保存
               $lines_persons =$this->get_message_person($request,$inputs);//公式LINEの受信先を確認

                // replyTokenを取得(必要ないかも)
                $reply_token=$inputs['events'][0]['replyToken'];
     
                // LINEBOTSDKの設定
                // $http_client = new CurlHTTPClient(config('services.line.channel_token'));
                // $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);
                $http_client = new CurlHTTPClient($lines_persons['lines_persons_access_token']);
                $bot = new LINEBot($http_client, ['channelSecret' => $lines_persons['lines_persons_channel_secret']]);

                //カスタマーのLINEIDを取得
                $user_id=$inputs['events'][0]['source']['userId'];
                $check_ngword_message = $this->check_ngword_message($request,$message);
                //NGワードに含まれてない場合、メールを送信
                if($check_ngword_message == "send"){
                    //メッセージを受信したらメールを送信
                    $send_mail = $this->send_mail($request,$user_id,$message);
                }
            endif;

}

/*--------------------------------------------------- */
/* NGワードのチェック
/*--------------------------------------------------- */
public function check_ngword_message(Request $request,$message) {

    //NGワード
    $ngword = $this->ngword($request);

    //通常時はメールを送る
    $result = "send";

    //NGワードがメッセージに含まれてるか確認
    foreach ($ngword as $value) {
        //メッセージにNGワードが含まれてた場合、メールを送信しない。
        if (false !== strpos($message, $value)) {
            $result = 'unsend';
        }
    };
    return $result ;

}

/*--------------------------------------------------- */
/* NGワード
/*--------------------------------------------------- */
public function ngword(Request $request) {
    //NGワード
    $ngword = array(
        "]タロット占い",
        "右のタロットカード[",
        "中央のタロットカード[",
        "左のタロットカード[",
        "[●]",
    );
    return $ngword;


}

/*--------------------------------------------------- */
/* 公式LINEの受信先を確認
/*--------------------------------------------------- */
public function get_message_person(Request $request,$inputs) {
    //受信先の鑑定士を取得
    $lines_persons = DB::table('lines_persons')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_persons_userid','=',$inputs['destination'])//既にメッセージがDBに保存されてるか確認
    ->first(); 

    if(!empty($lines_persons)){

    // 配列に格納
    $result = array(
        'persons_id' =>$lines_persons->persons_id,
        'lines_persons_id' =>$lines_persons->lines_persons_id,
        'lines_persons_userid' =>$lines_persons->lines_persons_userid,
        'lines_persons_channel_id' =>$lines_persons->lines_persons_channel_id,
        'lines_persons_channel_secret' =>$lines_persons->lines_persons_channel_secret,
        'lines_persons_access_token' =>$lines_persons->lines_persons_access_token,
    );
    }else{
      $result =[];  
    };


    return $result;

}




/*--------------------------------------------------- */
/* メッセージを受信した時にカスタマー情報のDBに保存
/*--------------------------------------------------- */
public function get_customer_add_database(Request $request) {
    //受信メッセージの情報を取得
    $inputs=$request->all();
    
    //カスタマーのLINEIDを取得
    $user_id = $inputs['events'][0]['source']['userId'];

    //カスタマーのユーザー情報を取得
    $get_user_profile=$this->get_user_profile($request,$inputs,$user_id);


    //カスタマー情報が既に存在しているか確認
    $lines_customers = DB::table('lines_customers')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_customers_userid','=',$user_id)
    ->first();  


    //受信先（公式LINEのID取得）
    $destination_id = $inputs["destination"];


    //カスタマー情報が存在しない場合、新規にDBに追加
    if(empty( $lines_customers)){

        //情報をDBに保存
        $Line_customer = new Line_customer();
        $Line_customer->create([
            'lines_customers_userid' => $user_id,//ユーザー
            'lines_customers_name' => $get_user_profile['displayName'],
            'lines_customers_display_name' => $get_user_profile['displayName'],//LINEのユーザー名
            'lines_customers_picture_url' => $get_user_profile['pictureUrl'],//LINEの写真
            'persons_id' => $get_user_profile['persons_id'],
            'lines_persons_id' => $get_user_profile['lines_persons_id'],//公式LINEの番号
        ]);
    }else{

    //LINEの情報とDBの情報に差異がないか確認
    $compare =array(
        'display_name' => $get_user_profile['displayName'] == $lines_customers->lines_customers_display_name ? 'same' : null,
        'picture_url' => $get_user_profile['pictureUrl'] == $lines_customers->lines_customers_picture_url ? 'same' : null,
    );

    //LINEとDBの情報に差異があればアップデート
    if (empty($compare['display_name'])||empty($compare['picture_url'])) {
        //配列に保存
        $param = [
        'lines_customers_id' => $lines_customers->lines_customers_id,//LINEのDBの番号
        'lines_customers_display_name' => $get_user_profile['displayName'],//LINEのユーザー名
        'lines_customers_picture_url' => $get_user_profile['pictureUrl'],//LINEの写真
        'updated_at' => date( "Y-m-d H:i:s" , time() ),
        ];

        // //ユーザー情報をアップデート
        DB::update('update lines_customers set 
        lines_customers_display_name=:lines_customers_display_name,
        lines_customers_picture_url=:lines_customers_picture_url,
        updated_at=:updated_at
        where lines_customers_id=:lines_customers_id'
        , $param);

    }
    


    }
}



/*--------------------------------------------------- */
/* メッセージ受信時にメール送信
/*--------------------------------------------------- */
public function send_mail(Request $request,$user_id,$message) {
    //送信するメールアドレスを取得
    $lines_mails = DB::table('lines_mails')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->get();

    //LINEのカスタマー情報取得
    $lines_customers = DB::table('lines_customers')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_customers_userid','=',$user_id)//論理削除されてないもの
    ->first();

    //サイトのURL
    $site_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] ;
    //該当するユーザーページ
    $page_url = $site_url."/lines?userid=".$user_id;

    //各メールアドレスに送信
    foreach ($lines_mails as $key => $value) {
        //ユーザー情報取得
        $user = DB::table('users')
        ->where('id',$value->users_id)
        ->first(); //一つだけ取得 

        $data = [
            'name' => $user->nickname."様",//宛名
            'from_email' => "info@customer.neobingostyle.com",//送信元メールアドレス
            'to_email' => $value->lines_mails_mailaddress,//宛先
            'view' => "lines.components.mail.send_mail",
            'subject' => "新しいメッセージが届きました",//タイトル
            'site_name' => "注文管理システム",//サイトネーム
            'site_url' => $site_url ,//サイトURL
            'page_url' => $page_url ,//ページURL
            'customers_name' => $lines_customers->lines_customers_name ,//カスタマーの名前
            'date' => date( "m月d日" ) ,//日付
            'time' => date( "H時i分s秒" ) ,//時間

        ];
        Mail::send(new SendMail($data));//メール送信

    }



    
}


/*--------------------------------------------------- */
/* メッセージを受信した時にDBに保存
/*--------------------------------------------------- */
    public function get_message_add_database(Request $request,$inputs) {
      $event = $inputs['events'][0];

      //配列に保存
      $result = array(
        'destination' => $inputs['destination'],
        'id' => $event['message']['id'],
        'type' => $event['message']['type'],
        'text' => $event['message']['text'],
        'webhookEventId' => $event['webhookEventId'],
        'timestamp' => $event['timestamp'],
        'user_id' => $event['source']['userId'],
        'replyToken' => $event['replyToken'],
      );


    //ラインメッセージをDBに保存
    $Line_message = new Line_message();
    $Line_message->create([
        'lines_customers_userid' => $result['user_id'],
        'lines_messages_text' => $result['text'],
        'lines_messages_number' => $result['id'],
        'lines_messages_replytoken' => $result['replyToken'],
        'lines_messages_from_userid' => $result['user_id'],
        'lines_messages_to_userid' => $result['destination'],
        'lines_messages_webhook_event_id' => $result['webhookEventId'],
    ]);

}





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

    //LINEの情報を取得
    $lines_userid = $request->userid;

    //ラインに登録されたユーザーを取得
    $lines_customers = DB::table('lines_customers')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->get();  

    //最終のメッセージがどちらが最後か確認（New用）
    $lines_customers_list = $this->check_new_message($request,$lines_customers );


    //コメント返信者の情報を取得
    $users_list = DB::table('users')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('permissions_id','=',4)//コメント返信者
    ->get();  


    //空の値を入力
    // $lines_list = [];
    // $lines_information = [];
    // $users = [];
    // $persons = [];
    // $lines_temporaries = [];
    // $lines_persons = [];


    //LINEのユーザーIDを取得できる場合
    if(!empty($lines_userid )){
        $temp = $this->ajax_get_message($request,$lines_userid );

        //Lineメッセージ
        $lines_list = $temp['lines_list'];

        //LINEユーザーデータ
        $lines_information = $temp['lines_information'];

        //鑑定士のデータ
        $persons = $temp['persons'];

        //ユーザーデータ
        $users = $temp['users'];

        //公式LINEの情報を取得
        $lines_persons = $temp['lines_persons'];

        //テンポラリーデータ
        $lines_temporaries = $this->ajax_get_temporaries($request,$lines_userid);
    }


        return [
            // "lines_customers"=>$lines_customers_list,  
            "lines_customers"=>!empty($lines_customers_list) ? $lines_customers_list : [],
            "lines_list"=>!empty($lines_list) ? $lines_list : [],
            "lines_information"=>!empty($lines_information) ? $lines_information : [],
            "lines_information_reply"=>!empty($lines_information->lines_customers_reply_available) ? json_decode($lines_information->lines_customers_reply_available) : [],//デコード
            "users"=>!empty($users) ? $users : [],
            "users_list"=>!empty($users_list) ? $users_list : [],
            "lines_temporaries"=>!empty($lines_temporaries) ? $lines_temporaries : [],
            "persons"=>!empty($persons) ? $persons : [],
            "lines_persons"=>!empty($lines_persons) ? $lines_persons : [],

        ];

}

/*--------------------------------------------------- */
/* メッセージの受信
/*--------------------------------------------------- */
public function check_new_message(Request $request,$lines_customers ) {

    $lines_customers_list = [];
    //NGワード
    $ngword = $this->ngword($request);

    //最終のメッセージがどちらが最後か確認（New用）
     if(!empty($lines_customers)){
        foreach ($lines_customers as $key => $value) {  
                $lines_messages = DB::table('lines_messages')
                ->where('is_delete','=',0)//論理削除されてないもの
                ->where('lines_customers_userid','=',$value->lines_customers_userid)//ユーザーIDのメッセージを取得
                ->orderBy('lines_messages_id', 'desc')//最終のデータを取得
                ->first(); //1件のみ取得

                $temp_ngword = false;


            if(!empty($lines_messages)):
                foreach ($ngword as $word_key => $word_value) {
                    // lines_messages_textにNGワードが含まれる場合、Newを表示しない
                  if (false !== strpos($lines_messages->lines_messages_text, $word_value)) {
                        $temp_ngword = true;

                    }

                };
                    $lines_customers_list[]= [
                        'lines_customers_name'=> $value->lines_customers_name,
                        'lines_customers_userid'=> $value->lines_customers_userid,
                        'lines_messages_to_userid'=> $lines_messages->lines_messages_to_userid,
                        'lines_messages_updated_at'=> $lines_messages->updated_at,
                        'lines_messages_text'=> $lines_messages->lines_messages_text,
                        'lines_messages_ngword'=> $temp_ngword,
                    ];
            endif;
        }
    }
    //メッセージの最新順にソート
    $SortKey = array_column($lines_customers_list, 'lines_messages_updated_at');
    array_multisort($SortKey, SORT_DESC, $lines_customers_list);

    return $lines_customers_list;

}




/*--------------------------------------------------- */
/* メッセージの受信
/*--------------------------------------------------- */
public function ajax_get_message(Request $request,$lines_userid ) {
    $message_count = !empty($request->message_count) ? $request->message_count : 50;//取得するメッセージ数

    //ラインのお客様情報
    $lines_customers = DB::table('lines_customers')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_customers_userid','=',$lines_userid)
    ->get();  


    // 現在認証しているユーザーを取得
    $users = array(
        "id" => Auth::user()->id,
        "name" => Auth::user()->name,
        "nickname" => Auth::user()->nickname,
    );




    $customers_id = $lines_customers[0]->customers_id;
    $persons_id = $lines_customers[0]->persons_id;

    //鑑定士
    $persons_list = DB::table('persons')
    ->where('persons_id','=',$persons_id)
    ->where('is_delete','=',0)//論理削除されてないもの
    ->first();   



    //公式LINEを取得
    $lines_messages_to_userid = DB::table('lines_messages')//送信先の公式LINEのユーザーIDを取得
    ->where('lines_customers_userid','=',$lines_userid)
    ->where('is_delete','=',0)//論理削除されてないもの
    ->first();   
    $lines_messages_to_userid = $lines_messages_to_userid->lines_messages_to_userid;
    $lines_persons = DB::table('lines_persons')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_persons_userid','=',$lines_messages_to_userid)//公式LINEのユーザーIDで絞り込み
    ->first();   


    //ラインのメッセージ情報
    $lines_messages = DB::table('lines_messages')
    ->where('lines_customers_userid','=',$lines_userid)
    ->where('is_delete','=',0)//論理削除されてないもの
    // ->latest('lines_messages_id')//メッセージを取得する数
    ->orderBy('lines_messages_id', 'DESC')
    ->take($message_count)//メッセージを取得する数
    ->get();   
    //メッセージの最新順にソート

    // $lines_messages = Line_message::query();
    // $lines_messages=$lines_messages->where('is_delete','=',0);//論理削除
    // $lines_messages=$lines_messages->where('lines_customers_userid','=',$lines_userid);//
    // $lines_messages=$lines_messages->orderBy('lines_messages_id', 'DESC');
    // $lines_messages=$lines_messages->take($message_count);//
    // $lines_messages=$lines_messages->orderBy('lines_messages_id', 'ASC');
    // $lines_messages=$lines_messages->orderBy('lines_messages_id', 'ASC');

    // $lines_messages=$lines_messages->get();//



    //ラインのメッセージ情報を配列化
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
 
            //配列にまとめる
            $lines_list[$key] =array(
                'lines_messages' => $value,
                'lines_customers' => $lines_customers[0],
                'customers' => !empty($customers_data[0]) ? $customers_data[0] : 0,
                'persons' => !empty($persons_data[0]) ? $persons_data[0] : 0,
            );
        }
    }
    //配列を反対にする（takeを使う際に配列の順番を反対に取得してるから）
    $lines_list  =  array_reverse($lines_list);

    $result = array(
        'lines_list' => $lines_list,
        'lines_information' => $lines_customers[0],
        'users' => $users,
        'persons' => $persons_list,
        'lines_persons' => $lines_persons,
        // 'lines_person' => $lines_customers[0],
    );
    return $result;
}



/*--------------------------------------------------- */
/* テンポラリーデータを取得
/*--------------------------------------------------- */
public function ajax_get_temporaries(Request $request,$lines_userid) {

    //ラインのテンポラリーデータを取得(一時的に保存している投稿内容)
    $lines_temporaries = DB::table('lines_temporaries')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_customers_userid','=',$lines_userid)
    ->get();  



    //データが取得できない場合
    if(!empty($lines_temporaries[0])):

    //ユーザーID
    $users_id = $lines_temporaries[0]->users_id;

    //ラインのお客様情報
    $users = DB::table('users')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('id','=',$users_id)
    ->get();  

     $result = array(
        'lines_temporaries'=>$lines_temporaries[0],
        'user_info'=>$users[0],
    );       
    
    else:
     $result = array(
        'lines_temporaries'=>"",
        'user_info'=>"",
    );          
    endif;



    return $result;
}







/*--------------------------------------------------- */
/* ラインのユーザー情報を保存
/*--------------------------------------------------- */
public function lines_customers_update(Request $request) {


    //配列に保存
    $param = [
    'lines_customers_id' => $request->lines_customers_id,
    'lines_customers_userid' => $request->lines_customers_userid,
    'lines_customers_name' => $request->lines_customers_name,
    'customers_id' => $request->customers_id,
    'lines_customers_reply_available' => json_encode($request->lines_customers_reply_available),
    // 'persons_id' => $request->products_options_id,
    'updated_at' => date( "Y-m-d H:i:s" , time() ),
    ];

    //ユーザー情報をアップデート
    DB::update('update lines_customers set 
    lines_customers_userid=:lines_customers_userid,
    lines_customers_name=:lines_customers_name,
    customers_id=:customers_id,
    lines_customers_reply_available=:lines_customers_reply_available,
    updated_at=:updated_at
    where lines_customers_id=:lines_customers_id'
    , $param);

    //アラート用
    $post_status = array(
        'status' => 'success',
        'type' => 'update_user_info',
    );
    //リダイレクト
    $get_status = redirect('/lines?userid='.$request->lines_customers_userid)->withInput($post_status);
    return  $get_status ;
    // return redirect('/lines?userid='.$request->lines_customers_userid);

}
/*--------------------------------------------------- */
/* カスタマーの名前を検索
/*--------------------------------------------------- */
public function ajax_customers_search(Request $request) {

    $customers_name = $request->search_customers_name;
    $persons = $request->persons;


    // file_put_contents("test/return.txt", var_export($persons, true));

    //ラインに登録されたユーザーを取得
    $customers = DB::table('customers')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('persons_id','=',$persons['persons_id'])//論理削除されてないもの
    ->where('customers_name','like','%'.$customers_name.'%')
    ->orWhere('customers_nickname','like','%'.$customers_name.'%')
    ->get();  

    return $customers;

}



/*--------------------------------------------------- */
/* メッセージの送信情報をDBに保存
/*--------------------------------------------------- */
public function lines_temporaries_post(Request $request) {


    //投稿内容を一時的にDBに保存
    $Line_temporary = new Line_temporary();
    $Line_temporary->create([
        'lines_customers_userid' => $request->lines_customers_userid,
        'lines_messages_text' => $request->lines_messages_text,
        'users_id' => $request->users_id,
    ]);



    //アラート用
    $post_status = array(
        'status' => 'success',
        'type' => 'send_mail_request',
    );
    //リダイレクト
    $get_status = redirect('/lines?userid='.$request->lines_customers_userid)->withInput($post_status);
    return  $get_status ;

}





}