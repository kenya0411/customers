

function deleteBtnConfirm(){
      $(document).on('click','.deleteBtn',function(){

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
}

function mbSlideToggle(){

$(window).on('load',function(){
    $(document).on('click','.flexBodyWrap .mbBlock',function(){
    // $(".flexBodyWrap .mbBlock").on('click',function () {
  $(this).next('.pcBlock').slideToggle('fast');
  $(this).toggleClass('selected_mb');
  $(this).next('.pcBlock').toggleClass('selected_pc');
});
    });
}
