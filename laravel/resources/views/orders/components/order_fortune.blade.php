

<div class="orderList listSection" > 
<div class="modalWindow" v-bind:class=' {show:isActive}'>
    
<div class="overlay" v-on:click.self="modal_close()">
    <div class="inner">
        <div class="flex">
            <div class="flex2">
         <div class="title">
        ■相談内容
            
        </div> 

        <div class="show_area  pre-line">
            @{{ modal_fortunes.fortunes_worry }}
        </div>
            </div>
            <div class="flex2">
                
                    <div class="title">
        ■鑑定結果
            
        </div> 

        <div class="show_area pre-line">
            @{{modal_fortunes.fortunes_answer}}
            
        </div>     
            </div>
        </div>
     



        <div class="closeBtn" v-on:click.self="modal_close()">閉じる</div>
    </div>
</div>
</div>


<ul>
    <li class="flexHead flexWrap">
<div class="pcBlock">
    

        <div >商品ID</div>
        <div >顧客情報</div>
        <div>商品情報</div>
        <div>担当者</div>
        <div>日付</div>
        <div></div>
        </div>


<div class="mbBlock">
        <div >顧客情報</div>
        <div>状況</div>
        <div>鑑定士</div>
        <div></div>
    

     </div>
    </li>

    <li class="flexBodyWrap flexWrap"  v-for="(order, index) in orders">
 
 <div class="mbBlock">
                   <ul class="no1">

                    <li>@{{ customers[get_id[index].customers_id].customers_nickname }}</li>
                    <li>@{{ customers[get_id[index].customers_id].customers_name }}</li>
                </ul>
                <div class="no2">
<span v-if="order.orders_is_reserve_finished == '1'">鑑定済み<br></span>
<span v-if="order.orders_is_ship_finished == '1'">発送済み</span>

                </div>


                <div class="no2">
                    @{{ persons[get_id[index].persons_id].persons_name }}


                </div>
<div class="no3">
<i class="fa-solid fa-circle-chevron-down"></i>    
<i class="fa-solid fa-circle-chevron-up"></i>    
    
</div>
 </div>

 <div class="pcBlock">


            <div>
                <div class="hiddenName">商品ID</div>
       
                    <div class="icon_wrap">
                        
                    <span class="break_all">
                       @{{order.orders_id }} 
                    </span>
                    </div>
                

</div>
            <div >
                <div class="hiddenName">顧客情報</div>

                <a v-bind:href='`/customers/detail/?id=${order.customers_id}`'>
                    
                <ul>
                    <li >
                        詳細

                   
                        
                    </li>
                </ul>
                </a>

            </div>
            <div>
                <div class="hiddenName">商品情報</div>

                <ul>
                   
                    <li v-if="order.products_id !== 0">
                        <span  v-if="products[get_id[index].products_id]">
                    @{{ products[get_id[index].products_id].products_name }}

                        </span>
                </li>
              
                </ul>

             
            </div>
         
           
         

 
            <div>
                <div class="hiddenName">外注者</div>
                @php

                @endphp
                <span  v-if="order.users_id === {{ Auth::user()->id }}">
                @{{ users[get_id[index].users_id].nickname }}様
            </span>

        </div>
            <div>
                <div class="hiddenName">日付</div>
                <div class="break_all">
                    
         @{{ moment(order.created_at ) }}
                </div>

        </div>


     
            <div>
                     <div class="pcInvi">
        <div class="editBtn">
                                        <a v-bind:href='`/orders/detail/?id=${order.id}`'>編集ページ</a>
            
        </div>
         
     </div>
                <ul class="icon_list tabInvi">
                    <li>
                  <div class="worry pointer" v-on:click="modal_open(order.id)">
                      <img src="/img/common/icon/order_icon1.png" class="retina" alt="鑑定">
                  </div>   
                    </li>
                    <li>
                                       

            <a v-bind:href='`/orders/detail/?id=${order.id}`'>
                <img src="/img/common/icon/order_icon2.png" class="retina" alt="編集">
            </a>

                    </li>
                
                </ul>
 
            </div>


 </div>


</li>
</ul>
</div>


