    
@extends('common.base'){{-- 継承元 --}}
@section('title','公式LINE一覧'){{-- タイトル --}}
@section('heading','公式LINE一覧'){{-- 見出し --}}


@section('content')


<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >
</div>




{{-- 管理者 --}}
@can('admin')

@include('lines.components.person')

@endcan










@endsection

@section('vue')
<script src="/js/vue/lines_person.js"></script>

@endsection
