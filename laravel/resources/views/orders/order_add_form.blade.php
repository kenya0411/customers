
@extends('common.base'){{-- 継承元 --}}
@section('title','新規注文'){{-- タイトル --}}
@section('heading','新規注文'){{-- 見出し --}}


@section('content')
<div class="backBlock">
    <div class="commonBtnFlex">
        
<div class="backBtn">
    <a href="#" onClick="history.back(); return false;">戻る</a>
</div>
<div class="backListBtn">
    <a href="../" >注文ページ一覧へ</a>
</div>
    </div>

</div>



@include('orders.components.add')


@endsection

@section('vue')
<script src="/js/vue/orders_add.js"></script>

@endsection



