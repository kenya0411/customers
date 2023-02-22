
<div class="customer_block send_common_block">
    <div class="heading_block">
        ユーザー情報
    </div>
    <div class="wrap">
        

<form action="/lines/customers" method="post">
    @csrf
    <dl>
        <dt>お客様ID</dt>
        <dd><input type="text" name="customers_id" v-bind:value="lines_information.customers_id">
        </dd>
        <dt v-if="lines_information.customers_id==0">お客様ID検索</dt>
        <dd v-if="lines_information.customers_id==0"><input type="text" name="search_customers_name" v-model="search_customers_name">
            
            <select name="" v-if="search_customers_data" id="" style="margin-top:8px;width: 100%;">
                <option value="" v-for="e in search_customers_data" >
                【@{{ e.customers_id}}】
                    
                @{{ e.customers_name}}
                @{{ e.customers_nickname}}
            </option>
            </select>
        </dd>
        <dt>名前</dt>
        <dd><input type="text" name="lines_customers_name" v-bind:value="lines_information.lines_customers_name">
        </dd>
         <dt>Line名</dt>
        <dd>@{{ lines_information.lines_customers_display_name }}
        </dd>       
        <dt>鑑定士</dt>
        <dd>@{{ persons.persons_name }}
        </dd>
          <dt>チャネルID</dt>
        <dd>@{{ lines_persons.lines_persons_channel_id }}
        </dd>  

          <dt>確認不要の返信者</dt>
        <dd>
{{--             <span v-for="t in lines_information.lines_customers_reply_available">
                @{{t}}
            </span> --}}

            <ul class="reply_available_list" v-for="user in users_list">
                <li class="checkbox_wrap">
                <input type="checkbox" v-bind:id="user.name" 
                name="lines_customers_reply_available[]" 
                v-bind:value="user.id"
                > 
                <label v-bind:for="user.name">@{{user.nickname}}</label>
                
                </li>

            </ul>

        </dd>  
    </dl>
    <div class="customerBtnWrap">
        <button>
            更新
        </button>
    </div>
    <input type="hidden" name="lines_customers_id" v-bind:value="lines_information.lines_customers_id">
    <input type="hidden" name="lines_customers_userid" v-bind:value="lines_information.lines_customers_userid">
</form>
    </div>         
        </div>

