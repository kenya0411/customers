<?php
namespace App\Http\Controllers;
//DB
use App\Users;
use App\User;
use App\Customer;
use App\Line_customer;
use App\Line_message;
use App\Line_temporary;
use App\Line_mail;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//Line系
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
// use App\Models\User;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

//ユーザー認証
use Illuminate\Support\Facades\Auth;

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
        $data = $this->show_list($request,'lines.message_list');
        return $data;


    }


public function mail_index(Request $request)
{
        $data = $this->show_list($request,'lines.mail_list');
        return $data;


    }
// public function message_index(Request $request)
// {
//         $data = $this->show_list($request,'lines.message_line');
//         return $data;


//     }
// public function lines_customers_index(Request $request)
// {
//         $data = $this->show_list($request,'lines.update');
//         return $data;


//     }

/*--------------------------------------------------- */
/* webhook
/*--------------------------------------------------- */

    public function webhook(Request $request) {
        // LINEから送られた内容を$inputsに代入

        $inputs=$request->all();

        //メッセージを受信した場合
        if(!empty($inputs['events'])) {
        $data = $this->get_message($request);//受信したメッセージをDBに保存
        return $data;
        
        }else{

        //メッセージを送信or削除する場合
        $data = $this->send_temporary_deta($request);
        return $data;

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

    }else{//取り消しボタンを押した場合、送信せずDBから論理削除
        $delete =$this->delete_temporary_deta($request);//DBから倫理削除

    }
    //リダイレクト
    return redirect('/lines?userid='.$lines_customers_userid);

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
/* 
/*--------------------------------------------------- */
    public function get_message(Request $request) {
        $inputs=$request->all();
        // そこからtypeをとりだし、$message_typeに代入
        $message_type=$inputs['events'][0]['type'];

        $data =$this->get_message_add_database($request,$inputs);

        // メッセージが送られた場合、$message_typeは'message'となる。その場合処理実行。
        if($message_type=='message') {
                
             $message_arr= $inputs['events'][0]["message"];
             $message= $message_arr['text'];
      
            // replyTokenを取得
            $reply_token=$inputs['events'][0]['replyToken'];
 
            // LINEBOTSDKの設定
            $http_client = new CurlHTTPClient(config('services.line.channel_token'));

            $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);
            $user_id=$inputs['events'][0]['source']['userId'];
      // file_put_contents("test/test.txt", var_export( $user_id , true));

            // return  $user_id;
        }else{
            return 'ok';
            
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
        'lines_messages_replytoken' => $result['replyToken'],
        'lines_messages_from_userid' => $result['user_id'],
        'lines_messages_to_userid' => $result['destination'],
        'lines_messages_webhook_event_id' => $result['webhookEventId'],
    ]);

}



/*--------------------------------------------------- */
/* メッセージを送信
/*--------------------------------------------------- */
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

    $data =$this->push_message_add_database($request,$user_id,$reply);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $accessToken, 'Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/push');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $message = curl_exec($ch);
    curl_close($ch);

}
/*--------------------------------------------------- */
/* 
/*--------------------------------------------------- */
public function push_message_add_database(Request $request,$user_id,$reply) {


    $Line_message = new Line_message();
    $Line_message->create([
        'lines_customers_userid' => $user_id,
        'lines_messages_text' => $reply,
        'lines_messages_from_userid' => "",
        'lines_messages_replytoken' => "",
        'lines_messages_to_userid' => $user_id,
        'lines_messages_webhook_event_id' => "",
    ]);

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

    //LINEの情報を取得
    $lines_userid = $request->userid;
    $lines_customers = DB::table('lines_customers')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->get();  

    //空の値を入力
    $lines_list = [];
    $lines_information = [];
    $users = [];
    $lines_temporaries = [];

    //LINEのユーザーIDを取得出来ない場合
    if(!empty($lines_userid )){
        $temp = $this->ajax_get_message($request,$lines_userid);
        $lines_list = $temp['lines_list'];//Lineメッセージ
        $lines_information = $temp['lines_information'];//LINEユーザーデータ
        $users = $temp['users'];//ユーザーデータ
        $lines_temporaries = $this->ajax_get_temporaries($request,$lines_userid);//テンポラリーデータ


    }

 // file_put_contents("test/return.txt", var_export( $lines_customers[0] , true));

        return [
            "lines_customers"=>$lines_customers,  
            "lines_list"=> $lines_list,
            "lines_information"=>$lines_information,
            "users"=>$users,
            "lines_temporaries"=>$lines_temporaries,
        ];

}


/*--------------------------------------------------- */
/* メッセージの受信
/*--------------------------------------------------- */
public function ajax_get_message(Request $request,$lines_userid) {

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


    //ラインのメッセージ情報
    $lines_messages = DB::table('lines_messages')
    ->where('lines_customers_userid','=',$lines_userid)
    ->where('is_delete','=',0)//論理削除されてないもの
    ->get();     

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

    $result = array(
        'lines_list' => $lines_list,
        'lines_information' => $lines_customers[0],
        'users' => $users,
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
    // 'persons_id' => $request->products_options_id,
    'updated_at' => date( "Y-m-d H:i:s" , time() ),
    ];

    //ユーザー情報をアップデート
    DB::update('update lines_customers set 
    lines_customers_userid=:lines_customers_userid,
    lines_customers_name=:lines_customers_name,
    customers_id=:customers_id,
    updated_at=:updated_at
    where lines_customers_id=:lines_customers_id'
    , $param);

    //アップデート後はリダイレクト
    return redirect('/lines?userid='.$request->lines_customers_userid);

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



    //リダイレクト
    return redirect('/lines?userid='.$request->lines_customers_userid);

}







/*--------------------------------------------------- */
/* LINE用のメールアドレスを新規追加
/*--------------------------------------------------- */
public function ajax_mail_new(Request $request) {


    //投稿内容を一時的にDBに保存
    $Line_mail = new line_mail();
    $Line_mail->create([
        'lines_mails_mailaddress' => $request->lines_mails_mailaddress,
        'users_id' => $request->users_id,
    ]);



    return redirect('/lines/mails');

}


/*--------------------------------------------------- */
/* メール設定を取得
/*--------------------------------------------------- */
public function ajax_mail_index(Request $request) {

    //ラインのお客様情報
    $permissions_id_comment = 4;//コメント専用
    $permissions_id_admin = 1;//admin専用

    //ユーザー情報を取得
    $users = Users::query();
    $users=$users->where('is_delete','=',0);//論理削除
    $users=$users->Where('permissions_id','=',$permissions_id_comment)->orWhere('permissions_id','=',$permissions_id_admin);
    $users=$users->get();


    //設定されたメールアドレスを取得
    $lines_mails = DB::table('lines_mails')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->get();  



    //ラインのメールアドレス情報を配列化
  $lines_mails_list = [];
    if(!empty($lines_mails)){
        foreach ($lines_mails as $key => $value) {

            //ユーザー情報
            $user = DB::table('users')
            ->where('id',$value->users_id)
            ->first(); //一つだけ取得   
 
            //配列にまとめる
            $lines_mails_list[$key] =array(
                'users_id' => $user->id,
                'users_nickname' => $user->nickname,
                'lines_mails_mailaddress' => $value->lines_mails_mailaddress,
                'lines_mails_id' => $value->lines_mails_id,
            );
        }
    }



    $result = array(
        'users' => $users,
        'lines_mails' => $lines_mails_list,
    );
    return $result ;

}






}
