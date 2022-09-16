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
    <div class="details">

        <div class="customerBtn">
                <a v-bind:href='`/customers/detail/?id=${lines_information.customers_id}`'>
                お客様情報
            </a>
        </div>
    </div>

</div>


{{-- 受信メッセージ --}}
@include('lines.components.message.get_message')


{{-- 送信リクエスト用 --}}
@include('lines.components.message.send_request')


@can('admin')

{{-- リクエスト用 --}}
@include('lines.components.message.request')

{{-- ユーザー編集用 --}}
@include('lines.components.message.useredit')
@endcan


    </div>    
{{-- </div> --}}

{{-- </div>



</div> --}}