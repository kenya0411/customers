    
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
@include('common.components.pagination')

@include('products.components.product')
@include('common.components.pagination')




@endsection
@section('vue')
<script src="/js/vue/products_list.js"></script>


@endsection
