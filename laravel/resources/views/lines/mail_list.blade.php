    
@extends('common.base'){{-- 継承元 --}}
@section('title','LINEメールアドレス一覧'){{-- タイトル --}}
@section('heading','LINEメールアドレス一覧'){{-- 見出し --}}


@section('content')


<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >
</div>




{{-- 管理者 --}}
@can('admin')

@include('lines.components.mail')

@endcan










@endsection

@section('vue')
<script src="/js/vue/lines_mail.js"></script>

@endsection
