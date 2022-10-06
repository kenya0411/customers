<div class="new_person_block send_common_block">
    <div class="heading_block">
        公式LINEを追加する
    </div>
    <div class="wrap">
 <form action="/lines/persons/ajax_new" method="post">
    @csrf

        
<ul>
     <li class="headBlock">
         <div>名前</div>
        <div>チャネルID</div>
        <div>チャネルシークレット</div>
        <div>チャネルアクセストークン</div>
     </li>
     <li>
        <div>
            <div class="pcInvi">名前</div>
            <select name="persons_id">
                <option  v-bind:value="person.persons_id" v-for="person in persons">@{{ person.persons_name }}</option>
                {{-- <option v-bind:value="user.id"> @{{ user.nickname }}</option> --}}
         </select>
     </div>
     <div>
            <div class="pcInvi">チャネルID</div>
        <textarea name="lines_persons_channel_id"></textarea>
     </div>
         
     <div>
            <div class="pcInvi">チャネルシークレット</div>
        <textarea name="lines_persons_channel_secret"></textarea>
     </div>
         
     <div>
            <div class="pcInvi">lines_persons_access_token</div>
        <textarea name="lines_persons_access_token"></textarea>
     </div>
     </li>
 </ul>

     <div class="send_wrap">
        <button name="submit" value="send">
            公式LINEを追加する
        </button>
    </div>           


</form>
</div>

</div>