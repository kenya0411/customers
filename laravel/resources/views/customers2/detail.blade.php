
@extends('common.base'){{-- 継承元 --}}
@section('title','注文編集'){{-- タイトル --}}
@section('heading','注文編集'){{-- 見出し --}}


@section('content')
<div class="backBlock">
    
<div class="backBtn">
    <a href="../"><i class="fa-solid fa-caret-left"></i>戻る</a>
</div>
</div>

<div class="orderFrom formSection" id="app">   

    <form action="./edit" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $customers[0]->id }} " >

        <dl>
         <dt>日付</dt>
         <dd>
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
</dd>             
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

</dd>              

</dl>
<div class="btnWrap">
    <input type="submit" class="sendBtn" value="編集する">

</div>

</form>
</div>


<script>


    let params = (new URL(document.location)).searchParams//クエリ取得用
    const hoge = {
      el: '#app',
      data () {
        return {
          persons: '', 
          id: params.get('id'),
          products: '',
          products_options: '',
          users: '',
          customers: '',
      }
  },
  //ロード時にデータベースから情報を取得
  created:function(){
      var url = '/customers/detail/ajax?id='+this.id
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
        this.customers = response.data.customers[0],
        this.persons = response.data.persons,
        this.products = response.data.products,
        this.products_options = response.data.products_options,
        this.users = response.data.users,

        ])
      .catch(error => console.log(error))



  },
  computed:{
         get_database() {
        //監視するデータを選択
       return [
       this.customers.date_month,
       this.customers.date_year,
       this.customers.persons_id,
       this.customers.products_id,
       ];
   },

},

watch: {
    //監視データに変更がある度にデータベースから情報を出力
    get_database(val){
      let url = '/customers/detail/ajax_change?persons_id=' + this.customers.persons_id+'&date_year='+this.customers.date_year+'&date_month='+this.customers.date_month+'&products_id='+this.customers.products_id;
      axios.get(url)
      .then(response => [
        this.products = response.data.products,
        this.products_options = response.data.products_options,
        console.log(this.products_options)
        
        ])
      .catch(error => console.log(error))

    },


}
}

Vue.createApp(hoge).mount('#app')

</script>
{{-- <script src="{{ asset('js/components/customers_select_product_add.js') }}"></script> --}}

@endsection
