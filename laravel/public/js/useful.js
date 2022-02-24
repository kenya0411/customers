
  $(function(){
  
  
    $('.deleteBtn').click(function () {
      if (confirm('削除してもいいですか？')) {
    // 「OK」をクリックした際の処理を記述
    // $(this).parents('form').attr('action', $(this).data('action'));
    $(this).parents('form').submit();
} else {
    //キャンセルした場合
    //何も起きない
    return false
}
});
  });
