
<div class="list_mail_block send_common_block">
<div class="wrap">
 <form action="/lines/mails/ajax_new" method="post">
    @csrf

<ul>
    <li class="headBlock">
        <div>編集</div>
        <div>名前</div>
        <div>メールアドレス</div>
        <div>削除</div>
    </li>


    <li v-for="line_mail in lines_mails">
        <div>
            <input type="checkbox" name="edit">
            <input type="hidden" name="lines_mails_id" v-bind:value="line_mail.lines_mails_id">
        </div>
        <div>
            @{{ line_mail.users_nickname }}
        </div>
        <div>
            <input type="mail" v-bind:value="line_mail.lines_mails_mailaddress ">
        </div>
        <div>
          <div class="delete_wrap">
        <button name="submit" value="delete">
            削除
        </button>
    </div>       
        </div>

    </li>
</ul>

     <div class="send_wrap">
        <button name="submit" value="send">
            メールアドレスを修正
        </button>
    </div>    

</form>

</div>
</div>
