

<div class="shipsList listSection" >


 
<ul>
    <li class="flexHead flexWrap">



    </li>

    <li class="flexBodyWrap flexWrap" v-for="(order, index) in orders_list" v-if="orders_list.length">
    <div class="countHead">
        No.@{{ index + 1 }}
    </div>
 <div class="mbBlock">
                   <ul class="no1">

                   <li>@{{ order.customers.customers_nickname }}</li>
                    <li>@{{ order.customers.customers_name }}</li>
                </ul>
                <div class="no2">
                   <ul>
                    <li v-if="order.persons_id !== 0">@{{ order.persons.persons_name }}</li>
                    <li v-if="order.products_id !== 0">@{{ order.products.products_name }}</li>
                    <li v-if="order.products_options_id !== 0"> @{{ order.products_options.products_options_name}}</li>
                   
                </ul>
                </div>
<div class="no3">
<i class="fa-solid fa-circle-chevron-down"></i>    
<i class="fa-solid fa-circle-chevron-up"></i>    
    
</div>
 </div>

 <div class="pcBlock">
     
<div class="flex">
    <div class="flex5 no1">
        <div class="flexBlock">
            <span class="title">[商品ID]</span>

                            <a v-bind:href="order.persons.persons_platform_url + order.orders.orders_id " target="_blank">
                    <div class="icon_wrap">
                        
                    <span>
                       @{{order.orders.orders_id }} 
                    </span>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                
                </a>
        </div>
        <div class="flexBlock">
            <span class="title">[顧客情報]</span>
                <a v-bind:href='`/customers/detail/?id=${order.customers_id}`'>
                    
                <ul>
                    <li v-if="order.customers_id !== 0">
                    @{{ order.customers.customers_nickname }}
                        
                    </li>
                    <li v-if="order.customers_id !== 0">
                    @{{ order.customers.customers_name }}
                        
                    </li>
                </ul>
                </a>
        </div>
        <div class="flexBlock">
            <span class="title">[商品情報]</span>
                        <ul>
                    <li v-if="order.persons_id !== 0">@{{ order.persons.persons_name }}</li>
                    <li v-if="order.products_id !== 0">@{{ order.products.products_name }}</li>
                    <li v-if="order.products_options_id !== 0"> @{{ order.products_options.products_options_name}}</li>
                   
                </ul>
        </div>
        <div class="flexBlock">
            <span class="title">[購入日]</span>
         @{{ moment(order.updated_at ) }}

        </div>
        <div class="flexBlock">
            <span class="title">[購入回数]</span>
            @{{order.past_order_count_data }}回


        </div>

    </div>
    <div class="flex5 no2">
          <div class="flexBlock">

 {{--            <span class="title">[鑑定書の名前]</span>
            <input type="text"
            v-model="order.ships.ships_is_other_name"
            v-on:keyup.enter.v.backspace="listUpdate(order.orders.id,order.orders.id)" 
            v-on:change="listUpdate(order.orders.id,order.orders.id)"
            v-on:mouseleave="listUpdate(order.orders.id,order.orders.id)"
            > --}}
            <span class="title">[鑑定書の名前]</span>
            <input type="text"
            v-model="order.ships.ships_is_other_name"
            v-on:keyup.enter.v.backspace="listUpdate(order.orders.id,index)" 
            v-on:change="listUpdate(order.orders.id,index)"
            v-on:mouseleave="listUpdate(order.orders.id,index)"
            > 
        </div>
              <div class="flexBlock">

            <span class="title">[住所]</span>

            <textarea id="address_block" readonly 
             v-model="order.customers.customers_address"
            ></textarea>
        </div>

    </div>
    <div class="flex5 no3">
            <span class="title">[鑑定結果]</span>

            <textarea name="" id="" readonly 
            v-model="order.fortunes.fortunes_answer"
            >@{{ order.fortunes.fortunes_answer }}</textarea>
    </div>
<div class="flex5 no4">
          <div class="flexBlock">
            <span class="title">[追加の商品1]</span>
            <input type="text" 
            v-model="order.ships.ships_add_product1"
            v-on:keyup.enter.v.backspace="listUpdate(order.orders.id,index)" 
            v-on:change="listUpdate(order.orders.id,index)"
            v-on:mouseleave="listUpdate(order.orders.id,index)"
            >

        </div>

          <div class="flexBlock">
            <span class="title">[追加の商品2]</span>
            <input type="text" 
            v-model="order.ships.ships_add_product2"
            v-on:keyup.enter.v.backspace="listUpdate(order.orders.id,index)" 
            v-on:change="listUpdate(order.orders.id,index)"
            v-on:mouseleave="listUpdate(order.orders.id,index)"
            >
        </div>
          <div class="flexBlock">
            <span class="title">[追加の商品3]</span>
            <input type="text" 
            v-model="order.ships.ships_add_product3"
            v-on:keyup.enter.v.backspace="listUpdate(order.orders.id,index)" 
            v-on:change="listUpdate(order.orders.id,index)"
            v-on:mouseleave="listUpdate(order.orders.id,index)"
            >
        </div>
         <div class="flexBlock">
            <span class="title">[発送時の備考]</span>
            <textarea class="ships_notice" id="" v-model="order.ships.ships_notice" 
            v-on:keyup.enter.v.backspace="listUpdate(order.orders.id,index)" 
            v-on:change="listUpdate(order.orders.id,index)"
            v-on:mouseleave="listUpdate(order.orders.id,index)"
            >
        </textarea>
        </div>


    </div> 

    <div class="flex5 no5">
        <div class="btnFlex">


            <div class="btnFlex4 number3">
                <a  v-bind:href='`/orders/detail/?id=${order.orders.id}`' class="text_wrap">

                    編集ページ<i class="fa-solid fa-pencil"></i></a>
            </div>
            <div class="btnFlex4 number4" 
            v-if="order.ships.orders_is_ship_shipped == 0">

                    <button 
                    v-on:click="ship_shipped(order.orders.id)"
                    >発送完了<i class="fa-solid fa-paper-plane"></i></button>
            </div>
            <div class="btnFlex4 number5"  
            v-if="order.ships.orders_is_ship_shipped == '1'">
    

                    <button 
                    v-on:click="ship_finished(order.orders.id)"
                    >発送報告完了<i class="fa-solid fa-bullhorn"></i></button>
            </div>

        </div>

    </div>
</div>

         


 </div>


</li>

        <li v-else>
発送予約はありません。
</li>
</ul>
</div>


