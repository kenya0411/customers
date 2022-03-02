<aside class="common_padding">
    
@include('common.components.side_list')




<script>
    
    jQuery(function($){
 
  // ①マウスをボタンに乗せた際のイベントを設定
  $('.menu_side .menu_list').hover(function() {
 
    // ②乗せたボタンに連動したメガメニューをスライドで表示させる
    $(this).find('.menu_contents').stop().slideDown("fast");
    $(this).addClass('hover');
 
  // ③マウスをボタンから離した際のイベントを設定
  }, function() {
 
    // ④マウスを離したらメガメニューをスライドで非表示にする
    $(this).find('.menu_contents').stop().slideUp("fast");
    $(this).removeClass('hover');
 
  });
 
});
</script>




</aside>




