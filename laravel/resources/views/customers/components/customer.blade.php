<div class="customerList listSection" > 
    <ul>
        <li class="flexHead flexWrap">

            <div class="pcBlock">


                <div>名前</div>
                <div>年齢</div>
                <div>住所</div>

                <div>最終購入日</div>
            </div>


            <div class="mbBlock">
                <div >顧客情報</div>
                <div ></div>


            </div>
        </li>

        <li class="flexBodyWrap flexWrap" v-for="customer in customers">

           <div class="mbBlock">
             <ul class="no1">

                    <li v-if="customer.customers_nickname !== null">
                        @{{ customer.customers_nickname }}
                        
                    </li>
                    <li v-if="customer.customers_name !== null">
                        @{{ customer.customers_name }}
                        
                    </li>
            </ul>

          <div class="no3">
            <i class="fa-solid fa-circle-chevron-down"></i>    
            <i class="fa-solid fa-circle-chevron-up"></i>    

        </div>
    </div>

    <div class="pcBlock">


        <div >
            <div class="hiddenName">顧客情報</div>

                <a v-bind:href='`/customers/detail/?id=${customer.customers_id}`'>

                <ul>
                    <li v-if="customer.customers_nickname !== null">
                        @{{ customer.customers_nickname }}
                        
                    </li>
                    <li v-if="customer.customers_name !== null">
                        @{{ customer.customers_name }}
                        
                    </li>
                </ul>
                </a>

            </div>


            <div  >
                <div class="hiddenName">年齢</div>
                <span v-if="customer.customers_age !== null">@{{ customer.customers_age }}歳</span>
                
            </div>  
            <div  >
                <div class="hiddenName">住所</div>
                <span class="pre-line" v-if="customer.customers_prefecture !== null">@{{ customer.customers_address }}</span>
            </div>  


            <div >
                <div class="hiddenName">日付</div>
                @{{ moment(customer.updated_at ) }}
            </div>






        </div>


    </li>
</ul>
</div>
