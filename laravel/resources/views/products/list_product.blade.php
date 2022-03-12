    
@extends('common.base'){{-- 継承元 --}}
@section('title','商品リスト'){{-- タイトル --}}
@section('heading','商品リスト'){{-- 見出し --}}


@section('content')

        <div class="addbtnWrap">

    <div class="addbtn">
        <a href="/products/add">新規商品追加</a>
    </div> 
</div>
@include('products.components.search')

@include('products.components.product')





{{-- @include('products.components.product_option_list') --}}
    







{{-- 
<section class="cloneBlock maxWid mbPad">

    <form method="POST" action="/products/clone/">
     @csrf
     <div class="flex3"><input type="text" name="new_date_year" value="{{$dates['year']}}">年</div>
     <div class="flex3"><input type="text" name="new_date_month" value="{{$dates['month'] +1}}">月</div>
     <div class="flex3"><input type="submit"class="cloneBtn" value="複製する"></div>





     <input type="hidden" name="clone_date_year" value="{{$dates['year']}}">
     <input type="hidden" name="clone_date_month" value="{{$dates['month']}}">

 </form>

</section> --}}
















<script>


//     $('.cloneBtn').click(function () {
//       if (confirm('複製してもいいですか？')) {
//       } else {
//         return false
//     }
// });
//     $('.deleteBtn').click(function () {
//       if (confirm('削除してもいいですか？')) {
//     // 「OK」をクリックした際の処理を記述
//     $(this).parents('form').attr('action', $(this).data('action'));
//     $(this).parents('form').submit();
// } else {
//     //キャンセルした場合
//     //何も起きない
//     return false
// }
// });
// 
// 



// var data = new Date();
// var year = data.getFullYear();
// var month = data.getMonth()+ 1 ;
//     let params = (new URL(document.location)).searchParams//クエリ取得用


</script>
@endsection
