@can('admin')

<ul class="menu_side" id="menu">

   <li class="menu_list">
    <a href="#">注文管理</a>
    <div class="menu_contents">
      <ul>
        <li><a href="/orders">注文一覧</a></li>
        <li><a href="/reserves">鑑定予約一覧</a></li>
        <li><a href="/ships">発送予約一覧</a></li>
        <li><a href="/ships_test">発送予約[test]</a></li>
        <li><a href="/orders/add">新規注文</a></li>
      </ul>
    </div>
  </li>
    <li class="menu_list">
    <a href="#">顧客管理</a>
    <div class="menu_contents">
      <ul>
        <li><a href="/customers">顧客リスト</a></li>
      </ul>
    </div>
  </li>
  <li class="menu_list">
    <a href="#">商品管理</a>
    <div class="menu_contents">
      <ul>
        <li><a href="/products">商品一覧</a></li>
        <li><a href="/products/add">商品追加</a></li>
        <li><a href="/products_options">オプション一覧</a></li>

        <li><a href="/products_options/add">オプション追加</a></li>
      </ul>
    </div>
  </li>
   <li class="menu_list">
    <a href="#">人材管理</a>
    <div class="menu_contents">
      <ul>
        <li><a href="/persons">人材一覧</a></li>
        <li><a href="/persons/add">新規人材</a></li>
      </ul>
    </div>
  </li>
   <li class="menu_list">
    <a href="#">LINE管理</a>
    <div class="menu_contents">
      <ul>
        <li><a href="/lines">LINEメッセージ</a></li>
        <li><a href="/lines/mails">メール設定</a></li>
        {{-- <li><a href="/persons/add">新規人材</a></li> --}}
      </ul>
    </div>
  </li>
 
   <li class="menu_list">
    <a href="#">設定</a>
    <div class="menu_contents">
      <ul>
        <li><a href="/setting/users">ユーザー設定</a></li>
        {{-- <li><a href="/persons/add">新規人材</a></li> --}}
      </ul>
    </div>
  </li>

 <li class="btnWrap">
    <a href="/orders/add">新規注文</a>
   
  </li>
 
</ul>

@elsecan('fortune')


<ul class="menu_side" id="menu">

   <li class="menu_list">
    <a href="/orders">注文管理</a>
  </li>
   <li class="menu_list">
    <a href="/reserves">鑑定予約</a>
  </li>
 
</ul>
@elsecan('comment')


<ul class="menu_side" >

   <li class="menu_list">
    <a href="/orders">注文管理</a>
  </li>

</ul>

@endcan