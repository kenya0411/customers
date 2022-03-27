    
@extends('common.base'){{-- 継承元 --}}
@section('title','customers'){{-- タイトル --}}
@section('heading','customersリスト'){{-- 見出し --}}


@section('content')
<section class="maxWid mbPad addBtnBlock"> 


    <div class="addbtnWrap">

        <div class="addbtn">
            <a href="/customers/add">新規追加</a>
        </div> 


    </div>
</section>
<div id="app">

{{-- @include('customers.components.search') --}}

@include('customers.components.customer_reserve_list')
</div>





{{-- @include('products.components.product_option_list') --}}
    


<script>



var data = new Date();
var year = data.getFullYear();
var month = data.getMonth()+ 1 ;
    let params = (new URL(document.location)).searchParams//クエリ取得用
    const hoge = {
      el: '#app',
      data () {
        return {
          persons: '', 
          id: params.get('id'),
          customers: '',
      }
  },
  //ロード時にデータベースから情報を取得
  created:function(){
      var url = '/customers/reserve_ajax'
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
        this.customers = response.data.customers,
        console.log(this.customers)
        ])
      .catch(error => console.log(error))



  },
  computed:{
         get_search_data() {
       return [
       this.search_date_month,
       this.search_date_year,
       this.search_persons,
       ];
   },


},
watch: {
    get_search_data(val){
      let url = '/customers/ajax_search/?persons_id=' + this.search_persons+'&date_year='+this.search_date_year+'&date_month='+this.search_date_month;
      console.log(url)
      axios.get(url)
      .then(response => [
        this.customers = response.data.customers,
        // this.products = response.data.products,
        // this.products_options = response.data.products_options,
        // this.users = response.data.users,
        console.log(this.products_options)
        
        ])
      .catch(error => console.log(error))

    },


}
}

Vue.createApp(hoge).mount('#app')

</script>







@endsection
