<div class="send_message_request send_common_block" >
    <form action="/line/webhook" method="post">
    @csrf
    <input type="hidden" name="post_type" value="send">
        
    <div class="heading">
        
      <div class="title">
        メッセージを入力
    </div>
      </div>

    <div class="textare">
        <input type="hidden" name="lines_persons_id" v-bind:value="lines_persons.lines_persons_id">
        <textarea name="lines_messages_text" ></textarea>
    </div>

    <div class="send_wrap" >

        <button  name="submit" value="send">
            メッセージの送信
        </button>
    </div>
    <input type="hidden" name="lines_customers_userid" v-bind:value="lines_information.lines_customers_userid">
    <input type="hidden" name="users_id" v-bind:value="users.id">

    </form>

</div>
