    
@extends('common.base'){{-- 継承元 --}}
@section('title','顧客一覧'){{-- タイトル --}}
@section('heading','顧客一覧'){{-- 見出し --}}


@section('content')

@include('customers.components.search')
@include('customers.components.customer')


@endsection



@section('vue')
<script src="/js/vue/customer_list.js"></script>


@endsection
