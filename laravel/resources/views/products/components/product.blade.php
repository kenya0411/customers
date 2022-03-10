<div class="productList listSection"> 
<ul>
    <li class="flexHead flexWrap">

    {{-- <div class="flexHead flexWrap flexWrap7"> --}}
<div class="pcBlock">

        <div class="no0">鑑定士</div>
        <div class="no1">商品名</div>
        <div class="no2">料金</div>
        <div class="no3">鑑定方法</div>
        <div class="no4">詳細</div>
        <div class="no5">編集</div>
        <div class="no6">削除</div>
    </div>

<div class="mbBlock">
        <div>鑑定士</div>
        <div>商品名</div>
     </div>
    </li>
        @foreach ($products as $product)
    <li class="flexBodyWrap flexWrap">  

 <div class="mbBlock">
</div>

        <form action="/products/edit" method="post" class="pcBlock">
            @csrf
{{-- 
            <input type="hidden" name="post_type" value="edit"> --}}
            <input type="hidden" name="products_number" value="{{ $product->products_number }}">
            <input type="hidden" name="products_id" value="{{ $product->products_id }}">
            <input type="hidden" name="search_date_year" value="{{ $dates['year'] }}">
            <input type="hidden" name="search_date_month" value="{{ $dates['month'] }}">
            <input type="hidden" name="search_persons_id" value="{{ $dates['persons_id'] }}">
            <div class="no0">{{My_func::searchPersonName($persons,$product->persons_id)}}</div>
            <div class="no1"><input type="text" name="products_name" value="{{ $product->products_name }}"></div>
            <div class="no2"><input type="text" name="products_price" value="{{ number_format($product->products_price) }}円"></div>
            <div class="no3"><input type="text" name="products_method" value="{{ $product->products_method }}"></div>
            <div class="no4">

                <textarea name="products_detail" id="" value="{{ $product->products_detail }}"  >{{ $product->products_detail }}</textarea>
            </div>

            <div class="no5"><input class="submit editBtn" type="submit" value="編集"></div>
            <div class="no6"><input class="submit deleteBtn" type="submit" value="削除" data-action="/products/delete"></div>


        </form>
    </li>

        @endforeach


</ul>
</div>

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

