
<div class="list_mail_block send_common_block" v-if="lines_mails.length">
    <div class="heading_block">
        メールアドレス一覧
    </div>
<div class="wrap">
 <form action="/lines/mails/ajax_update" method="post" >
    @csrf

<ul>
    <li class="headBlock">
        <div>名前</div>
        <div>メールアドレス</div>
        <div>テストメール</div>
        <div>削除</div>

    </li>


    <li v-for="line_mail in lines_mails">

        <div class="tab_heading">
           
            @{{ line_mail.users_nickname }}
            <input type="hidden" name="users_id" v-bind:value="line_mail.users_id">
            <input type="hidden" name="users_nickname" v-bind:value="line_mail.users_nickname">
        </div>
        <div>
            <div class="pcInvi">メールアドレス</div>

            <input type="email" v-bind:name="`lines_mails_mailaddress[${line_mail.lines_mails_id}]`" v-bind:value="line_mail.lines_mails_mailaddress ">
        </div>
        <div>
          <div class="test_mail_wrap">
        <button name="send_mail" v-bind:value="line_mail.lines_mails_id" v-on:click="test_mail_confirm" >
            テストメールを送信
        </button>
    </div>       
        </div>
        <div>
          <div class="delete_wrap">
        <button name="delete" v-bind:value="line_mail.lines_mails_id" v-on:click="delete_confirm" >
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
