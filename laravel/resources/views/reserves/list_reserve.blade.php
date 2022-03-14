    
@extends('common.base'){{-- 継承元 --}}
@section('title','注文一覧'){{-- タイトル --}}
@section('heading','予約一覧'){{-- 見出し --}}


@section('content')
{{-- <div class="addBtnBlock"> 


    <div class="addbtnWrap">

        <div class="addbtn">
            <a href="/customers/add">新規追加</a>
        </div> 


    </div>
</div> --}}


@include('orders.components.search')
@include('orders.components.order')






{{-- @include('products.components.product_option_list') --}}
    

{{-- <script>
$(window).on('load',function(){
    $(document).on('click','.flexBodyWrap .mbBlock',function(){
    // $(".flexBodyWrap .mbBlock").on('click',function () {
  $(this).next('.pcBlock').slideToggle('fast');
  $(this).toggleClass('selected_mb');
  $(this).next('.pcBlock').toggleClass('selected_pc');
});
    });

</script>


 --}}






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
