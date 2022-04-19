    
@extends('common.base'){{-- 継承元 --}}
@section('title','予約一覧'){{-- タイトル --}}
@section('heading','予約一覧'){{-- 見出し --}}


@section('content')
<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >
</div>
@include('reserves.components.reserve')


@endsection

@section('vue')
<script src="/js/vue/reserves_list.js"></script>

@endsection
