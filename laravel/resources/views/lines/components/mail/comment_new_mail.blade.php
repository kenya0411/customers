<div class="new_mail_block send_common_block">
    <div class="heading_block">
        メールアドレスを追加する
    </div>
    <div class="wrap">
 <form action="/lines/mails/ajax_new" method="post">
    @csrf

        
<ul>
     <li class="headBlock">
         <div>ユーザー名</div>
         <div>メールアドレス</div>
     </li>
     <li>
        <div>
            <div class="pcInvi">ユーザー名</div>
            <input type="hidden" name="users_id" v-bind:value="login_user.id">
            @{{login_user.nickname}}様

     </div>
     <div>
            <div class="pcInvi">メールアドレス</div>
        
         <input type="mail" name="lines_mails_mailaddress" required >
     </div>
         
     </li>
 </ul>

     <div class="send_wrap">
        <button name="submit" value="send">
            メールアドレスを追加する
        </button>
    </div>           


</form>
</div>

</div>