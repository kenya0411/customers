<div class="orderList listSection" > 
<ul>
    <li class="flexHead flexWrap">
        <div >商品ID</div>
        <div>顧客情報</div>
        <div>商品情報</div>
        <div>金額</div>
        <div>鑑定・発送</div>
        <div>外注</div>
        <div>日付</div>
        <div></div>
        
    </li>

    <li class="flexBodyWrap flexWrap" v-for="customer in customers">
        {{-- @foreach ($customers as $customer) --}}

{{-- 

            <div class="wid80 no1">
                <div class="detailBtn">
                <a :href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'>view</a></div>
                    
                </div> --}}
            <div>
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
                <a href="">
                    
                <ul>
                    <li>@{{customer.customers_nickname }}</li>
                    <li>@{{customer.customers_name }}</li>
                </ul>
                </a>

            </div>
            <div>
                <ul>
                    <li>@{{customer.persons_name}}</li>
                    <li>@{{customer.products_name}}</li>
                    <li>@{{customer.products_options_name}}</li>
                </ul>

             
            </div>
            <div>@{{customer.customers_etc_price}}円

            </div>
           
         

     <div>
<span v-if="customer.customers_fortune_is_finished == 'true'">鑑定済み</span>
<span v-if="customer.customers_ship_is_finished == 'true'">発送済み</span>

</div>
            <div >@{{ customer.users_name }}様</div>
            <div >2022年</div>


            {{-- <div><input type="text" name="customers_deliver_notice" v-bind:value="customer.customers_deliver_notice"></div> --}}
            {{-- <div><input type="text" name="customers_deliver_add_product" v-bind:value="customer.customers_deliver_add_product"></div> --}}


            {{-- <div class="wid60"> --}}
{{--         <form action="/customers/edit"  method="post">
            @csrf
             <input type="hidden" name="id" v-bind:value="customer.id">
             <input type="hidden" name="customers_id" v-bind:value="customer.customers_id">
             <input type="hidden" name="date_day" v-bind:value="customer.date_day">
             <input class="submit editBtn" type="submit" value="edit">
         </form>
 --}}
                {{-- </div> --}}
            <div>
                <ul class="icon_list">
                    <li>
                  <div class="worry">
                      <img src="/img/common/icon/order_icon1.png" class="retina" alt="鑑定">
                  </div>   
                    </li>
                    <li>
                                        <a :href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'><img src="/img/common/icon/order_icon2.png" class="retina" alt="編集"></a>

                    </li>
                    <li>
                        
                <form action="/customers/delete"  method="post">
            @csrf
             <input type="hidden" name="id" v-bind:value="customer.id">
             <input type="hidden" name="customers_id" v-bind:value="customer.customers_id">
             <input type="hidden" name="date_day" v-bind:value="customer.date_day">
             <button type="submit">
                 <img src="/img/common/icon/order_icon3.png" class="retina" alt="削除">
             </button>
                {{-- <input class="submit deleteBtn" type="submit" value="削除"> --}}
         </form>             
                    </li>
                </ul>
 

            </div>




        {{-- @endforeach --}}
{{-- <script src="{{ asset('js/components/customers_select_product_list.js') }}"></script> --}}

</li>
</ul>
</div>

