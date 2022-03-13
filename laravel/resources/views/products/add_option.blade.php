    
@extends('common.base'){{-- 継承元 --}}
@section('title','新規オプション登録画面'){{-- タイトル --}}

@section('heading','新規オプション登録画面'){{-- 見出し --}}

@section('content')

    <div class="backBtn">
        <a href="/products_options">戻る</a>
    </div> 

<div class="productFrom formSection" >   

    <form action="./add" method="post">
        @csrf

        <dl>
 

            <dt>鑑定士</dt>
            <dd>
 <select name="persons_id" v-model="search_persons" id="" required>
      <option v-for="person in persons"  v-bind:value="person.persons_id" >@{{ person.persons_name }}</option>
                    
        
                    </select>
            </dd>
            <dt>商品名</dt>
            <dd>


                <select name="products_id" v-model="search_products" id="" required>
                    {{-- <option value=""></option> --}}
      <option v-for="product in products"  v-bind:value="product.products_id" >@{{ product.products_name }}</option>
                    
                </select>
            </dd>

            <dt> オプション名</dt>
            <dd>            
                <input type="text" name="products_options_name" value="{{ old('products_options_name') }} " required="required">
                @error('products_options_name')
                <div class="errorMessage">
                    {{ $message }}<br>

                </div>
                @enderror
            </dd>
            <dt> オプション料金</dt>
            <dd>            
                <input type="number" name="products_options_price" inputmode="numeric" value="{{ old('products_price') }} " >
                @error('products_options_price')
                <div class="errorMessage">
                    {{ $message }}<br>
                </div>
                @enderror
            </dd>



            <dt> オプション詳細</dt>
            <dd>            
                <textarea name="products_options_detail" id="" cols="30" rows="10"></textarea>
                @error('products_options_detail')
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
//  const hoge = {
//   el: '#app',
//   data () {
//     return {
//       products: [],
//       v_products: '',
//       persons: [],
//       v_persons: '',
//     }
//   },


//     watch: {
// v_date_year(val){
//     this.v_date_year = val
//     this.v_persons = ''

//     this.products = ''

// },
// v_date_month(val){
//     this.v_date_month = val
//     this.v_persons = ''

//     this.products = ''

// },
// v_persons(val){
//       let url = '/products/add_option_ajax?persons_id=' + val+'&date_year='+this.v_date_year+'&date_month='+this.v_date_month;
// if(val){
//     axios.get(url)
//       .then(response => [
//         this.products = response.data,
//         ])
//       .catch(error => console.log(error))
// }

// },

//   }

// }


//     Vue.createApp(hoge).mount('#app')

    mbSlideToggle();
    
  
    const hoge = {
      el: '.main_content',
      data () {
        return {
          persons: '', 
          products: '',
          search_persons: '',//検索用
      }
  },
  //ロード時にデータベースから情報を取得
  created:function(){
      var url = '/products/ajax'
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
        this.persons = response.data.persons,
        this.products = response.data.products,
        ])
      .catch(error => console.log(error))
  },
  computed:{
         get_search_data() {
       return [
       this.search_persons,
       ];
   },


},
watch: {
    get_search_data(val){
      let url = '/products/ajax_search/?persons_id=' + this.search_persons;
      console.log(url)
      axios.get(url)
      .then(response => [
        // this.persons = response.data.persons,
        this.products = response.data.products,
        console.log(this.products),
        
        ])
      .catch(error => console.log(error))

    },


}
}

Vue.createApp(hoge).mount('.main_content')
</script>

@endsection
