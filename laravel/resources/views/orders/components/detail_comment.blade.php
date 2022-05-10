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
    <div class="textBox pre-line textarea1">
          @{{ change_name(fortunes.fortunes_worry  ) }}
        
    </div>
</dd>
<dt>鑑定結果</dt>
<dd>
        <div class="textBox pre-line textarea1">
@{{ fortunes.fortunes_answer }}
        {{--  --}}
    </div>
</dd>

<dt>鑑定後のお礼メッセージ</dt>
<dd>
    <textarea name="" id="" v-model="fortunes.fortunes_reply1" class="textarea2"></textarea>
</dd>

<dt>お礼の返信</dt>
<dd>
    <textarea name="" id="" v-model="fortunes.fortunes_reply_answer1" class="textarea2"></textarea>
</dd>


<dt>備考</dt>
<dd>
    @{{ orders.orders_notice }}
</dd>



</dl>

<div class="btnWrap">
    <div class="sendBtn pointer" v-on:click="submit_update(orders.id)">編集する</div>
</div>
</div>

</div>