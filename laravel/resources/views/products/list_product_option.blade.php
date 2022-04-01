    
@extends('common.base'){{-- 継承元 --}}
@section('title','オプションリスト'){{-- タイトル --}}
@section('heading','オプションリスト'){{-- 見出し --}}


@section('content')

<div class="addbtnWrap">

    <div class="addbtn">
        <a href="/products_options/add">オプション追加</a>
    </div> 
</div>



@include('products.components.search')

@include('common.components.pagination')

@include('products.components.product_option')
@include('common.components.pagination')
    





@endsection


@section('vue')
<script src="/js/vue/products_option_list.js"></script>


@endsection
