    
@extends('common.base'){{-- 継承元 --}}
@section('title','顧客一覧'){{-- タイトル --}}
@section('heading','顧客一覧'){{-- 見出し --}}


@section('content')

@include('customers.components.search')
@include('customers.components.pagination')

@include('customers.components.customer')
@include('customers.components.pagination')


@endsection



@section('vue')
<script src="/js/vue/customers_list.js"></script>


@endsection
