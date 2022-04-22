<div class="detailFrom formSection ">   
<div class="inner">
    
 
        <dl>
         <dt>日付</dt>
         <dd>        
          @{{ moment(orders.created_at ) }}
</dd>

<dt>商品ID</dt>
<dd>
    @{{orders.orders_id }}
</dd>
<dt>名前</dt>
<dd>
    @{{ customers.customers_name }}

</dd>

<dt>占いジャンル</dt>
<dd>

<div v-for="product in products">

    <span v-if="product.products_id === orders.products_id">
@{{ product.products_name }}
        
    </span>
</div>

</dd>


<dt>悩み</dt>
<dd>
    <textarea name="" id="" v-model="fortunes.fortunes_worry" readonly class="textarea1"></textarea>
</dd>
<dt>鑑定結果</dt>
<dd>
    <textarea name="" id="" v-model="fortunes.fortunes_answer" class="textarea1"></textarea>
</dd>
<dt>鑑定後の返信</dt>
<dd>
    <textarea name="" id="" v-model="fortunes.fortunes_reply1" class="textarea2"></textarea>
</dd>


<dt>備考</dt>
<dd>
    @{{ orders.orders_notice }}
</dd>



</dl>


</div>

</div>