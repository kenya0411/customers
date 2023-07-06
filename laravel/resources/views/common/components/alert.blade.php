@isset ($post_status["status"])

<div class="post_status_wrap {{$post_status["status"]}}">
   <div class="inner">
      
@if($post_status['type'] == 'testmail')
   テストメール送信完了しました。
@elseif($post_status['type'] == 'delete_mail')
メールアドレスを削除しました。
@elseif($post_status['type'] == 'update_mail')
メールアドレスを修正しました。
@elseif($post_status['type'] == 'new_mail')
メールアドレスを登録しました。
@elseif($post_status['type'] == 'update_user_info')
LINEのユーザー情報を修正しました。
@elseif($post_status['type'] == 'send_mail_request')
メッセージの送信依頼をしました。
@elseif($post_status['type'] == 'delete_mail_request')
メッセージの送信依頼を削除しました。
@elseif($post_status['type'] == 'send_mail')
メッセージを送信しました。
@elseif($post_status['type'] == 'push_mail')
プッシュメッセージを送信しました。
@elseif($post_status['type'] == 'delete_user')
ユーザーを削除しました。
@elseif($post_status['type'] == 'update_user')
ユーザー情報を修正しました。
@elseif($post_status['type'] == 'new_person')
公式LINEを新規追加しました。
@elseif($post_status['type'] == 'delete_person')
公式LINEを削除しました。
@elseif($post_status['type'] == 'update_person')
公式LINEを修正しました。
@endif      
   </div>

</div>
@endisset
