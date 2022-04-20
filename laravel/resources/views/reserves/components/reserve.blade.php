
<div class="reserveList listSection" >
    <div class="modalWindow" v-bind:class=' {show:isActive}'>

        <div class="overlay" v-on:click.self="modal_close()">
          <div class="inner">
            <div class="title">
                ■名前確認用

            </div>
            <p>名前にミスがないかご確認ください。</p><div class="notice"><span>※</span>鑑定結果の中から「様」or「さま」の単語と、<br>その手前の文字を抽出しております。</div>			
            <ul class="show_area">
              <li v-for="val in name_check">@{{ val}}</li>

          </ul>
          <div class="closeBtn" v-on:click.self="modal_close()">閉じる</div>
      </div>
  </div>
</div>


<ul>
  <li class="flexHead flexWrap">
    {{-- <div class="pcBlock"> --}}


        {{-- <div >予約一覧</div> --}}

    {{-- </div> --}}
{{-- 

<div class="mbBlock">
				<div >顧客情報</div>
				<div>鑑定・発送</div>
		

          </div> --}}
      </li>

      <li class="flexBodyWrap flexWrap" v-for="(order, index) in orders">
          <div class="countHead">
            No.@{{ index + 1 }}
            @{{test(order.id,index)}}
        </div>
</li>
</ul>
</div>


