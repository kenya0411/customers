<div class="detailFrom formSection ">   
<div class="inner">
    
 
        <dl>
         <dt>購入日</dt>
         <dd>        
          @{{ moment(orders.created_at ) }}
</dd>

<dt>商品ID</dt>
<dd>
    <input type="text" v-model="orders.orders_id">
</dd>
<dt>名前</dt>
<dd>
    
    <input type="text" v-model="customers.customers_name">

</dd>
<dt>ニックネーム</dt>
<dd>
    <input type="text" v-model="customers.customers_nickname">
    
</dd>
<dt>鑑定士</dt>
<dd>
    <select name="" id="" v-model="orders.persons_id" 
    v-on:change="change_products(orders.id,orders.persons_id,0,0);add_commission_price(orders.persons_id);">
        <option v-bind:value="person.persons_id" v-for="person in persons"> @{{ person.persons_name }}</option>

    </select>
</dd>
<dt>商品名</dt>
<dd>
        <select  
        v-model="orders.products_id"
        v-on:change="change_products(orders.id,orders.persons_id,orders.products_id,0)">
        <option value="0"> 選択してください。</option>

        <option v-bind:value="product.products_id" v-for="product in products"> @{{ product.products_name }}</option>

    </select>

</dd>
<dt>オプション名</dt>
<dd>
            <select  
            v-model="orders.products_options_id">
        <option value="0"> 選択してください。</option>

        <option v-bind:value="product_option.products_options_id" v-for="product_option in products_options"> @{{ product_option.products_options_name }}</option>

    </select>

</dd>
<dt>料金</dt>
<dd class="price_dd">
    <div class="flex">
        <div class="flex4">
            <div class="title">[仮の金額]</div>
    <input type="number" inputmode="numeric" v-model="temporary_price" >
        </div>
        <div class="flex4">
            <div class="title">[手数料]</div>
    <input type="number" inputmode="numeric" v-model="persons_platform_fee"  ><span>%</span>
    {{-- <input type="number" inputmode="numeric" v-bind:value="persons_selected.persons_platform_fee" ><span>%</span> --}}

        </div>
        <div class="flex4">
            <div class="calcBtn" v-on:click="calculator_price()">
                計算する
            </div>
        </div>
        <div class="flex4">
            <div class="title">[総計]</div>
    <input type="number" inputmode="numeric" v-model="orders.orders_price" >
            
        </div>
    </div>
</dd>
<dt>悩み</dt>
<dd>
    <textarea name="" id="" v-model="fortunes.fortunes_worry" v-bind:valie="fortunes.fortunes_worry" class="textarea1"></textarea>
</dd>
<dt>鑑定結果</dt>
<dd>
    <textarea name="" id="" v-model="fortunes.fortunes_answer" class="textarea1"></textarea>
</dd>
<dt>外注者</dt>
<dd>
    <select name="" id="" v-model="orders.users_id">
        <option value="0">選択してください</option>
        <option v-for="user in users" v-bind:value="user.id">@{{ user.nickname }}</option>
    </select>
</dd>
<dt>鑑定</dt>
<dd>
    <select name="" id="" v-model="orders.orders_is_reserve_finished">
        <option value="0"></option>
        <option value="1">鑑定済み</option>
    </select>
{{--     <span v-if="orders.orders_is_reserve_finished == '1'">鑑定済み</span>
<span v-if="orders.orders_is_ship_finished == '1'">発送済み</span> --}}
</dd>
<dt>発送</dt>
<dd>
        <select name="" id="" v-model="orders.orders_is_ship_finished">
        <option value="0"></option>
        <option value="1">発送済み</option>
        <option value="2">発送不要</option>
    </select>
</dd>
<dt>備考</dt>
<dd>
    <textarea name="" id="" v-model="orders.orders_notice" class="textarea2"></textarea>
</dd>
<dt>住所</dt>
<dd>
    <textarea name="" id="" v-model="customers.customers_address" class="textarea2"></textarea>
    

</dd>


</dl>

<div class="btnWrap">
    <div class="sendBtn pointer" v-on:click="submit_update(orders.id)">編集する</div>
</div>
<div class="deleteWrap">
    <div class="delete pointer" v-on:click="submit_delete(orders.id)">削除する</div>
</div>

</div>

</div>