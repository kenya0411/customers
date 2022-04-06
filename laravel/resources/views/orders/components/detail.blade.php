<div class="detailFrom formSection ">   
<div class="inner">
    
    <form action="./edit" method="post">
        @csrf
        {{-- <input type="hidden" name="id" value="{{ $customers[0]->id }} " > --}}

        <dl>
         <dt>購入日</dt>
         <dd>         @{{ moment(orders[0].updated_at ) }}
</dd>

<dt>商品ID</dt>
<dd>
    <input type="text" v-model="orders[0].orders_id">
</dd>
<dt>名前</dt>
<dd>
    
    <input type="text" v-model="customers[0].customers_name">

</dd>
<dt>ニックネーム</dt>
<dd>
    <input type="text" v-model="customers[0].customers_nickname">
    
</dd>
<dt>鑑定士</dt>
<dd>
    <select name="" id="" v-model="orders[0].persons_id">
        <option v-bind:value="person.persons_id" v-for="person in persons"> @{{ person.persons_name }}</option>

    </select>
</dd>
<dt>商品名</dt>
<dd>
        <select  v-model="orders[0].products_id">
        <option v-bind:value="product.products_id" v-for="product in products"> @{{ product.products_name }}</option>

    </select>

</dd>
<dt>オプション名</dt>
<dd>
            <select  v-model="orders[0].products_options_id">
        <option value="0"> オプション無し</option>

        <option v-bind:value="product_option.products_options_id" v-for="product_option in products_options"> @{{ product_option.products_options_name }}</option>

    </select>

</dd>
<dt>料金</dt>
<dd class="price_dd">
    <div class="flex">
        <div class="flex4">
            <div class="title">[仮の金額]</div>
    <input type="number" inputmode="numeric" value=" " >
        </div>
        <div class="flex4">
            <div class="title">[手数料]</div>
    <input type="number" inputmode="numeric" v-bind:value="persons[orders[0].persons_id - 1].persons_platform_fee" ><span>%</span>

        </div>
        <div class="flex4">
            <div class="calcBtn">
                計算する
            </div>
        </div>
        <div class="flex4">
            <div class="title">[総計]</div>
    <input type="number" inputmode="numeric" v-model="orders[0].orders_price" >
            
        </div>
    </div>
</dd>
<dt>悩み</dt>
<dd>
    <textarea name="" id="" v-model="fortunes[0].fortunes_worry" class="textarea1"></textarea>

</dd>
<dt>鑑定結果</dt>
<dd>
    <textarea name="" id="" v-model="fortunes[0].fortunes_answer" class="textarea1"></textarea>
    
</dd>
<dt>外注者</dt>
<dd>
    <select name="" id="" v-model="orders[0].users_id">
        <option value="0">選択してください</option>
        <option v-for="user in users" v-bind:value="user.id">@{{ user.nickname }}</option>
    </select>
</dd>
<dt>鑑定・発送</dt>
<dd>
    <span v-if="orders[0].orders_is_reserve_finished == '1'">鑑定済み</span>
<span v-if="orders[0].orders_is_ship_finished == '1'">発送済み</span>

</dd>
<dt>備考</dt>
<dd>
    <textarea name="" id="" v-model="orders[0].orders_notice" class="textarea2"></textarea>
</dd>
<dt>住所</dt>
<dd>
    <textarea name="" id="" v-model="customers[0].customers_address" class="textarea2"></textarea>
    

</dd>
{{--          <dd>
           <div class="inputFlex dateBlock">
            <select name="date_year" v-model="customers.date_year" id="">
                <option value="{{ $customers[0]->date_year }}">{{ $customers[0]->date_year }}年</option>
                <option value="{{ $customers[0]->date_year + 1 }}">{{ $customers[0]->date_year + 1 }}年</option>
            </select>
            <select name="date_month" v-model="customers.date_month" id="">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i}}">{{ $i }}月</option>
                @endfor
                  </select>
                  <select name="date_day" v-model="customers.date_day" id="">
                    @for ($i = 1; $i < 32; $i++)
                    <option value="{{ $i }}">{{ $i }}日</option>

                    @endfor
                </select>

            </div>
        </dd>
        <dt>商品ID</dt>
        <dd>
            <input type="text" name="customers_product_id" v-bind:value="customers.customers_product_id" >
            @error('customers_product_id')
            <div class="errorMessage">
                {{ $message }}<br>
            </div>
            @enderror
        </dd>


        <dt>ニックネーム</dt>
        <dd>
            <input type="text" name="customers_nickname" v-bind:value="customers.customers_nickname" >
            @error('customers_nickname')
            <div class="errorMessage">
                {{ $message }}<br>
            </div>
            @enderror
        </dd>


        <dt>名前</dt>
        <dd>
            <input type="text" name="customers_name"  v-bind:value="customers.customers_name" >
            @error('customers_name')
            <div class="errorMessage">
                {{ $message }}<br>
            </div>
            @enderror
        </dd>
        <dt>鑑定士</dt>
        <dd>
            <select name="persons_id" v-model="customers.persons_id" id="">
              <option v-for="person in persons"  v-bind:value="person.persons_id" >@{{ person.persons_name }}</option>


          </select>
      </dd>
      <dt>商品名</dt>
      <dd>
        <select name="products_id" v-model="customers.products_id" id="">

          <option v-for="product in products"  v-bind:value="product.products_id" >@{{ product.products_name }}</option>

      </select>
  </dd>

  <dt> オプション名</dt>
  <dd>            
     <select name="products_options_id" v-model="customers.products_options_is" id="">
      <option v-for="product_option in products_options"  v-bind:value="product_option.products_options_id" >@{{ product_option.products_options_name }}</option>

  </select>
</dd>
<dt> 料金</dt>
<dd>            
    <input type="number" name="customers_etc_price" inputmode="numeric" value="{{ old('customers_etc_price') }} " >
    @error('customers_etc_price')
    <div class="errorMessage">
        {{ $message }}<br>
    </div>
    @enderror
</dd>  --}} 

 {{--           
<dt> 悩み</dt>

<dd> 
    <textarea name="customers_worry" id="" cols="30" rows="10" v-bind:value="customers.customers_worry"></textarea>           
</dd>          
<dt> 鑑定結果</dt>
<dd> 
    <textarea name="customers_answer" id="" cols="30" rows="10" v-bind:value="customers.customers_answer"></textarea>           
</dd>             
<dt> 外注者</dt>
<dd>    
   <select name="users_id" v-model="customers.users_id" id="">
       <option v-for="user in users"  v-bind:value="user.id" >@{{ user.name }}</option>
   </select>        
</dd>             
<dt> 鑑定・発送</dt>
<dd>    
   <div class="inputFlex checkBoxWrap">
    <input type="checkbox" name="customers_fortune_is_finished" id="customers_fortune_is_finished" v-model="customers.customers_fortune_is_finished" value="true" checked>

    <label for="customers_fortune_is_finished">
        鑑定済み
    </label>
</div>
<div class="inputFlex checkBoxWrap">

    <input type="checkbox" name="customers_ship_is_finished" id="customers_ship_is_finished" v-model="customers.customers_ship_is_finished"  value="true">
    <label for="customers_ship_is_finished" >
        発送済み

    </label>    
</div>
</dd>             
<dt> 備考</dt>
<dd>  
    <textarea name="customers_note" id="" cols="30" rows="10"  v-bind:value="customers.customers_note"></textarea>           

</dd>                
<dt> 住所</dt>
<dd>    
    <textarea name="customers_address" id="" cols="30" rows="10"  v-bind:value="customers.customers_address"></textarea>           

</dd>              
<dt> customers_deliver_notice:</dt>
<dd>      
    <textarea name="customers_deliver_notice" id="" cols="30" rows="10" v-bind:value="customers.customers_deliver_notice"></textarea>           

</dd>              
<dt> customers_deliver_add_product:</dt>
<dd>     
    <textarea name="customers_deliver_add_product" id="" cols="30" rows="10"  v-bind:value="customers.customers_deliver_add_product"></textarea>           

</dd>               --}}

</dl>
<div class="btnWrap">
    <div class="sendBtn" v-on:click="submit_update(orders[0].id)">編集する</div>
</div>

</form>
</div>

</div>