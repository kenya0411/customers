
@extends('common.base'){{-- 継承元 --}}
@section('title','LINEメッセージ'){{-- タイトル --}}
@section('heading','LINEメッセージ'){{-- 見出し --}}


@section('content')
<div class="backBlock">
    <div class="commonBtnFlex">
        
<div class="backBtn">
    <a href="#" onClick="history.back(); return false;">戻る</a>
</div>
<div class="backListBtn">
    <a href="../" >注文ページ一覧へ</a>
</div>
    </div>

</div>


@can('admin')
@include('lines.components.message')
@elsecan('fortune')
@include('lines.components.message')
@elsecan('comment')
@include('lines.components.message')
@endcan




@endsection

@section('vue')
<script src="/js/vue/lines_message.js"></script>

@endsection



