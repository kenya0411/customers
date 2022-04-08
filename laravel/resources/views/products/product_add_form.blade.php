    
@extends('common.base'){{-- 継承元 --}}
@section('title','商品登録画面'){{-- タイトル --}}
@section('heading','商品登録画面'){{-- 見出し --}}


@section('content')
<div class="backBlock">
    <div class="commonBtnFlex">
        <div class="backBtn">
            <a href="#" onClick="history.back(); return false;">戻る</a>
        </div>
        <div class="backListBtn">
            <a href="/products" >商品一覧へ</a>
        </div>
    </div>

</div>


@include('products.components.product_add')



@endsection
