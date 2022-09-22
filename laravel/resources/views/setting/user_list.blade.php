    
@extends('common.base'){{-- 継承元 --}}
@section('title','ユーザー情報一覧'){{-- タイトル --}}
@section('heading','ユーザー情報一覧'){{-- 見出し --}}


@section('content')


<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >
</div>




{{-- 管理者 --}}
@can('admin')
@include('setting.user.list')


@endcan










@endsection

@section('vue')
<script src="/js/vue/setting_users_list.js"></script>

@endsection
