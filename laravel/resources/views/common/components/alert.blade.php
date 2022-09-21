@isset ($post_status["status"])

<div class="post_status_wrap {{$post_status["status"]}}">
   <div class="inner">
      
@if($post_status['type'] == 'testmail')
   テストメール送信完了しました。
@elseif($post_status['type'] == 'delete_mail')
メールアドレスを削除しました。
@elseif($post_status['type'] == 'update_mail')
メールアドレスを修正しました。
@endif      
   </div>

</div>
@endisset
