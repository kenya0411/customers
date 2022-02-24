@extends('common.base'){{-- 継承元 --}}
@section('title','person'){{-- タイトル --}}
@section('heading','personリスト'){{-- 見出し --}}

@section('content')
<section class="maxWid mbPad addBtnBlock"> 
        <div class="addbtnWrap">

    <div class="addbtn">
        <a href="/person/add">新規追加</a>
    </div> 
</div>
</section>
    <section class="personList maxWid mbPad listSection">  



<div class="flexHead flexWrap6 flexWrap">
        <div class="no1">persons_name</div>
        <div class="no2">persons_platform_name</div>
        <div class="no3">persons_platform_url</div>
        <div class="no4">persons_platform_fee</div>
        <div class="no5">編集</div>
        <div class="no6">削除</div>
        </div>
<div class="flexBodyWrap ">  
    @foreach ($items as $item)

<form action="/person/edit" method="post" class="flexWrap flexWrap6 flexBody">
@csrf
<input type="hidden" class="d-none" name="post_type" value="edit">
<input type="hidden" class="d-none" name="persons_id" value="{{ $item->persons_id }}">
 <div class="no1"><input type="text" name="persons_name" id="persons_name" value="{{ $item->persons_name }}"></div>
 <div class="no2"><input type="text" name="persons_platform_name" id="persons_platform_name" value="{{ $item->persons_platform_name }}"></div>
 <div class="no3"> <input type="text" name="persons_platform_url" id="persons_platform_url" value="{{ $item->persons_platform_url }}"></div>
 <div class="no4"><input type="text" name="persons_platform_fee" id="persons_platform_fee" value="{{ $item->persons_platform_fee }}"></div>
 <div class="no5"><input class="submit editBtn" type="submit" value="edit" data-action="/person/edit"></div>
 <div class="no6"><input class="submit deleteBtn" type="submit" value="delete" data-action="/person/delete"></div>

    
</form>


    @endforeach
</div>

    </section>
            
<script>
//     $('.submit').click(function() {
//   $(this).parents('form').attr('action', $(this).data('action'));
//   $(this).parents('form').submit();
// });


$('.deleteBtn').click(function () {
  if (confirm('削除してもいいですか？')) {
    // 「OK」をクリックした際の処理を記述
  $(this).parents('form').attr('action', $(this).data('action'));
  $(this).parents('form').submit();
  } else {
    //キャンセルした場合
    //何も起きない
    return false
  }
});
</script>
@endsection
