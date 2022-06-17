

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

                    <li>@{{ order.customers.customers_name }}</li>
                </ul>
                <div class="no2">
                   <ul>
                    <li v-if="order.persons_id !== 0">@{{ order.persons.persons_name }}</li>
                   
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

                        
                    <span>
                       @{{order.orders.orders_id }} 
                    </span>
              
        </div>
                <div class="flexBlock">
            <span class="title">[鑑定士]</span>
                        <ul>
                    <li v-if="order.persons_id !== 0">@{{ order.persons.persons_name }}</li>
                   
                </ul>
        </div>
        <div class="flexBlock">
            <span class="title">[名前]</span>
            <div v-if="order.ships.ships_is_other_name" class=" user-select">
                    @{{ order.ships.ships_is_other_name }}
                
            </div>
            <div v-else>

                    @{{ order.customers.customers_name }}
</div>
            
             
        </div>

        <div class="flexBlock">
            <span class="title">[購入回数]</span>
            @{{order.past_order_count_data }}回


        </div>
 

    </div>
    <div class="flex5 no2">
 
              <div class="flexBlock">

            <span class="title">[住所]</span>
    <div class="textBox pre-line textarea1">
          @{{ order.customers.customers_address}}
        
    </div>
       
        </div>

    </div>
    <div class="flex5 no3">
            <span class="title">[鑑定結果]</span>
    <div class="textBox pre-line textarea1 ">
          @{{ order.fortunes.fortunes_answer }}
        
    </div>

    </div>
<div class="flex5 no4">
            <div class="flexBlock"
            v-if="order.ships.ships_add_product1">
            <span class="title">[追加の商品1]</span>
            <div class="textBox pre-line ">
            @{{ order.ships.ships_add_product1 }}

            </div>
            </div>

            <div class="flexBlock"
            v-if="order.ships.ships_add_product2">
            <span class="title">[追加の商品2]</span>
            <div class="textBox pre-line  ">
            @{{ order.ships.ships_add_product2 }}

            </div>
            </div>

            <div class="flexBlock"
            v-if="order.ships.ships_add_product3">
            <span class="title">[追加の商品3]</span>
            <div class="textBox pre-line  ">
            @{{ order.ships.ships_add_product3 }}

            </div>
            </div>



         <div class="flexBlock"
 v-if="order.ships.ships_notice"
         >
            <span class="title">[発送時の備考]</span>
            <div class="textBox pre-line ">
            @{{ order.ships.ships_notice }}
            </div>
       
        </div>


    </div> 

    <div class="flex5 no5">
        <div class="btnFlex">


 
            <div class="btnFlex4 number4" 
            v-if="order.ships.orders_is_ship_shipped == 0">

                    <button 
                    v-on:click="ship_shipped(order.orders.id)"
                    >発送完了<i class="fa-solid fa-paper-plane"></i></button>
            </div>
            <div class="btnFlex4 number5"  
            v-else>
    
                <strong>
                発送完了
                    
                </strong>
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


