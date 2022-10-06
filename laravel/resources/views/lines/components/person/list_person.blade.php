<div class="list_person_block send_common_block"v-if="lines_persons.length">
    <div class="heading_block">
        公式LINE一覧
    </div>
<div class="wrap">
 <form action="/lines/persons/ajax_update" method="post" >
    @csrf

<ul>
    <li class="headBlock">
        <div>名前</div>
        <div>ユーザーID</div>
        <div>チャネルID</div>
        <div>チャネルシークレット</div>
        <div>チャネルアクセストークン</div>
        <div>削除</div>

    </li>


    <li v-for="line_person in lines_persons">

        <div class="tab_heading">
           @{{ line_person.persons.persons_name }}
<input type="hidden"v-bind:name="`lines_persons_id[${line_person.lines_persons.lines_persons_id}]`"  v-bind:value="line_person.lines_persons.lines_persons_id">
        </div>
        <div>
            <div class="pcInvi">ユーザーID</div>
            <textarea v-bind:name="`lines_persons_userid[${line_person.lines_persons.lines_persons_id}]`" rows="2" v-bind:value="line_person.lines_persons.lines_persons_userid"></textarea>
        </div>
        <div>
            <div class="pcInvi">チャネルID</div>
            <textarea v-bind:name="`lines_persons_channel_id[${line_person.lines_persons.lines_persons_id}]`" rows="2" v-bind:value="line_person.lines_persons.lines_persons_channel_id"></textarea>

    </div>       
        <div>
                     <div class="pcInvi">チャネルシークレット</div>
            <textarea v-bind:name="`lines_persons_channel_secret[${line_person.lines_persons.lines_persons_id}]`" rows="2" v-bind:value="line_person.lines_persons.lines_persons_channel_secret"></textarea>

    </div>       
        <div>
                     <div class="pcInvi">チャネルアクセストークン</div>
            <textarea  v-bind:name="`lines_persons_access_token[${line_person.lines_persons.lines_persons_id}]`" rows="2" v-bind:value="line_person.lines_persons.lines_persons_access_token"></textarea>

    </div> 
    <div>
        
          <div class="delete_wrap">
        <button name="delete" v-bind:value="line_person.lines_persons.lines_persons_id" v-on:click="delete_confirm" >
            削除
        </button>
    </div>  



    </div>
    </li>
</ul>
     <div class="send_wrap">
        <button name="submit" value="update">
            公式LINEを修正
        </button>
    </div>    

</form>

</div>
</div>
