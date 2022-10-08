<?php
namespace App\Http\Controllers;
//DB
use App\Users;
use App\User;
use App\Customer;
use App\Line_customer;
use App\Line_message;
use App\Line_person;
use App\Line_temporary;
use App\Line_mail;
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
        return $data->with('post_status', $request->old());


    }


public function mail_index(Request $request)
{

        $data = $this->show_list($request,'lines.mail_list');

        return $data->with('post_status', $request->old());


    }


public function person_index(Request $request)
{

        $data = $this->show_list($request,'lines.person_list');

        return $data->with('post_status', $request->old());


    }


/*--------------------------------------------------- */
/* webhook
/*--------------------------------------------------- */

    public function webhook(Request $request) {
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
        // file_put_contents("test/return.txt", var_export($inputs, true));
        }
        

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
    // 
    $lines_persons = DB::table('lines_persons')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_persons_id','=',$request->lines_persons_id)//既にメッセージがDBに保存されてるか確認
    ->first(); 

    $accessToken = $lines_persons->lines_persons_access_token;
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

                // replyTokenを取得
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
            
        }else{
            return 'ok';
           
        }
    }

/*--------------------------------------------------- */
/* NGワードのチェック
/*--------------------------------------------------- */
public function check_ngword_message(Request $request,$message) {

    //NGワード
    $ngword = array(
        "[1]タロット占い",
        "[2]タロット占い",
        "[3]タロット占い",
        "[4]タロット占い",
        "[5]タロット占い",
        "[6]タロット占い",
    );

    //通常時はメールを送る
    $result = "send";

    foreach ($ngword as $key) {

        if($key == $message){
         $result = 'unsend';//NGワードにメッセージが一緒の場合、メールを送信しない。
        }
    };

    return $result ;

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

    //カスタマー情報が既に存在しているか確認
    $lines_customers = DB::table('lines_customers')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_customers_userid','=',$user_id)
    ->first();  


    //受信先（公式LINEのID取得）
    $destination_id = $inputs["destination"];

    //受信先の公式ラインの情報を取得
    $lines_persons = DB::table('lines_persons')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->where('lines_persons_userid','=',$destination_id)
    ->first();  


    //カスタマー情報が存在しない場合、新規にDBに追加
    if(empty( $lines_customers)){

        //配列に保存
        $result = array(
        'lines_customers_userid' => $user_id,
        'lines_customers_name' => '新規ユーザー',
        'persons_id' => $lines_persons->persons_id,
        );
        // file_put_contents("test/return.txt", var_export($result, true));

        //情報をDBに保存
        $Line_customer = new Line_customer();
        $Line_customer->create([
            'lines_customers_userid' => $result['lines_customers_userid'],
            'lines_customers_name' => $result['lines_customers_name'],
            'persons_id' => $result['persons_id'],
        ]);
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
    $lines_customers_list = [];
$test = [];
    //最終のメッセージがどちらが最後か確認（New用）
     if(!empty($lines_customers)){
        foreach ($lines_customers as $key => $value) {  
                $lines_messages = DB::table('lines_messages')
                ->where('is_delete','=',0)//論理削除されてないもの
                ->where('lines_customers_userid','=',$value->lines_customers_userid)//ユーザーIDのメッセージを取得
                ->orderBy('lines_messages_id', 'desc')//最終のデータを取得
                ->first(); //1件のみ取得
                $test[] =$lines_messages;
                    file_put_contents("test/return.txt", var_export($test, true));

            if(!empty($lines_messages)):

                    $lines_customers_list[]= [
                        'lines_customers_name'=> $value->lines_customers_name,
                        'lines_customers_userid'=> $value->lines_customers_userid,
                        'lines_messages_to_userid'=> $lines_messages->lines_messages_to_userid,
                        'lines_messages_updated_at'=> $lines_messages->updated_at,
                    ];
            endif;
        }
    }

    //メッセージの最新順にソート
    $SortKey = array_column($lines_customers_list, 'lines_messages_updated_at');
    array_multisort($SortKey, SORT_DESC, $lines_customers_list);


    //空の値を入力
    $lines_list = [];
    $lines_information = [];
    $users = [];
    $persons = [];
    $lines_temporaries = [];
    $lines_persons = [];


    //LINEのユーザーIDを取得できる場合
    if(!empty($lines_userid )){
        $temp = $this->ajax_get_message($request,$lines_userid );
        $lines_list = $temp['lines_list'];//Lineメッセージ
        $lines_information = $temp['lines_information'];//LINEユーザーデータ
        $persons = $temp['persons'];//鑑定士のデータ
        $users = $temp['users'];//ユーザーデータ
        $lines_persons = $temp['lines_persons'];//公式LINEの情報を取得
        $lines_temporaries = $this->ajax_get_temporaries($request,$lines_userid);//テンポラリーデータ


    }


        return [
            "lines_customers"=>$lines_customers_list,  
            "lines_list"=> $lines_list,
            "lines_information"=>$lines_information,
            "users"=>$users,
            "lines_temporaries"=>$lines_temporaries,
            "persons"=>$persons,
            "lines_persons"=>$lines_persons,
        ];

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








//------------------------------------------------------------------------------------------------ 
// ここからはLINEメール設定
//------------------------------------------------------------------------------------------------ 



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


    //アラート用
    $post_status = array(
        'status' => 'success',
        'type' => 'new_mail',
    );
    //リダイレクト
    $get_status = redirect('/lines/mails')->withInput($post_status);
    return  $get_status ;
    // return redirect('/lines/mails');

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

    // 現在認証しているユーザーを取得
    $login_user = array(
        "id" => Auth::user()->id,
        "name" => Auth::user()->name,
        "nickname" => Auth::user()->nickname,
        "permissions_id" => Auth::user()->permissions_id,
    );


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

            //ログイン者がコメント返信者のみ
            if($login_user['permissions_id']== 4):
            if($user->id == $login_user['id']){
            //配列にまとめる
               $lines_mails_list[] =array(
                'users_id' => $user->id,
                'users_nickname' => $user->nickname,
                'lines_mails_mailaddress' => $value->lines_mails_mailaddress,
                'lines_mails_id' => $value->lines_mails_id,
            );             
           };

            else:
            //ログイン者が管理者
            //配列にまとめる
            $lines_mails_list[] =array(
                'users_id' => $user->id,
                'users_nickname' => $user->nickname,
                'lines_mails_mailaddress' => $value->lines_mails_mailaddress,
                'lines_mails_id' => $value->lines_mails_id,
            );
            endif;


        }
    }



    $result = array(
        'users' => $users,
        'lines_mails' => $lines_mails_list,
        'login_user' => $login_user,
    );
    return $result ;

}




/*--------------------------------------------------- */
/* メール設定の修正・削除
/*--------------------------------------------------- */
public function ajax_mail_update(Request $request) {

    $submit_name = $request->submit;//押したボタンの種類
    $lines_mails_id = $request->lines_mails_id;//lines_mails_mailaddress
    $lines_mails_mailaddress = $request->lines_mails_mailaddress;//ID

    
    if( $submit_name == 'update'){//メールアドレスの修正
    $data =$this->update_mail_address($request,$lines_mails_mailaddress);
    return $data;

    }elseif(!empty($request->send_mail)){//テストメールの送信
    $data =$this->send_test_mail($request);
    return $data;

    }else{//メールアドレスの削除
    $data =$this->delete_mail_address($request);
    return $data;


}





}

/*--------------------------------------------------- */
/* メールアドレスの修正
/*--------------------------------------------------- */
public function update_mail_address(Request $request,$lines_mails_mailaddress) {

    foreach ((array)$lines_mails_mailaddress as $key => $value) {
        $param = [
        'lines_mails_id' => $key,
        'lines_mails_mailaddress' => $value,
        'updated_at' => date( "Y-m-d H:i:s" , time() ),
        ];
        //ユーザー情報をアップデート
        DB::update('update lines_mails set 
        lines_mails_mailaddress=:lines_mails_mailaddress,
        updated_at=:updated_at
        where lines_mails_id=:lines_mails_id'
        , $param);
    }

    //アラート用
    $post_status = array(
        'status' => 'success',
        'type' => 'update_mail',
    );
    //リダイレクト
    $get_status = redirect('/lines/mails')->withInput($post_status);
    return  $get_status ;

}
/*--------------------------------------------------- */
/* メールアドレスの削除
/*--------------------------------------------------- */
public function delete_mail_address(Request $request) {
    $delete_id = $request->delete;//削除するID
    
    $param = [
    'lines_mails_id' => $delete_id,
    'is_delete' => 1,
    'updated_at' => date( "Y-m-d H:i:s" , time() ),
    ];
    //ユーザー情報を倫理削除
    DB::update('update lines_mails set 
    is_delete=:is_delete,
    updated_at=:updated_at
    where lines_mails_id=:lines_mails_id'
    , $param);

    // //アップデート後はリダイレクト
    $post_status = array(
        'status' => 'delete',
        'type' => 'delete_mail',
    );
    $get_status = redirect('/lines/mails')->withInput($post_status);
    return  $get_status ;

}





/*--------------------------------------------------- */
/* テストメール送信
/*--------------------------------------------------- */
public function send_test_mail(Request $request) {
    $send_mail_id = $request->send_mail;
    $to_email = $request->lines_mails_mailaddress[$send_mail_id];
    $site_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] ;
    $data = [
        'name' => $request->users_nickname."様",//宛名
        'from_email' => "info@customer.neobingostyle.com",//送信元メールアドレス
        'to_email' => $to_email,//宛先
        'view' => "lines.components.mail.test_mail",
        'subject' => "テストメールです。",//タイトル
        'site_name' => "注文管理システム",//サイトネーム
        'site_url' => $site_url ,//サイトネーム

    ];
        Mail::send(new SendMail($data));//メール送信


    //変数を渡してリダイレクト
    $post_status = array(
        'status' => 'success',
        'type' => 'testmail',
    );
    $get_status = redirect('/lines/mails')->withInput($post_status);
    return  $get_status ;
    
}





/*--------------------------------------------------- */
/* 公式LINEの情報を取得
/*--------------------------------------------------- */
public function ajax_person_index(Request $request) {
    //公式LINE一覧
   $lines_persons = DB::table('lines_persons')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->get(); 

    //鑑定士一覧
   $persons_list = DB::table('persons')
    ->where('is_delete','=',0)//論理削除されてないもの
    ->get(); 

    // file_put_contents("test/return.txt", var_export($lines_persons_id, true));

    $line_person_list =[];
    //配列化
    foreach ($lines_persons as $key => $value) {
        //占い師の情報を取得
       $persons = DB::table('persons')
        ->where('is_delete','=',0)//論理削除されてないもの
        ->where('persons_id','=',$value->persons_id)//論理削除されてないもの
        ->first(); 

        //配列化
        $line_person_list[] = array(
                'lines_persons' => $value,
                'persons' => $persons,

        );
    };

    $result = array(
     'lines_persons' => $line_person_list,
     'persons' => $persons_list,

    );


    return $result ;

}


/*--------------------------------------------------- */
/* 
/*--------------------------------------------------- */
public function ajax_person_update(Request $request) {

    $submit_name = $request->submit;//押したボタンの種類
    $lines_persons_id = $request->lines_persons_id;//lines_mails_mailaddress

    
    if( $submit_name == 'update'){//メールアドレスの修正
    $data =$this->update_person_address($request);
    return $data;

    }else{//メールアドレスの削除
    $data =$this->delete_person_address($request);
    return $data;


}
}


/*--------------------------------------------------- */
/* メールアドレスの修正
/*--------------------------------------------------- */
public function update_person_address(Request $request) {

  $lines_persons_id =  $request->lines_persons_id;

    foreach ((array)$lines_persons_id as $key => $value) {
        $param = [
        'lines_persons_id' => $value,
        'lines_persons_userid' => $request->lines_persons_userid[$value],
        'lines_persons_channel_id' => $request->lines_persons_channel_id[$value],
        'lines_persons_channel_secret' => $request->lines_persons_channel_secret[$value],
        'lines_persons_access_token' => $request->lines_persons_access_token[$value],
        'updated_at' => date( "Y-m-d H:i:s" , time() ),
        ];
        //ユーザー情報をアップデート
        DB::update('update lines_persons set 
        lines_persons_userid=:lines_persons_userid,
        lines_persons_channel_id=:lines_persons_channel_id,
        lines_persons_channel_secret=:lines_persons_channel_secret,
        lines_persons_access_token=:lines_persons_access_token,
        updated_at=:updated_at
        where lines_persons_id=:lines_persons_id'
        , $param);
    }

    //アラート用
    $post_status = array(
        'status' => 'success',
        'type' => 'update_person',
    );
    //リダイレクト
    $get_status = redirect('/lines/persons')->withInput($post_status);
    return  $get_status ;

}


/*--------------------------------------------------- */
/* 公式LINEの新規追加
/*--------------------------------------------------- */
public function ajax_person_new(Request $request) {


    //投稿内容を一時的にDBに保存
    $line_person = new line_person();
    $line_person->create([
        'persons_id' => $request->persons_id,
        'lines_persons_channel_id' => $request->lines_persons_channel_id,
        'lines_persons_channel_secret' => $request->lines_persons_channel_secret,
        'lines_persons_access_token' => $request->lines_persons_access_token,
    ]);


    //アラート用
    $post_status = array(
        'status' => 'success',
        'type' => 'new_person',
    );
    //リダイレクト
    $get_status = redirect('/lines/persons')->withInput($post_status);
    return  $get_status ;

}

/*--------------------------------------------------- */
/* メールアドレスの削除
/*--------------------------------------------------- */
public function delete_person_address(Request $request) {
    $delete_id = $request->delete;//削除するID
    
    $param = [
    'lines_persons_id' => $delete_id,
    'is_delete' => 1,
    'updated_at' => date( "Y-m-d H:i:s" , time() ),
    ];
    //ユーザー情報を倫理削除
    DB::update('update lines_persons set 
    is_delete=:is_delete,
    updated_at=:updated_at
    where lines_persons_id=:lines_persons_id'
    , $param);

    // //アップデート後はリダイレクト
    $post_status = array(
        'status' => 'delete',
        'type' => 'delete_person',
    );
    $get_status = redirect('/lines/persons')->withInput($post_status);
    return  $get_status ;

}



}

