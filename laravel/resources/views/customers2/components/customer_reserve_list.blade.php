<section class="customerList maxWid mbPad listSection" > 
<div class="heading">
    <h3>productリスト</h3>
</div>
    <div class="flexHead flexWrap">
        <div class="wid60">詳細</div>

        <div>顧客情報</div>
        <div>商品情報</div>
        <div class="wid100">追加料金</div>
        <div>悩み</div>
        <div>鑑定結果</div>
        <div>鑑定者</div>

        <div class="wid80">鑑定</div>
        <div class="wid80">発送</div>
        <div>備考</div>
        <div>住所</div>

        <div>発送時の備考</div>
        <div>追加発送</div>
        {{-- <div class="wid60">編集</div> --}}
        <div class="wid60">発想</div>
    </div>
    <div class="flexBodyWrap "v-for="customer in customers">  
        {{-- @foreach ($customers as $customer) --}}

        <div class="flexWrap flexBody">


            <div class="wid60"><a :href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'>view</a></div>

            <div>
                <ul>
                    <li>【@{{customer.customers_product_id }}】</li>
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
            <div >
                <textarea name="customers_worry" id="" cols="30" rows="10">@{{customer.customers_worry }}</textarea>
                </div>
            <div >
                <textarea name="customers_answer" id="" cols="30" rows="10">@{{ customer.customers_answer }}</textarea>

            </div>
            <div>@{{ customer.users_name }}様</div>
            <div class="wid80">
<span v-if="customer.customers_fortune_is_finished == 'true'">鑑定済み</span>
</div>
            <div class="wid80">
<span v-if="customer.customers_ship_is_finished == 'true'">発送済み</span>
            </div>

            <div><input type="text" name="customers_note" v-bind:value="customer.customers_note "></div>

            <div>
                <textarea name="customers_address" id="" cols="30" rows="10">@{{ customer.customers_address }}</textarea>

            </div>


            <div><input type="text" name="customers_deliver_notice" v-bind:value="customer.customers_deliver_notice"></div>
            <div><input type="text" name="customers_deliver_add_product" v-bind:value="customer.customers_deliver_add_product"></div>


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
            <div class="wid60">
      <form action="/customers/reserve_send"  method="post">
            @csrf
             <input type="hidden" name="id" v-bind:value="customer.id">
             <input type="hidden" name="customers_id" v-bind:value="customer.customers_id">
                <input class="submit sendBtn" type="submit" value="発送完了">
         </form>

            </div>




        {{-- @endforeach --}}
    </div>
{{-- <script src="{{ asset('js/components/customers_select_product_list.js') }}"></script> --}}


</section>

