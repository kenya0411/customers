<div class="send_message_request send_common_block" >
    <form action="/lines/temporaries" method="post">
    {{-- <form action="/line/webhook" method="post"> --}}
    @csrf
        
    <div class="heading">
        
      <div class="title">
        メッセージを入力
    </div>
      </div>

    <div class="textare">
        <textarea name="lines_messages_text" id=""></textarea>
    </div>
    <div class="send_wrap"  v-if="lines_temporaries.lines_temporaries" >

        <button disabled class="disabled">
            メッセージの送信は出来ません
        </button>
        <div class="notice"><span>※既にメッセージが送信されています。</span><br>管理者がメッセージを送信or取り消す事で再度メッセージが送信出来ます。
                   
        送信時間： @{{ moment(lines_temporaries.lines_temporaries.created_at ) }}
        </div>
    </div>
    <div class="send_wrap"  v-else>

        <button  v-on:click="send_confirm">
            メッセージの送信依頼
        </button>
    </div>
    <input type="hidden" name="lines_customers_userid" v-bind:value="lines_information.lines_customers_userid">
    <input type="hidden" name="users_id" v-bind:value="users.id">
    </form>

</div>
