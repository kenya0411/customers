
<div class="customer_block send_common_block">
    <div class="heading_block">
        返信文作成
    </div>
    <div class="wrap">
        

{{-- <form action="/lines/" method="post"> --}}
    {{-- @csrf --}}
    <dl>
        <dt>名前</dt>
        <dd><input type="text" v-model="gpt.name" ></dd>
        <dt>鑑定結果の出力</dt>
        <dd><select name="" id="">aaa</select>
@{{ lines_list }}
        </dd>

        <dt>悩み</dt>
        <dd><textarea v-model="gpt.worry"></textarea>
</dd>
        <dt>鑑定結果</dt>
        <dd><textarea  v-model="gpt.fortune"></textarea></dd>
        <dt>制約条件</dt>
        <dd><textarea v-model="gpt.rule"></textarea></dd>
        <dt>メッセージ</dt>
        <dd>
   
        	<textarea name="gpt.message" v-model="gpt.message" v-on:input="editedMessage = $event.target.value"></textarea>


</dd>

    </dl>
    <div class="customerBtnWrap">
        <button v-on:click="create_reply(gpt)">
            返信文作成
        </button>
    </div>
    {{-- <input type="hidden" name="lines_customers_id" v-bind:value="lines_information.lines_customers_id"> --}}
    {{-- <input type="hidden" name="lines_customers_userid" v-bind:value="lines_information.lines_customers_userid"> --}}
</form>
    </div>         
        </div>
