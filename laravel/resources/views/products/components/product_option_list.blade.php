<section class="productOptionList maxWid mbPad listSection"> 


 
<div class="heading">
    <h3>products_optionsリスト</h3>
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
        @foreach ($products_options as $product_option)

        <form action="/products/edit_option" method="post" class="flexWrap flexWrap7 flexBody">
            @csrf
        <input type="hidden" name="search_date_year" value="{{ $dates['year'] }}">
            <input type="hidden" name="search_date_month" value="{{ $dates['month'] }}">
            <input type="hidden" name="search_persons_id" value="{{ $dates['persons_id'] }}">
            {{-- <input type="hidden" name="post_type" value="edit"> --}}
            <input type="hidden" name="products_options_id" value="{{ $product_option->products_options_id }}">
            <input type="hidden" name="products_number" value="{{ $product_option->products_number }}">
            {{-- <input type="hidden" name="products_options_number" value="{{ $product_option->products_options_number }}"> --}}
            <div class="no0">{{My_func::searchPersonName($persons,$product_option->persons_id)}}</div>
            <div class="no1">
         {{My_func::searchProductName($products,$product_option->products_number)}}

            </div>
            <div class="no1"><input type="text" name="products_options_name" value="{{ $product_option->products_options_name }}"></div>
            <div class="no2"><input type="text" name="products_options_price" value="{{ number_format($product_option->products_options_price) }}円"></div>
            <div class="no4"><input type="text" name="products_options_detail" value="{{ $product_option->products_options_detail }}"></div>

            <div class="no5"><input class="submit editBtn" type="submit" value="edit"></div>
            <div class="no6"><input class="submit deleteBtn" type="submit" value="delete" data-action="/products/delete_option"></div>


        </form>


        @endforeach
    </section>
