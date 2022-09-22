<?php
namespace App\Http\Controllers;
//DB
use App\Users;
use App\User;

//post系？
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//ハッシュ化（パスワード生成用）
use Illuminate\Support\Facades\Hash;

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



    $users = DB::table('users')
        ->where('is_delete','=',0)//論理削除されてないもの
        ->get();   
    //メッセージの最新順にソート
    // $SortKey = array_column($users, 'permissions_id');
    // array_multisort($SortKey, SORT_DESC, $users);

        $users_deleted = DB::table('users')
        ->where('is_delete','=',1)//論理削除されてるもの
        ->get();

        $permissions = DB::table('permissions')
        ->where('is_delete','=',0)//論理削除されてるもの
        ->get();


        return [
            "users"=>$users,  
            "users_deleted"=>$users_deleted,
            "permissions"=>$permissions,
        ];
    }


/*--------------------------------------------------- */
/* メール設定の修正・削除
/*--------------------------------------------------- */
public function ajax_user_update(Request $request) {

    $submit_name = $request->submit;//押したボタンの種類
    $users_id = $request->users_id;//ユーザーID

    
    if( $submit_name == 'update'){//の修正
        $data =$this->update_user_information($request,$users_id);
        return $data;

    }else{//メールアドレスの削除
        $data =$this->delete_user_information($request);
        return $data;


    }

}

/*--------------------------------------------------- */
/* メールアドレスの修正
/*--------------------------------------------------- */
public function update_user_information(Request $request,$users_id) {

    foreach ((array)$users_id as $key => $value) {
        if(empty($request->users_password[$value])){

            $param = [
                'id' => $value,
                'name' => $request->users_name[$value],
                'nickname' => $request->users_nickname[$value],
                'permissions_id' => $request->permissions_id[$value],
                'updated_at' => date( "Y-m-d H:i:s" , time() ),
            ];
            //ユーザー情報をアップデート
            DB::update('update users set 
                name=:name,
                nickname=:nickname,
                permissions_id=:permissions_id,
                updated_at=:updated_at
                where id=:id'
                , $param);
        }else{
            $param = [
                'id' => $value,
                'name' => $request->users_name[$value],
                'nickname' => $request->users_nickname[$value],
                'password' => Hash::make($request->users_password[$value]),
                'permissions_id' => $request->permissions_id[$value],
                'updated_at' => date( "Y-m-d H:i:s" , time() ),
            ];
             //ユーザー情報をアップデート
            DB::update('update users set 
                name=:name,
                nickname=:nickname,
                password=:password,
                permissions_id=:permissions_id,
                updated_at=:updated_at
                where id=:id'
                , $param);

        }

    }

    //アラート用
    $post_status = array(
        'status' => 'success',
        'type' => 'update_mail',
    );
    //リダイレクト
    $get_status = redirect('/setting/users')->withInput($post_status);
    return  $get_status ;

}
/*--------------------------------------------------- */
/* メールアドレスの削除
/*--------------------------------------------------- */
public function delete_user_information(Request $request) {
    $delete_id = $request->delete;//削除するID
    
    $param = [
        'id' => $delete_id,
        'is_delete' => 1,
        'updated_at' => date( "Y-m-d H:i:s" , time() ),
    ];
    //ユーザー情報を倫理削除
    DB::update('update users set 
        is_delete=:is_delete,
        updated_at=:updated_at
        where id=:id'
        , $param);

    // //アップデート後はリダイレクト
    $post_status = array(
        'status' => 'delete',
        'type' => 'delete_user',
    );
    $get_status = redirect('/setting/users')->withInput($post_status);
    return  $get_status ;

}




}

