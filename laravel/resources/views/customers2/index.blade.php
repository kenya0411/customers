    
@extends('common.base'){{-- 継承元 --}}
@section('title','注文一覧'){{-- タイトル --}}
@section('heading','注文一覧'){{-- 見出し --}}


@section('content')
{{-- <div class="addBtnBlock"> 


    <div class="addbtnWrap">

        <div class="addbtn">
            <a href="/customers/add">新規追加</a>
        </div> 


    </div>
</div> --}}
<div id="app">


@include('customers.components.search')
@include('customers.components.customer_list')


</div>




{{-- @include('products.components.product_option_list') --}}
    

<script>
$(window).on('load',function(){
    $(document).on('click','.flexBodyWrap .mbBlock',function(){
    // $(".flexBodyWrap .mbBlock").on('click',function () {
  $(this).next('.pcBlock').slideToggle('fast');
  $(this).toggleClass('selected_mb');
  $(this).next('.pcBlock').toggleClass('selected_pc');
});
    });

</script>


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
          products: '',
          products_options: '',
          users: '',
          customers: '',
          search_date_year:year,
          search_date_month:month,
          search_persons:'',
      }
  },
  //ロード時にデータベースから情報を取得
  created:function(){
      var url = '/customers/ajax'
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
        this.customers = response.data.customers,
        this.persons = response.data.persons,
        this.products = response.data.products,
        this.products_options = response.data.products_options,
        this.users = response.data.users,
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





<script>
//   if (window.matchMedia( "(max-width: 768px)" ).matches) {
  
//    // $(function(){]
   
//    $(window).on('load',function(){
       
//   $("[data-name='click-open']").on("click", function() {

//     $(this).siblings('div').not('.no1').slideToggle("fast");

//   });
// });
//  }
 
//     jQuery(function($){
//  console.log('test')
 
//   // ①マウスをボタンに乗せた際のイベントを設定
//   $('[data-name="click-open"]').on('click',function() {
//  console.log('test')

//     // ②乗せたボタンに連動したメガメニューをスライドで表示させる
//     $(this).siblings('div').stop().slideDown("fast");
 
//   // ③マウスをボタンから離した際のイベントを設定
//   }, function() {
 
//     // ④マウスを離したらメガメニューをスライドで非表示にする
//     $(this).find('.menu_contents').stop().slideUp("fast");
 
//   });
 
// });
</script>





@endsection
