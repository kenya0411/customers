    
@extends('common.base'){{-- 継承元 --}}
@section('title','予約一覧'){{-- タイトル --}}
@section('heading','予約一覧'){{-- 見出し --}}


@section('content')
<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >
</div>

@can('admin')
@include('reserves.components.reserve_test')


@endcan


@endsection

@section('vue')
<script src="/js/vue/reserves_list.js"></script>

@endsection
