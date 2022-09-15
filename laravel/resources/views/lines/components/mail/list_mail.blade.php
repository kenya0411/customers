
<div class="list_mail_block send_common_block">
<div class="wrap">
 <form action="/lines/mails/ajax_update" method="post">
    @csrf

<ul>
    <li class="headBlock">
        <div>名前</div>
        <div>メールアドレス</div>
        <div>削除</div>

    </li>


    <li v-for="line_mail in lines_mails">

        <div>
            @{{ line_mail.users_nickname }}
        </div>
        <div>
            <input type="mail" v-bind:name="`lines_mails_mailaddress[${line_mail.lines_mails_id}]`" v-bind:value="line_mail.lines_mails_mailaddress ">
        </div>
        <div>
          <div class="delete_wrap">
        <button name="submit" v-bind:value="line_mail.lines_mails_id">
            削除
        </button>
    </div>       
        </div>

    </li>
</ul>
     <div class="send_wrap">
        <button name="submit" value="update">
            メールアドレスを修正
        </button>
    </div>    

</form>

</div>
</div>
