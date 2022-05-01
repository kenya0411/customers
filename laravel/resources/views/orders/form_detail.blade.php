
@extends('common.base'){{-- 継承元 --}}
@section('title','注文編集'){{-- タイトル --}}
@section('heading','注文編集'){{-- 見出し --}}


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


@can('admin')
@include('orders.components.detail')
@elsecan('fortune')
@include('orders.components.detail_fortune')
@elsecan('comment')
@include('orders.components.detail_comment')
@endcan




@endsection

@section('vue')
<script src="/js/vue/orders_detail.js"></script>

@endsection



