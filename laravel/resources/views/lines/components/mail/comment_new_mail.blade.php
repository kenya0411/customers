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
            <select name="users_id">
                <option  v-bind:value="user.id" v-for="user in users">@{{ user.nickname }}</option>
                {{-- <option v-bind:value="user.id"> @{{ user.nickname }}</option> --}}
         </select>
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