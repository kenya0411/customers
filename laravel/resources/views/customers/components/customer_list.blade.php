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

    <li class="flexBodyWrap flexWrap" v-for="customer in customers">
 
 <div class="mbBlock">
                   <ul class="no1">
                    <li>@{{customer.customers_nickname }}</li>
                    <li>@{{customer.customers_name }}</li>
                </ul>
                <div class="no2">
                    
              <span v-if="customer.customers_fortune_is_finished == 'true'">鑑定済み</span>
<span v-if="customer.customers_ship_is_finished == 'true'">発送済み</span>
                </div>
<div class="no3">
<i class="fa-solid fa-circle-chevron-down"></i>    
<i class="fa-solid fa-circle-chevron-up"></i>    
    
</div>
 </div>

 <div class="pcBlock">

            <div>
                <div class="hiddenName">商品ID</div>
                <a href="">
                    <div class="icon_wrap">
                        
                    <span>
                       @{{customer.customers_product_id }} 
                    </span>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                
                </a>

</div>
            <div >
                <div class="hiddenName">顧客情報</div>

                <a href="">
                    
                <ul>
                    <li>@{{customer.customers_nickname }}</li>
                    <li>@{{customer.customers_name }}</li>
                </ul>
                </a>

            </div>
            <div>
                <div class="hiddenName">商品情報</div>

                <ul>
                    <li>@{{customer.persons_name}}</li>
                    <li>@{{customer.products_name}}</li>
                    <li>@{{customer.products_options_name}}</li>
                </ul>

             
            </div>
            <div>
                <div class="hiddenName">料金</div>

                @{{customer.customers_etc_price}}円

            </div>
           
         

     <div class="tabInvi">
<span v-if="customer.customers_fortune_is_finished == 'true'">鑑定済み</span>
<span v-if="customer.customers_ship_is_finished == 'true'">発送済み</span>

</div>
            <div>
                <div class="hiddenName">外注者</div>

            @{{ customer.users_name }}様</div>
            <div >
                <div class="hiddenName">日付</div>

            2022年</div>


     
            <div>
                     <div class="pcInvi">
        <div class="editBtn">
                                        <a :href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'>商品情報</a>
            
        </div>
         
     </div>
                <ul class="icon_list tabInvi">
                    <li>
                  <div class="worry">
                      <img src="/img/common/icon/order_icon1.png" class="retina" alt="鑑定">
                  </div>   
                    </li>
                    <li>
                                        <a :href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'><img src="/img/common/icon/order_icon2.png" class="retina" alt="編集"></a>

                    </li>
                
                </ul>
 

            </div>


 </div>


        {{-- @endforeach --}}
{{-- <script src="{{ asset('js/components/customers_select_product_list.js') }}"></script> --}}

</li>
</ul>
</div>

