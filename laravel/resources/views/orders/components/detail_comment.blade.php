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
<dt>鑑定後の返信</dt>
<dd>
        <div class="textBox pre-line textarea2" >
          @{{ change_name(fortunes.fortunes_reply1  ) }}

        </div>
</dd>


<dt>備考</dt>
<dd>
    @{{ orders.orders_notice }}
</dd>



</dl>


</div>

</div>