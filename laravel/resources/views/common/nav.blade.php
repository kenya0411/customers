

<header>
    <div class="flex maxWid mbPad">
        <div class="flex2 no1"> 
            <a href="/">   
                <h1>
                 ロゴ
             </h1>
         </a>
     </div>
        <div class="flex2 no2 navi"> 

            <div id="nav_toggle">
                <div>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <nav>
  <ul class="menu" id="menu">
 
  <!-- メニューボタン
   ここにマウスを乗せると下のコンテンツが表示される -->
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
</nav>
     </div>

</div>
</header>




<script>
    
    jQuery(function($){
 
  // ①マウスをボタンに乗せた際のイベントを設定
  $('#menu li').hover(function() {
 
    // ②乗せたボタンに連動したメガメニューをスライドで表示させる
    $(this).find('.menu_contents').stop().slideDown("fast");
 
  // ③マウスをボタンから離した際のイベントを設定
  }, function() {
 
    // ④マウスを離したらメガメニューをスライドで非表示にする
    $(this).find('.menu_contents').stop().slideUp("fast");
 
  });
 
});
</script>

