<section class="customerList maxWid mbPad listSection" > 
<div class="heading">
    <h3>productリスト</h3>
</div>
    <div class="flexHead flexWrap">
        <div class="wid80">詳細</div>

        <div>顧客情報</div>
        <div>商品情報</div>
        <div class="wid100">追加料金</div>
        <div class="wid250">悩み</div>
        <div class="wid250">鑑定結果</div>
        <div class="wid80">鑑定者</div>

        <div class="wid80">鑑定</div>
        <div class="wid80">発送</div>
        <div>備考</div>
        <div>住所</div>

        <div class="wid80">削除</div>
    </div>
    <div class="flexBodyWrap "v-for="customer in customers">  
        {{-- @foreach ($customers as $customer) --}}

        <div class="flexWrap flexBody">


            <div class="wid80 no1">
                <div class="detailBtn">
                <a :href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'>view</a></div>
                    
                </div>

            <div class="no2" data-name="click-open">
                <ul>
                    <li>@{{customer.customers_product_id }}</li>
                    <li>@{{customer.customers_nickname }}</li>
                    <li>@{{customer.customers_name }}</li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>@{{customer.persons_name}}</li>
                    <li>@{{customer.products_name}}</li>
                    <li>@{{customer.products_options_name}}</li>
                </ul>

             
            </div>
            <div class="wid100">@{{customer.customers_etc_price}}円

            </div>
            <div class="wid250">
                <textarea name="customers_worry" id="" cols="30" rows="10">@{{customer.customers_worry }}</textarea>
                </div>
            <div  class="wid250">
                <textarea name="customers_answer" id="" cols="30" rows="10">@{{ customer.customers_answer }}</textarea>

            </div>
            <div class="wid80">@{{ customer.users_name }}様</div>
            <div class="wid80">
<span v-if="customer.customers_fortune_is_finished == 'true'">鑑定済み</span>
</div>
            <div class="wid80">
<span v-if="customer.customers_ship_is_finished == 'true'">発送済み</span>
            </div>

            <div>
@{{ customer.customers_note }}

            </div>

            <div>
@{{ customer.customers_address }}
            </div>


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
            <div class="wid80">
      <form action="/customers/delete"  method="post">
            @csrf
             <input type="hidden" name="id" v-bind:value="customer.id">
             <input type="hidden" name="customers_id" v-bind:value="customer.customers_id">
             <input type="hidden" name="date_day" v-bind:value="customer.date_day">
                <input class="submit deleteBtn" type="submit" value="削除">
         </form>

            </div>




        {{-- @endforeach --}}
    </div>
{{-- <script src="{{ asset('js/components/customers_select_product_list.js') }}"></script> --}}


</section>

