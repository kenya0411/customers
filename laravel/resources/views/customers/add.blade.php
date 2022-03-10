
@extends('common.base'){{-- 継承元 --}}
@section('title','新規注文'){{-- タイトル --}}
@section('heading','新規注文'){{-- 見出し --}}


@section('content')
    <div class="orderFrom formSection" id="app">   

        <form action="./add" method="post">
            @csrf

            <dl>
                <dt>日付</dt>
                <dd class="dateBlock">      


                   <select name="date_year" v-model="date_year" id="">
                        @php
                        $d = now();
                        $year = $d->format('Y');
                        $year_add = $d->addYears(1)->format('Y');
                        @endphp
                        <option value="{{ $year }}">{{ $year }}年</option>
                        <option value="{{ $year_add }}">{{ $year_add }}年</option>
            </select>
            <select name="date_month" v-model="date_month" id="">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i}}">{{ $i }}月</option>
                @endfor
                  </select>
                  <select name="date_day" v-model="date_day" id="">
                    @for ($i = 1; $i < 32; $i++)
                    <option value="{{ $i }}">{{ $i }}日</option>

                    @endfor
                </select>
                </dd>
                 <dt>商品ID</dt>
                <dd>
                    <input type="text" name="customers_product_id" value="{{ old('customers_product_id') }} " >
                    @error('customers_product_id')
                    <div class="errorMessage">
                        {{ $message }}<br>
                    </div>
                    @enderror
                </dd>
                 <dt>ニックネーム</dt>
                <dd>
                   <input type="text" name="customers_nickname"  value="{{ old('customers_nickname') }} " >
                    @error('customers_nickname')
                    <div class="errorMessage">
                        {{ $message }}<br>
                    </div>
                    @enderror
                </dd>

                 <dt>名前</dt>
                <dd>
                   <input type="text" name="customers_name"  value="{{ old('customers_name') }} " >
                    @error('customers_name')
                    <div class="errorMessage">
                        {{ $message }}<br>
                    </div>
                    @enderror
                </dd>

  

                <dt>鑑定士</dt>
                <dd>
                    <select name="persons_id" v-model="v_persons" id="">

                        @foreach ($persons as $person)
                        <option value="{{ $person->persons_id}}">{{ $person->persons_name}}</option>
                        @endforeach
                    </select>
                </dd>
     

                   <dt>商品名</dt>
                <dd>            
                        <select name="products_id" v-model="v_products" id="">
      <option v-for="product in products"  v-bind:value="product.products_id" >@{{ product.products_name }}</option>
                    
                </select>

                </dd>
    
                       <dt>オプション名</dt>
                <dd class="flex">            
           <select name="products_options_id" v-model="v_products_options" id="">
      <option value="" ></option>

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
                 <dt> 住所</dt>
                <dd>            
                    <textarea name="customers_address" id="" cols="30" rows="10" value="{{ old('customers_name') }} "></textarea>
                    @error('customers_address')
                    <div class="errorMessage">
                        {{ $message }}<br>
                    </div>
                    @enderror
                </dd>

                 <dt> 悩み</dt>
                <dd>            
                        <textarea name="customers_worry" id="" cols="30" rows="10" value="{{ old('customers_worry') }} "></textarea>
                    @error('customers_worry')
                    <div class="errorMessage">
                        {{ $message }}<br>
                    </div>
                    @enderror
                </dd>

    
        </dl>
        <div class="btnWrap">
            <input type="submit" class="sendBtn" value="登録する">
            
        </div>

    </form>
</div>




<script>


var data = new Date();
var today = data.getDate();
var year = data.getFullYear();
var month = data.getMonth()+ 1 ;
console.log(today)
    const hoge = {
      el: '#app',
      data () {
        return {
          persons: '', 
          products: '',
          products_options: '',
          users: '',
          customers: '',
          date_year: year,
          date_month: month,
          date_day: today,
          v_persons: "",
          v_products: "",
          v_products_options: "",
      }
  },
  //ロード時にデータベースから情報を取得
  created:function(){
      var url = '/customers/ajax'
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
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
       this.date_month,
       this.date_year,
       this.v_persons,
       this.v_products,
       this.v_products_options,
       ];
   },

},

watch: {
    //監視データに変更がある度にデータベースから情報を出力
    get_database(val){
      let url = '/customers/detail/ajax_change?persons_id=' + this.v_persons+'&date_year='+this.date_year+'&date_month='+this.date_month+'&products_id='+this.v_products;
      axios.get(url)
      .then(response => [

        this.products = response.data.products,
        this.products_options = response.data.products_options,
        console.log(response.data),
        
        ])
      .catch(error => console.log(error))

    },


}
}
Vue.createApp(hoge).mount('#app')

</script>






@endsection
