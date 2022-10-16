<?php
namespace App\Http\Controllers;
//DB
use App\Users;
use App\Line_mail;
use App\Http\Controllers\Components\CommonFunction;


//post系？
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


//ユーザー認証
use Illuminate\Support\Facades\Auth;

//メール機能
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class LineMailController extends Controller
{

      



/*--------------------------------------------------- */
/* viewページ
/*--------------------------------------------------- */


public function index(Request $request)
{


        return view('lines.mail_list')->with('post_status', $request->old());


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




}