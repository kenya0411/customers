<div class="pcInvi">
    
<div class="backBlock">
    <div class="commonBtnFlex">
        
<div class="backBtn">
    <a href="#" onClick="history.back(); return false;">戻る</a>
</div>
<div class="backListBtn">
    <a href="/lines" >お客様一覧</a>
</div>
    </div>

</div>
</div>

<div class="line_message formSection " v-cloak>   
<div class="headingWrap">
    <div class="title">
    @{{ lines_information.lines_customers_name }}
    </div>
    <div class="select tabInvi">

<select name="select" onChange="location.href=value;">
  <option value="#">表示件数を変更</option>
  <option v-bind:value='`/lines?userid=${lines_information.lines_customers_userid}&message_count=50`'>50件</option>
  <option v-bind:value='`/lines?userid=${lines_information.lines_customers_userid}&message_count=100`'>100件</option>
  <option v-bind:value='`/lines?userid=${lines_information.lines_customers_userid}&message_count=200`'>200件</option>
  <option v-bind:value='`/lines?userid=${lines_information.lines_customers_userid}&message_count=300`'>300件</option>
</select>
    </div>
    <div class="details">

        <div class="customerBtn" v-if="lines_information.customers_id !== 0">
                <a v-bind:href='`/customers/detail/?id=${lines_information.customers_id}`'>
                お客様情報→
            </a>
        </div>
    </div>

</div>


{{-- 受信メッセージ --}}
@include('lines.components.message.get_message')

@can('comment')
<div class="commentMessage">

{{-- 送信リクエスト用 --}}
<div class="comment_request">    
@include('lines.components.message.send_request')
</div>    


{{-- 送信メッセージ --}}
<div class="comment_send" >
<div v-if="lines_temporaries.lines_temporaries ">
</div>
<div v-else> 
        
@{{send_direct_check(users.id,lines_information_reply)}}
@include('lines.components.message.send_message_comment')

</div>

</div>

</div>


@endcan



@can('admin')

{{-- 送信メッセージ --}}
@include('lines.components.message.send_message')

{{-- リクエスト用 --}}
@include('lines.components.message.request')

{{-- ユーザー編集用 --}}
@include('lines.components.message.useredit')
@endcan


    </div>    
{{-- </div> --}}

{{-- </div>



</div> --}}