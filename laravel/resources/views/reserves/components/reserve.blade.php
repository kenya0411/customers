<div class="reserveList listSection" > 
<ul>
    <li class="flexHead flexWrap">
<div class="pcBlock">
    

        <div >予約一覧</div>
 
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
                          <a >
                    
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
            <span class="title">[悩み]</span>
            @{{ fortunes}}
            {{-- @{{ fortunes[orders.id].fortunes_worry}} --}}
            <textarea name="" id=""></textarea>

    </div>
    <div class="flex5 no3">
            <span class="title">[鑑定結果]</span>

            <textarea name="" id=""></textarea>
    </div>
    <div class="flex5 no4">
          <div class="flexBlock">
            <span class="title">[外注]</span>
            <select name="" id="">
                <option value="">aaa</option>
            </select>
        </div>
         <div class="flexBlock">
            <span class="title">[備考]</span>
            <textarea name="" id=""></textarea>

        </div>

                 <div class="flexBlock">
            <span class="title">[発送]</span>

            <select name="" id="">
                <option value="">aaa</option>
            </select>
        </div>

    </div>
    <div class="flex5 no5">
        <div class="btnFlex">
            <div class="btnFlex4 number1">
                <a href=""><i class="fa-solid fa-clipboard"></i></a>
            </div>
            <div class="btnFlex4 number2">
                <a href=""><i class="fa-solid fa-circle-check"></i></a>
            </div>

            <div class="btnFlex4 number3">
                <a href="">編集ページ<i class="fa-solid fa-pencil"></i></a>
            </div>
            <div class="btnFlex4 number4">
                <form action="">
                    <button>発送予約<i class="fa-solid fa-paper-plane"></i></button>
                </form>
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


