<aside class="common_padding">
    
<ul class="menu_side" id="menu">
 
  <li class="menu_list">
    <a href="/persons">人材管理</a>
  </li>
 
  <li class="menu_list">
    <a href="#">商品管理</a>
    <div class="menu_contents">
      <ul>
        <li><a href="/products">商品リスト</a></li>
        <li><a href="/products/add">新商品追加</a></li>
        <li><a href="/products/add_option">新オプション追加</a></li>
      </ul>
    </div>
  </li>
 
  <li class="menu_list">
    <a href="#">顧客管理</a>
    <div class="menu_contents">
      <ul>
        <li><a href="/customers">顧客リスト</a></li>
        <li><a href="/customers/reserve">予約リスト</a></li>
      </ul>
    </div>
  </li>
 <li class="menu_list">
    <a href="/customers/add">新規追加</a>
   
  </li>
 
</ul>
   










<script>
    
    jQuery(function($){
 
  // ①マウスをボタンに乗せた際のイベントを設定
  $('#menu li').hover(function() {
 
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




