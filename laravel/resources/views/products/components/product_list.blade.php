<section class="productList maxWid mbPad listSection"> 
<div class="heading">
    <h3>productリスト</h3>
</div>
    <div class="flexHead flexWrap flexWrap7">
        <div class="no0">persons_name</div>
        <div class="no1">products_name</div>
        <div class="no2">products_price</div>
        <div class="no3">products_method</div>
        <div class="no4">products_detail</div>
        <div class="no5">編集</div>
        <div class="no6">削除</div>
    </div>
    <div class="flexBodyWrap ">  
        @foreach ($products as $product)

        <form action="/products/edit" method="post" class="flexWrap flexWrap7 flexBody">
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

            <div class="no5"><input class="submit editBtn" type="submit" value="edit"></div>
            <div class="no6"><input class="submit deleteBtn" type="submit" value="delete" data-action="/products/delete"></div>


        </form>


        @endforeach
    </div>


</section>
