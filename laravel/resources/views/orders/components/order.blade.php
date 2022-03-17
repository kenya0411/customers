<div class="orderList listSection" > 
<ul>
    <li class="flexHead flexWrap">
<div class="pcBlock">
    

        <div >商品ID</div>
        <div >顧客情報</div>
        <div>商品情報</div>
        <div>金額</div>
        <div>鑑定・発送</div>
        <div>外注</div>
        <div>日付</div>
        <div></div>
        </div>


<div class="mbBlock">
        <div >顧客情報</div>
        <div>鑑定・発送</div>
    

     </div>
    </li>

    <li class="flexBodyWrap flexWrap" v-for="order in orders">
 
 <div class="mbBlock">
                   <ul class="no1">

                    <li>@{{ customers[order.customers_id - 1].customers_nickname }}</li>
                    <li>@{{ customers[order.customers_id - 1].customers_name }}</li>
                </ul>
                <div class="no2">
<span v-if="order.orders_is_reserve_finished == '1'">鑑定済み</span>
<span v-if="order.orders_is_ship_finished == '1'">発送済み</span>

                </div>
<div class="no3">
<i class="fa-solid fa-circle-chevron-down"></i>    
<i class="fa-solid fa-circle-chevron-up"></i>    
    
</div>
 </div>

 <div class="pcBlock">


            <div>
                <div class="hiddenName">商品ID</div>
                {{-- <a v-bind:href='`${persons[order.persons_id - 1].persons_platform_url + order.orders_id}`'> --}}
                <a v-bind:href="persons[order.persons_id - 1].persons_platform_url + order.orders_id " target="_blank">
                    <div class="icon_wrap">
                        
                    <span>
                       @{{order.orders_id }} 
                    </span>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                
                </a>

</div>
            <div >
                <div class="hiddenName">顧客情報</div>

                <a >
                    
                <ul>
                    <li v-if="order.customers_id !== 0">
                    @{{ customers[order.customers_id - 1].customers_nickname }}
                        
                    </li>
                    <li v-if="order.customers_id !== 0">
                    @{{ customers[order.customers_id - 1].customers_name }}
                        
                    </li>
                </a>

            </div>
            <div>
                <div class="hiddenName">商品情報</div>

                <ul>
                    <li v-if="order.persons_id !== 0">@{{ persons[order.persons_id - 1].persons_name }}</li>
                    <li v-if="order.products_id !== 0">@{{ products[order.products_id - 1].products_name }}</li>
                    <li v-if="order.products_options_id !== 0"> @{{ products_options[order.products_options_id - 1].products_options_name}}</li>
                   
                    {{-- <li>@{{ products_options[order.products_options_id - 1].products_options_name }}</li> --}}
                {{--     <li>@{{customer.persons_name}}</li>
                    <li>@{{customer.products_name}}</li>
                    <li>@{{customer.products_options_name}}</li> --}}
                </ul>

             
            </div>
            <div>
                <div class="hiddenName">料金</div>

                @{{order.orders_price}}円

            </div>
           
         

     <div class="tabInvi">
<span v-if="order.orders_is_reserve_finished == '1'">鑑定済み</span>
<span v-if="order.orders_is_ship_finished == '1'">発送済み</span>

</div>
            <div v-if="order.users_id !== 0">
                <div class="hiddenName">外注者</div>
@{{ users[order.users_id - 1].name }}様
        </div>
            <div >
                <div class="hiddenName">日付</div>
         @{{ moment(order.updated_at ) }}
        </div>


     
            <div>
                     <div class="pcInvi">
        <div class="editBtn">
                                        {{-- <a v-bind:href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'>商品情報</a> --}}
            
        </div>
         
     </div>
                <ul class="icon_list tabInvi">
                    <li>
                  <div class="worry">
                      <img src="/img/common/icon/order_icon1.png" class="retina" alt="鑑定">
                  </div>   
                    </li>
                    <li>
                                        {{-- <a v-bind:href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'><img src="/img/common/icon/order_icon2.png" class="retina" alt="編集"></a> --}}

                    </li>
                
                </ul>
 

            </div>


 </div>


        {{-- @endforeach --}}
{{-- <script src="{{ asset('js/components/customers_select_product_list.js') }}"></script> --}}

</li>
</ul>
</div>


