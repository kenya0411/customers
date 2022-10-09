@can('admin')
<footer>
    <div class="footerNavi">
        <ul>
            <li><a href="/orders/add"><i class="fa-solid fa-pen-to-square"></i></a></li>
            <li><a href="/orders"><i class="fa-solid fa-list"></i></a></li>
            <li><a href="/lines/"><i class="fa-brands fa-line"></i></a></li>
            <li><a href="/reserves"><i class="fa-solid fa-file-signature"></i></a></li>
            <li><a href="/ships"><i class="fa-solid fa-paper-plane"></i></a></li>
        </ul>
    </div>
</footer>
@endcan
<div id="footGoto">
    <div>  <a href="#"><span>TOP</span></a></div>
</div>

<!--object-sit（IE対策）-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.2.3/ofi.js"></script>
<script>objectFitImages();</script>

{{-- <script src="{{ mix('js/app.js') }}"></script> --}}

<script>
    $(function() {
    // naviMenu1();//ハンバーガーメニュー
    // retinaSrcset()//retina対応
    // anchorLinkToOtherPage()//アンカーリンクのスムーズスクロール（アンカーリンク）
    // smoothScroll()//スムーズスクロール
    // GoToTop();
    // fixedHeader()
});


</script>
