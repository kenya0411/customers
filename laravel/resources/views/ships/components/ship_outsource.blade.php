

<div class="shipsList listSection" >


 
<ul>
    <li class="flexHead flexWrap">


    </li>

    <li class="flexBodyWrap flexWrap" v-for="(order, index) in orders">
    <div class="countHead">
        No.@{{ index + 1 }}
    </div>
 <div class="mbBlock">
                   <ul class="no1">

                   <li>@{{ customers[order.customers_id - 1].customers_nickname }}</li>
                    <li>@{{ customers[order.customers_id - 1].customers_name }}</li>
                </ul>
                <div class="no2">
                   <ul>
                    <li v-if="order.persons_id !== 0">@{{ persons[order.persons_id - 1].persons_name }}</li>
                    <li v-if="order.products_id !== 0">@{{ products[order.products_id - 1].products_name }}</li>
                    <li v-if="order.products_options_id !== 0"> @{{ products_options[order.products_options_id - 1].products_options_name}}</li>
                   
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
                       @{{order.orders_id }} 
                    </span>
                
        </div>
        <div class="flexBlock">
            <span class="title">[名前]</span>
            <div v-if="ships[orders_id[index].id].ships_is_other_name === null ">
                @{{ customers[order.customers_id - 1].customers_name }}
            </div>
            <div v-else>
                @{{ ships[orders_id[index].id].ships_is_other_name }}
            </div>
            
        </div>


    </div>
    <div class="flex5 no2">

              <div class="flexBlock">

            <span class="title">[住所]</span>

            <textarea id="address_block" readonly 
             v-model="customers[order.customers_id - 1].customers_address"
            ></textarea>
        </div>

    </div>
    <div class="flex5 no3">
            <span class="title">[鑑定結果]</span>

            <textarea name="" id="" readonly 
            v-model="fortunes[orders_id[index].id - 1].fortunes_answer"
            >@{{ fortunes[orders_id[index].index].fortunes_answer }}</textarea>
    </div>
<div class="flex5 no4">
          <div class="flexBlock" 
          v-if="ships[orders_id[index].id].ships_add_product1 !== null">
            <span class="title">[追加の商品1]</span>
            @{{ ships[orders_id[index].id].ships_add_product1 }}

        </div>
          <div class="flexBlock" 
          v-if="ships[orders_id[index].id].ships_add_product2 !== null">
            <span class="title">[追加の商品2]</span>
            @{{ ships[orders_id[index].id].ships_add_product2 }}

        </div>
          <div class="flexBlock" 
          v-if="ships[orders_id[index].id].ships_add_product2 !== null">
            <span class="title">[追加の商品2]</span>
            @{{ ships[orders_id[index].id].ships_add_product2 }}

        </div>

   
         <div class="flexBlock">
            <span class="title">[発送時の備考]</span>
            <textarea class="ships_notice" id=""
             v-model="ships[orders_id[index].id].ships_notice" 
            readonly 
            >
        </textarea>
        </div>


    </div> 

    <div class="flex5 no5">
        <div class="btnFlex">


            <div class="btnFlex4 number4"
            v-if="ships[orders_id[index].id].orders_is_ship_shipped == 0">

                    <button 
                    v-on:click="ship_shipped(order.id)"
                    >発送完了<i class="fa-solid fa-paper-plane"></i></button>
            </div>
            <div class="btnFlex4 number4"
            v-else>
                
                発送終了
            </div>

        </div>

    </div>
</div>

         


 </div>


        {{-- @endforeach --}}
{{-- <script src="{{ asset('js/components/customers_select_product_list.js') }}"></script> --}}

</li>
</ul>
</div>


