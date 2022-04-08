
@extends('common.base'){{-- 継承元 --}}
@section('title','顧客情報詳細'){{-- タイトル --}}
@section('heading','顧客情報詳細'){{-- 見出し --}}


@section('content')
<div class="backBlock">
    <div class="commonBtnFlex">
        
<div class="backBtn">
    <a href="#" onClick="history.back(); return false;">戻る</a>
</div>
<div class="backListBtn">
    <a href="../" >顧客ページ一覧へ</a>
</div>
    </div>

</div>



@include('customers.components.customer_detail')


@endsection

@section('vue')
<script src="/js/vue/customers_detail.js"></script>

@endsection



