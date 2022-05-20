	<div class="modalWindow" v-bind:class=' {show:isActive}'>
		
		<div class="overlay" v-on:click.self="modal_close()">
			<div class="inner">
				<div class="flex" v-if="modal_answer_is == true">
					<div class="flex2">
						<div class="title">
							■相談内容

						</div> 

						<div class="show_area pre-line">
							@{{ change_name(modal_fortunes.fortunes_worry) }}
						</div>
					</div>
					<div class="flex2">

						<div class="title">
							■鑑定結果

						</div> 

						<div class="show_area pre-line">
							@{{modal_fortunes.fortunes_answer}}

						</div>		 
					</div>
				</div>
				<div class="flex" v-if="modal_reply_is == true">
					<div class="flex2">
						<div class="title">
							■鑑定後のお礼

						</div> 

						<div class="show_area pre-line">
							@{{ change_name(modal_fortunes.fortunes_reply1) }}
						</div>
					</div>
						<div class="flex2" v-if="modal_fortunes.fortunes_reply_answer1">
						<div class="title">
							■お礼の返信

						</div> 

						<div class="show_area pre-line" >
							@{{ change_name(modal_fortunes.fortunes_reply_answer1) }}
						</div>
					</div>
	
				</div>



				<div class="closeBtn" v-on:click.self="modal_close()">閉じる</div>
			</div>
		</div>
	</div>
