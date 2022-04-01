<div class="productList listSection"> 
<ul>
    <li class="flexHead flexWrap">
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
        {{-- @foreach ($products as $product) --}}
    <li class="flexBodyWrap flexWrap" v-for="(product, index) in products">



 <div class="mbBlock">
                <div class="no0">@{{ persons[product.persons_id - 1].persons_name }}</div>
            <div class="no1">@{{ product.products_name }}</div>
            <div class="no3">
<i class="fa-solid fa-circle-chevron-down"></i>    
<i class="fa-solid fa-circle-chevron-up"></i>    
    
</div>
</div>

        <form action="/products/edit" method="post" class="pcBlock">
            @csrf
            <input type="hidden" name="products_id" :value="product.products_id">
  
            <div class="no0">
@{{ persons[product.persons_id - 1].persons_name }}
            </div>
            <div ><input type="text" name="products_name" :value="product.products_name"></div>
            <div ><input type="text" name="products_price" :value="product.products_price"></div>
            <div ><input type="text" name="products_method" :value="product.products_method"></div>
            <div >

                <textarea name="products_detail" id="" :value="product.products_detail"  >@{{product.products_detail }}</textarea>
            </div>

            <div ><input class="submit editBtn" type="submit" value="編集"></div>
            <div><input class="submit deleteBtn" type="submit" value="削除" data-action="/products/delete"></div>


        </form>
    </li>

        {{-- @endforeach --}}


</ul>
</div>



<script>




</script>

