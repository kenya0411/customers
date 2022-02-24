@extends('common.base'){{-- 継承元 --}}
@section('title','add'){{-- タイトル --}}
@section('heading','product登録画面'){{-- 見出し --}}


@section('content')
<div id="app">

    <select name="persons" v-model="v_persons" >
<option disabled value="">鑑定士の選択</option>
      @foreach ($persons as $person)
      <option value="{{ $person->persons_id }}" selected>{{ $person->persons_name }}</option>
        
      @endforeach
</select>
    <select name="products" v-model="v_products" >
{{-- <option disabled value="">商品の選択</option> --}}

      <option v-for="product in products"  v-bind:value="product.products_id" >@{{ product.products_name }}</option>
</select>
    <select name="products_options" v-model="v_products_options">
{{-- <option disabled value="">オプションの選択</option> --}}

      <option v-for="product_option in products_options" v-bind:value="product_option.products_options_id">@{{ product_option.products_options_name }}</option>
</select>
    

    {{-- <button>Submit!</button> --}}

<script>


 const hoge = {
  el: '#app',
  data () {
    return {
      products: [],
      v_products: '',
      persons: [],
      v_persons: '',
      products_options: [],
      v_products_options: '',
    }
  },

    watch: {
v_persons(val){
      let url = '/ajax/vue?persons_id=' + val

    axios.get(url)
      .then(response => [
        this.products = response.data,
        this.products_options = '',
        ])
      .catch(error => console.log(error))

},
    v_products(val) {
      let url = '/ajax/vue_option?products_id=' + val
            axios.get(url)
           .then(res => {
             // resで受け取ったコントローラの返り値(商品点数)をitemsに代入します
             this.products_options = res.data

                })
    },
  }

}


    Vue.createApp(hoge).mount('#app')



</script>



@endsection