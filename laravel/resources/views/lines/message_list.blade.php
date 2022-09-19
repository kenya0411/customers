    
@extends('common.base'){{-- 継承元 --}}
@section('title','LINEメッセージ一覧'){{-- タイトル --}}
@section('heading','LINEメッセージ一覧'){{-- 見出し --}}


@section('content')


<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >
</div>




{{-- 管理者 --}}
@can('admin')
<div class="lineFlex">
  <div class="lineFlexLeft">
@include('lines.components.message.customer_list')

  </div>
  <div class="lineFlexRight"  v-if="lines_list[0]">
@include('lines.components.message')
    
  </div>
</div>
@endcan



{{-- コメント --}}
@can('comment')
<div class="lineFlex">
  <div class="lineFlexLeft">
@include('lines.components.message.customer_list')

  </div>
  <div class="lineFlexRight"  v-if="lines_list[0]">
@include('lines.components.message')
    
  </div>
</div>
@endcan








@endsection

@section('vue')
{{-- <script src="/js/vue/lines_test.js"></script> --}}

<script src="/js/vue/lines_message.js"></script>

@endsection
