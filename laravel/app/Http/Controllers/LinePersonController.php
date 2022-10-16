<?php
namespace App\Http\Controllers;
//DB
use App\Line_person;
use App\Http\Controllers\Components\CommonFunction;


//post系？
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class LineMailController extends Controller
{




/*--------------------------------------------------- */
/* viewページ
/*--------------------------------------------------- */


public function index(Request $request)
{

        return view('lines.person_list')->with('post_status', $request->old());


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
/* 公式ラインの修正・削除分岐
/*--------------------------------------------------- */
public function ajax_person_update(Request $request) {

    $submit_name = $request->submit;//押したボタンの種類
    $lines_persons_id = $request->lines_persons_id;//lines_mails_mailaddress

    
    if( $submit_name == 'update'){//公式ラインの修正
    $data =$this->update_person_address($request);
    return $data;

    }else{//公式ラインの削除
    $data =$this->delete_person_address($request);
    return $data;


}
}


/*--------------------------------------------------- */
/* 公式ラインの修正
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
/* 公式ラインの削除
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

