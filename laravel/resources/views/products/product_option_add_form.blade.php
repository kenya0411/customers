    
@extends('common.base'){{-- 継承元 --}}
@section('title','新規オプション登録画面'){{-- タイトル --}}

@section('heading','新規オプション登録画面'){{-- 見出し --}}

@section('content')
<div class="backBlock">
    <div class="commonBtnFlex">
        <div class="backBtn">
            <a href="#" onClick="history.back(); return false;">戻る</a>
        </div>
        <div class="backListBtn">
            <a href="/products_options" >オプション一覧へ</a>
        </div>
    </div>

</div>
@include('products.components.product_option_add')
@endsection

@section('vue')
<script src="/js/vue/products_options_add.js"></script>

@endsection



