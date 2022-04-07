<div class="modalWindow" v-bind:class=' {show:isActive}'>
    
<div class="overlay" v-on:click.self="modal_close()">
    <div class="inner">
        <div class="title">
        ■名前確認用
            
        </div>
        <p>名前にミスがないかご確認ください。</p><div class="notice"><span>※</span>鑑定結果の中から「様」or「さま」の単語と、<br>その手前の文字を抽出しております。</div>       
        <ul class="name_check">
            <li v-for="val in name_check">@{{ val}}</li>
            
        </ul>
        <div class="closeBtn" v-on:click.self="modal_close()">閉じる</div>
    </div>
</div>
</div>

<div class="reserveList listSection" > 
<ul>
    <li class="flexHead flexWrap">
{{-- <div class="pcBlock"> --}}
    

        {{-- <div >予約一覧</div> --}}
 
        {{-- </div> --}}
{{-- 

<div class="mbBlock">
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
            
            <textarea id="" v-model="fortunes[orders_id[index].id - 1].fortunes_worry" 
            v-on:keyup.enter.v.backspace="listUpdate('fortunes_worry',order.id,index)" 
            v-on:change="listUpdate('fortunes_worry',order.id,index)"
            v-on:mouseleave="listUpdate('fortunes_worry',order.id,index)"
            >@{{ fortunes[orders_id[index].index].fortunes_worry }}</textarea>

    </div>
    <div class="flex5 no3">
            <span class="title">[鑑定結果]</span>

            <textarea name="" id="" v-model="fortunes[orders_id[index].id - 1].fortunes_answer" 
            v-on:keyup.enter.v.backspace="listUpdate('fortunes_answer',order.id,index)" 
            v-on:change="listUpdate('fortunes_answer',order.id,index)"
            v-on:mouseleave="listUpdate('fortunes_answer',order.id,index)"
            >@{{ fortunes[orders_id[index].index].fortunes_answer }}</textarea>
    </div>
<div class="flex5 no4">
          <div class="flexBlock">
            <span class="title">[外注]</span>
            <select name="users_id" id="" 
            v-model="orders[orders_id[index].index].users_id"
            v-on:change="listUpdate('users_id',order.id,index)">
      <option value="0" >選択してください</option>

                <option v-for="user in users" v-bind:value="user.id">@{{ user.nickname }}</option>
            </select>
        </div>
         <div class="flexBlock">
            <span class="title">[備考]</span>
            <textarea class="orders_notice" id="" v-model="orders[orders_id[index].index].orders_notice" 
            v-on:keyup.enter.v.backspace="listUpdate('orders_notice',order.id,index)" 
            v-on:change="listUpdate('orders_notice',order.id,index)"
            v-on:mouseleave="listUpdate('orders_notice',order.id,index)"
            >
        </textarea>
        </div>
                 <div class="flexBlock">
            <span class="title">[発送]</span>

            <select name="orders_is_ship_finished" id="" 
            v-model="orders[orders_id[index].index].orders_is_ship_finished"
            v-on:change="listUpdate('orders_is_ship_finished',order.id,index)"
            >
                <option value="0"></option>
                <option value="2">発送不要</option>
            </select>
        </div>

    </div> 

    <div class="flex5 no5">
        <div class="btnFlex">
            <div class="btnFlex4 number1">
                <div class="icon_wrap" v-on:click="copyToClipboard(order.id)">
                    <i class="fa-solid fa-clipboard"></i>
                </div>
            </div>
            <div class="btnFlex4 number2">
                <div class="icon_wrap" v-on:click="modal_open(order.id)">

                <i class="fa-solid fa-circle-check"></i>
            </div>
            </div>

            <div class="btnFlex4 number3">
                <a  v-bind:href='`/orders/detail/?id=${order.id}`' class="text_wrap">

                    編集ページ<i class="fa-solid fa-pencil"></i></a>
            </div>
            <div class="btnFlex4 number4">
<div v-if="orders[orders_id[index].index].orders_is_ship_finished == '0'">
    

                    <button 
                    v-on:click="reserve_ship(order.id)"
                    >発送予約<i class="fa-solid fa-paper-plane"></i></button>
</div>
<div v-if="orders[orders_id[index].index].orders_is_ship_finished == '2'">
    

                    <button 
                    v-on:click="reserve_ship(order.id)"
                    >鑑定完了(発送無し)</button>
</div>

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


