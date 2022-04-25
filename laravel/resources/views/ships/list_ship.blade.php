    
@extends('common.base'){{-- 継承元 --}}
@section('title','発送予約一覧'){{-- タイトル --}}
@section('heading','発送予約一覧'){{-- 見出し --}}


@section('content')
<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >
</div>

@include('ships.components.search')
@can('admin')
@include('ships.components.ship')
@elsecan('ship')

@include('ships.components.ship_outsource')
@endcan


@endsection

@section('vue')
<script src="/js/vue/ships_list.js"></script>

@endsection
