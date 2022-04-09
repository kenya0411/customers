<div class="customersDetailFrom formSection ">   
<div class="inner">
    <dl>
        <dt>名前</dt>
        <dd>
            <input type="text" v-model="customers.customers_name">
    </dd>
        <dt>ニックネーム</dt>
        <dd>
            <input type="text" v-model="customers.customers_nickname">

    </dd>
        <dt>年齢</dt>
        <dd>
    <input type="number" inputmode="numeric" v-model="customers.customers_age" >

    </dd>
        <dt>住所</dt>
        <dd>
<textarea v-model="customers.customers_address" class="textarea2"></textarea>
        </dd>
        <dt>備考</dt>
        <dd>
<textarea v-model="customers.customers_note" class="textarea2"></textarea>
        </dd>
        <dt>初購入日</dt>
        <dd> @{{ moment(customers.created_at ) }}</dd>

    </dl>
<div class="btnWrap">
    <div class="sendBtn pointer" v-on:click="submit_update(customers.customers_id)">編集する</div>
</div> 



</div>

</div>