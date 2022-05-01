    
@extends('common.base'){{-- 継承元 --}}
@section('title','注文一覧'){{-- タイトル --}}
@section('heading','注文一覧'){{-- 見出し --}}


@section('content')


<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >
</div>
@include('orders.components.search')

@can('admin')
@include('orders.components.price')
@endcan

@include('common.components.pagination')

@can('admin')
@include('orders.components.order')
@elsecan('fortune')
@include('orders.components.order_fortune')
@elsecan('comment')
@include('orders.components.order_comment')
@endcan


@include('common.components.pagination')


@endsection

@section('vue')
<script src="/js/vue/orders_list.js"></script>

@endsection
