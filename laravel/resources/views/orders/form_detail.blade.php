
@extends('common.base'){{-- 継承元 --}}
@section('title','注文編集'){{-- タイトル --}}
@section('heading','注文編集'){{-- 見出し --}}


@section('content')
<div class="backBlock">
    
<div class="backBtn">
    <a href="../">戻る</a>
</div>
</div>



@include('orders.components.detail')


@endsection

@section('vue')
<script src="/js/vue/detail_form.js"></script>

@endsection



