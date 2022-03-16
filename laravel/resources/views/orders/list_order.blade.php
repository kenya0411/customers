    
@extends('common.base'){{-- 継承元 --}}
@section('title','注文一覧'){{-- タイトル --}}
@section('heading','注文一覧'){{-- 見出し --}}


@section('content')

@include('orders.components.search')
@include('orders.components.order')


@endsection

@section('vue')
<script src="/js/vue/orders_list.js"></script>

@endsection
