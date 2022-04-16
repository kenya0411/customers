

<div class="shipsList listSection" >


 
<ul>
    <li class="flexHead flexWrap">



{{-- <div class="mbBlock">
        <div >顧客情報</div>
        <div>鑑定・発送</div>
    

     </div> --}}
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

                            <a v-bind:href="persons[order.persons_id - 1].persons_platform_url + order.orders_id " target="_blank">
                    <div class="icon_wrap">
                        
                    <span>
                       @{{order.orders_id }} 
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
                    @{{ customers[order.customers_id - 1].customers_nickname }}
                        
                    </li>
                    <li v-if="order.customers_id !== 0">
                    @{{ customers[order.customers_id - 1].customers_name }}
                        
                    </li>
                </ul>
                </a>
        </div>
        <div class="flexBlock">
            <span class="title">[商品情報]</span>
                        <ul>
                    <li v-if="order.persons_id !== 0">@{{ persons[order.persons_id - 1].persons_name }}</li>
                    <li v-if="order.products_id !== 0">@{{ products[order.products_id - 1].products_name }}</li>
                    <li v-if="order.products_options_id !== 0"> @{{ products_options[order.products_options_id - 1].products_options_name}}</li>
                   
                </ul>
        </div>
        <div class="flexBlock">
            <span class="title">[購入日]</span>
         @{{ moment(order.updated_at ) }}

        </div>

    </div>
    <div class="flex5 no2">
          <div class="flexBlock">

            <span class="title">[鑑定書の名前]</span>
            <input type="text"
            v-model="ships[orders_id[index].id].ships_is_other_name"
            v-on:keyup.enter.v.backspace="listUpdate(order.id,order.id)" 
            v-on:change="listUpdate(order.id,order.id)"
            v-on:mouseleave="listUpdate(order.id,order.id)"
            >
        </div>
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
          <div class="flexBlock">
            <span class="title">[追加の商品1]</span>
            <input type="text" 
            v-model="ships[orders_id[index].id].ships_add_product1"
            v-on:keyup.enter.v.backspace="listUpdate(order.id)" 
            v-on:change="listUpdate(order.id)"
            v-on:mouseleave="listUpdate(order.id)"
            >

        </div>

          <div class="flexBlock">
            <span class="title">[追加の商品2]</span>
            <input type="text" 
            v-model="ships[orders_id[index].id].ships_add_product2"
            v-on:keyup.enter.v.backspace="listUpdate(order.id)" 
            v-on:change="listUpdate(order.id)"
            v-on:mouseleave="listUpdate(order.id)"
            >
        </div>
          <div class="flexBlock">
            <span class="title">[追加の商品3]</span>
            <input type="text" 
            v-model="ships[orders_id[index].id].ships_add_product3"
            v-on:keyup.enter.v.backspace="listUpdate(order.id)" 
            v-on:change="listUpdate(order.id)"
            v-on:mouseleave="listUpdate(order.id)"
            >
        </div>
         <div class="flexBlock">
            <span class="title">[発送時の備考]</span>
            <textarea class="ships_notice" id="" v-model="ships[orders_id[index].id].ships_notice" 
            v-on:keyup.enter.v.backspace="listUpdate(order.id)" 
            v-on:change="listUpdate(order.id)"
            v-on:mouseleave="listUpdate(order.id)"
            >
        </textarea>
        </div>


    </div> 

    <div class="flex5 no5">
        <div class="btnFlex">


            <div class="btnFlex4 number3">
                <a  v-bind:href='`/orders/detail/?id=${order.id}`' class="text_wrap">

                    編集ページ<i class="fa-solid fa-pencil"></i></a>
            </div>
            <div class="btnFlex4 number4" 
            v-if="ships[orders_id[index].id].orders_is_ship_shipped == 0">

                    <button 
                    v-on:click="ship_shipped(order.id)"
                    >発送完了<i class="fa-solid fa-paper-plane"></i></button>
            </div>
            <div class="btnFlex4 number5"  
            v-if="ships[orders_id[index].id].orders_is_ship_shipped == '1'">
    

                    <button 
                    v-on:click="ship_finished(order.id)"
                    >発送報告完了<i class="fa-solid fa-bullhorn"></i></button>
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


