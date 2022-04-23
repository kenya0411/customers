<div class="customersDetailFrom formSection ">   
<div class="inner">
    <dl>
        <dt>名前</dt>
        <dd>
            @{{ customers.customers_name }}
    </dd>
   
        <dt>年齢</dt>
        <dd>
            @{{ customers.customers_age }}

    </dd>
        
        <dt>備考</dt>
        <dd>
            @{{ customers.customers_note }}
        </dd>
        <dt>初購入日</dt>
        <dd> @{{ moment(customers.created_at ) }}</dd>
        <dt>注文情報</dt>
        <dd> 
            <ul v-for="order in orders">
                <li>
                    
                <a v-bind:href='`/orders/detail/?id=${order.id}`'>
                【 @{{ moment(order.created_at ) }}】 @{{ products[order.products_id].products_name }}  
                    
                </a>
                </li>

            </ul>
        </dd>
    </dl>




</div>

</div>