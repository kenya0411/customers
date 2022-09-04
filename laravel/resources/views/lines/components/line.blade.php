

<div class="orderList listSection" > 
{{-- @include('orders.components.parts.modal_fortune') --}}



	<ul>
		<li class="flexHead flexWrap">
			<div class="pcBlock">
				

				<div >ユーザーID</div>
				<div >顧客情報</div>
				<div>最新メッセージ</div>
				<div>最終返信日</div>
				<div></div>
			</div>


			<div class="mbBlock">
				<div >顧客情報</div>
				<div>状況</div>
				<div>鑑定士</div>
				<div></div>
				

			</div>
		</li>
		<li class="flexBodyWrap flexWrap" v-for="(line_list, index) in lines_list">
{{-- 			<div class="mbBlock">
				<ul class="no1">

					<li v-if="customers[get_id[index].customers_id]">@{{ customers[get_id[index].customers_id].customers_nickname }}</li>
					<li v-if="customers[get_id[index].customers_id]">@{{ customers[get_id[index].customers_id].customers_name }}</li>
				</ul>
				<div class="no2">
				<span v-if="order.orders_is_reserve_finished == '1' && order.orders_is_ship_finished == '1'">完了</span>
				<span v-if="order.orders_is_reserve_finished == '1' && order.orders_is_ship_finished == '2'">完了</span>
				<span v-if="order.orders_is_reserve_finished == '1' && order.orders_is_ship_finished == '0'">鑑定済み</span>
				</div>


				<div class="no2">
					<span  v-if="persons[get_id[index].persons_id]">
						
					@{{ persons[get_id[index].persons_id].persons_name }}
					</span>


				</div>
				<div class="no3">
					<i class="fa-solid fa-circle-chevron-down"></i>		
					<i class="fa-solid fa-circle-chevron-up"></i>		
					
				</div>
			</div> --}}

			<div class="pcBlock">


				<div>
					<div class="hiddenName">ユーザーID</div>
					<a v-bind:href='`/lines/messages/?userid=${line_list.lines_customers.lines_customers_userid}`'>
						
						<span class="break_all">
							@{{line_list.lines_customers.lines_customers_userid }} 
						</span>
					
				</a>

			</div>
		<div>
					<div class="hiddenName">顧客情報</div>
					<a v-bind:href='`/customers/detail/?id=${line_list.lines_customers.customers_id}`'>
						
						<span class="break_all">
							@{{line_list.lines_customers.lines_customers_name }}<br> 
							@{{line_list.customers.customers_name }} <br>
							@{{line_list.customers.customers_nickname }} 
						</span>
					
				</a>

			</div>

		<div>
					<div class="hiddenName">最新メッセージ</div>

						
						<span class="break_all">
							@{{line_list.lines_messages.lines_messages_text }}<br> 
						</span>
					

			</div>

{{-- 
			
			<div>
			<div class="pcInvi mb_list fortune_list">
				<div class="hiddenName">鑑定内容</div>
				<ul>
					<li>
						<div class="worry pointer" v-on:click="modal_open_answer(order.id)">
								鑑定結果
							</div>	 
					</li>
					<li>
							<div v-if="fortunes_reply[get_id[index].id]">
							<div class="reply pointer" v-on:click="modal_open_reply(order.id)">
								お礼
							</div>	 
						</div>						
					</li>
				</ul>
							

				
			</div>
				<div class="pcInvi">
					<div class="editBtn">
						<a v-bind:href='`/orders/detail/?id=${order.id}`'>編集ページ</a>
						
					</div>
					
				</div>
				<ul class="icon_list tabInvi">

						<li>
							<div class="worry pointer" v-on:click="modal_open_answer(order.id)">
								<img src="/img/common/icon/order_icon1.png" class="retina" alt="鑑定">
							</div>	 
						</li>
						<li v-if="fortunes_reply[get_id[index].id]">
							<div class="reply pointer" v-on:click="modal_open_reply(order.id)">
								<img src="/img/common/icon/order_icon4.png" class="retina" alt="お礼">
							</div>	 
						</li>
					<li>
						

						<a v-bind:href='`/orders/detail/?id=${order.id}`'>
							<img src="/img/common/icon/order_icon2.png" class="retina" alt="編集">
						</a>

					</li>
					
				</ul>
				
			</div> --}}


		</div>


	</li>

</ul>
</div>


