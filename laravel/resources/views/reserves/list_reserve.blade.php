    
@extends('common.base'){{-- 継承元 --}}
@section('title','予約一覧'){{-- タイトル --}}
@section('heading','予約一覧'){{-- 見出し --}}


@section('content')

@include('reserves.components.reserve')


@endsection

@section('vue')
<script src="/js/vue/reserves_list.js"></script>

@endsection
