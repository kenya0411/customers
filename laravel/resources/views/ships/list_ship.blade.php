    
@extends('common.base'){{-- 継承元 --}}
@section('title','発送予約一覧'){{-- タイトル --}}
@section('heading','発送予約一覧'){{-- 見出し --}}


@section('content')

@include('ships.components.ship')


@endsection

@section('vue')
<script src="/js/vue/ships_list.js"></script>

@endsection
