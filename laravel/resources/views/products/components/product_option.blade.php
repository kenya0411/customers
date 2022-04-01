<div class="productOptionList listSection"> 

<ul>
    <li class="flexHead flexWrap">

<div class="pcBlock">



{{-- <div class="flexHead flexWrap flexWrap7"> --}}
        <div>鑑定士名</div>
        <div>商品名</div>
        <div>オプション名</div>
        <div >料金</div>
        <div >詳細</div>
        <div>編集</div>
        <div >削除</div>
    </div>
    <div class="mbBlock">
        <div>鑑定士</div>
        <div>商品名</div>

        <div>オプション名</div>
        <div></div>
     </div>
    </li>

    <li class="flexBodyWrap flexWrap" v-for="(product_option, index) in products_options">

 <div class="mbBlock">
                <div class="no0">@{{ persons[product_option.persons_id - 1].persons_name }}</div>
                <div class="no0">@{{ products[product_option.products_id - 1].products_name }}</div>
            <div class="no2">@{{ product_option.products_options_name }}</div>
            <div class="no3">
<i class="fa-solid fa-circle-chevron-down"></i>    
<i class="fa-solid fa-circle-chevron-up"></i>    
    
</div>
</div>
        <form action="/products_options/edit" method="post" class="pcBlock">
            @csrf
            <input type="hidden" name="products_options_id" :value="product_option.products_options_id">

          <div >
@{{ persons[product_option.persons_id - 1].persons_name }}
            </div>
          <div >
{{-- @{{ products[product_option.products_id - 1].products_name }} --}}
{{-- @{{ products[product_option.products_id - 1].products_name }} --}}
@{{ products[product_option.products_id - 1].products_name }}
{{-- @{{ products[product_option.products_id - 1] }} --}}
            </div>
            <div><input type="text" name="products_options_name" :value="product_option.products_options_name"></div>
            <div ><input type="text" name="products_options_price" :value="product_option.products_options_price"></div>
        
            <div >

                <textarea name="products_options_detail" id="" :value="product_option.products_options_detail"  >@{{product_option.products_options_detail }}</textarea>
            </div>

            <div ><input class="submit editBtn" type="submit" value="編集"></div>
            <div ><input class="submit deleteBtn" type="submit" value="削除" data-action="/products_options/delete"></div>
         
{{--         <input type="hidden" name="search_date_year" value="{{ $dates['year'] }}">
            <input type="hidden" name="search_date_month" value="{{ $dates['month'] }}">
            <input type="hidden" name="search_persons_id" value="{{ $dates['persons_id'] }}"> --}}
            {{-- <input type="hidden" name="post_type" value="edit"> --}}
            {{-- <input type="hidden" name="products_options_id" value="{{ $product_option->products_options_id }}"> --}}
            {{-- <input type="hidden" name="products_number" value="{{ $product_option->products_number }}"> --}}
            {{-- <input type="hidden" name="products_options_number" value="{{ $product_option->products_options_number }}"> --}}
            {{-- <div class="no0">{{My_func::searchPersonName($persons,$product_option->persons_id)}}</div> --}}
            {{-- <div class="no1"> --}}
         {{-- {{My_func::searchProductName($products,$product_option->products_number)}} --}}

            {{-- </div> --}}
    {{--         <div class="no1"><input type="text" name="products_options_name" value="{{ $product_option->products_options_name }}"></div>
            <div class="no2"><input type="text" name="products_options_price" value="{{ number_format($product_option->products_options_price) }}円"></div>
            <div class="no4"><input type="text" name="products_options_detail" value="{{ $product_option->products_options_detail }}"></div>

            <div class="no5"><input class="submit editBtn" type="submit" value="edit"></div>
            <div class="no6"><input class="submit deleteBtn" type="submit" value="delete" data-action="/products/delete_option"></div> --}}


        </form>
</li>


    </ul>
    </div>



<script>

    
</script>