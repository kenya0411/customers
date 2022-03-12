@extends('common.base'){{-- 継承元 --}}
@section('title','鑑定士'){{-- タイトル --}}
@section('heading','鑑定士リスト'){{-- 見出し --}}

@section('content')
        <div class="addbtnWrap">

    <div class="addbtn">
        <a href="/person/add">新規鑑定士追加</a>
    </div> 
</div>
    <div class="personList listSection">  


<ul>
    <li class="flexHead flexWrap">

{{-- <div class="flexHead flexWrap6 flexWrap"> --}}
<div class="pcBlock">

        <div class="no1">鑑定士</div>
        <div class="no2">プラットフォーム</div>
        <div class="no3">URL</div>
        <div class="no4">手数料</div>
        <div class="no5">編集</div>
        <div class="no6">削除</div>
        </div>

<div class="mbBlock">
        <div>鑑定士</div>
        <div>商品名</div>
     </div>
    </li>

    @foreach ($items as $item)
    <li class="flexBodyWrap flexWrap">  

 <div class="mbBlock">
                <div class="no1">
                    
        {{ $item->persons_name }}
                </div>
<div class="no3">
<i class="fa-solid fa-circle-chevron-down"></i>    
<i class="fa-solid fa-circle-chevron-up"></i>    
    
</div>
</div>

<form action="/person/edit" method="post" class="pcBlock">
@csrf
<input type="hidden" class="d-none" name="post_type" value="edit">
<input type="hidden" class="d-none" name="persons_id" value="{{ $item->persons_id }}">
 <div class="no1"><input type="text" name="persons_name" id="persons_name" value="{{ $item->persons_name }}"></div>
 <div class="no2"><input type="text" name="persons_platform_name" id="persons_platform_name" value="{{ $item->persons_platform_name }}"></div>
 <div class="no3"> <input type="text" name="persons_platform_url" id="persons_platform_url" value="{{ $item->persons_platform_url }}"></div>
 <div class="no4"><input type="text" name="persons_platform_fee" id="persons_platform_fee" value="{{ $item->persons_platform_fee }}"></div>
 <div class="no5"><input class="submit editBtn" type="submit" value="修正" data-action="/person/edit"></div>
 <div class="no6"><input class="submit deleteBtn" type="submit" value="削除" data-action="/person/delete"></div>

    
</form>

</li>
    @endforeach
</div>

    </div>
            


<script>
deleteBtnConfirm();
mbSlideToggle();

</script>
@endsection
