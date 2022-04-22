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
