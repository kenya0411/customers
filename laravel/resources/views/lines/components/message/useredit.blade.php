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
        <dt>Line名</dt>
        <dd><input type="text" name="lines_customers_name" v-bind:value="lines_information.lines_customers_name">
    
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

