<div class="send_message_block send_common_block" v-if="lines_temporaries.lines_temporaries">
    <div class="heading_block">
        メッセージのリクエスト承認
    </div>
    <div class="wrap">
    <form action="/line/webhook" method="post">
    @csrf
    <input type="hidden" name="post_type" value="send">
        
    <div class="heading">
        
      <div class="title">
        @{{ lines_temporaries.user_info.nickname}}様
    </div>
    <div class="time">
    @{{ moment(lines_temporaries.lines_temporaries.created_at ) }}

    </div>
      </div>
    <div class="textare">
        <input type="hidden" name="lines_persons_id" v-bind:value="lines_persons.lines_persons_id">
        
        <textarea name="lines_messages_text" id="" cols="30" rows="10">@{{ lines_temporaries.lines_temporaries.lines_messages_text }}</textarea>
{{--   <pre>
      @{{ lines_temporaries }}
  </pre> --}}
    </div>
    <div class="btnFlex">
        <div class="leftBtnFlex">
     <div class="send_wrap">
        <button name="submit" value="send">
            メッセージの送信
        </button>
    </div>           
        </div>
        <div class="rightBtnFlex">
        <div class="delete_wrap margin_left">
        <button name="submit" value="delete" v-on:click="delete_confirm" >
            取り消し
        </button>
    </div>         
        </div>
    </div>    
    <input type="hidden" name="lines_customers_userid" v-bind:value="lines_information.lines_customers_userid">
    <input type="hidden" name="lines_temporaries_id" v-bind:value="lines_temporaries.lines_temporaries.lines_temporaries_id">

</form>
</div>

</div>