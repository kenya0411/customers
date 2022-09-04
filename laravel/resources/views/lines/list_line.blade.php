    
@extends('common.base'){{-- 継承元 --}}
@section('title','LINEメッセージ一覧'){{-- タイトル --}}
@section('heading','LINEメッセージ一覧'){{-- 見出し --}}


@section('content')


<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >
</div>
{{-- @include('lines.components.search') --}}

@can('admin')
@endcan

@include('common.components.pagination')

@can('admin')
@include('lines.components.line')
@elsecan('fortune')
@include('lines.components.line_fortune')
@elsecan('comment')
@include('lines.components.line_comment')
@endcan


@include('common.components.pagination')


@endsection

@section('vue')
<script src="/js/vue/lines_list.js"></script>

@endsection
