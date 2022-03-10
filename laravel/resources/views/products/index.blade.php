    
@extends('common.base'){{-- 継承元 --}}
@section('title','product'){{-- タイトル --}}
@section('heading','productリスト'){{-- 見出し --}}


@section('content')
<section class="maxWid mbPad addBtnBlock"> 


    <div class="addbtnWrap">

        <div class="addbtn">
            <a href="/products/add">新規追加</a>
        </div> 

        <div class="addbtn">
            <a href="/products/add_option">オプション追加</a>
        </div> 
    </div>
</section>

@include('products.components.search')

@include('products.components.product_list')





@include('products.components.product_option_list')
    








<section class="cloneBlock maxWid mbPad">

    <form method="POST" action="/products/clone/">
     @csrf
     <div class="flex3"><input type="text" name="new_date_year" value="{{$dates['year']}}">年</div>
     <div class="flex3"><input type="text" name="new_date_month" value="{{$dates['month'] +1}}">月</div>
     <div class="flex3"><input type="submit"class="cloneBtn" value="複製する"></div>





     <input type="hidden" name="clone_date_year" value="{{$dates['year']}}">
     <input type="hidden" name="clone_date_month" value="{{$dates['month']}}">

 </form>

</section>
















<script>


    $('.cloneBtn').click(function () {
      if (confirm('複製してもいいですか？')) {
      } else {
        return false
    }
});
    $('.deleteBtn').click(function () {
      if (confirm('削除してもいいですか？')) {
    // 「OK」をクリックした際の処理を記述
    $(this).parents('form').attr('action', $(this).data('action'));
    $(this).parents('form').submit();
} else {
    //キャンセルした場合
    //何も起きない
    return false
}
});
</script>
@endsection