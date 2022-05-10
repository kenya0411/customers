

<div class="orderList listSection" > 
@include('orders.components.parts.modal_fortune')



	<ul>
		<li class="flexHead flexWrap">
			<div class="pcBlock">
				

				<div >商品ID</div>
				<div >顧客情報</div>
				<div>商品情報</div>
				<div>金額</div>
				<div>鑑定・発送</div>
				<div>外注</div>
				<div>日付</div>
				<div></div>
			</div>


			<div class="mbBlock">
				<div >顧客情報</div>
				<div>状況</div>
				<div>鑑定士</div>
				<div></div>
				

			</div>
		</li>

		<li class="flexBodyWrap flexWrap"	v-for="(order, index) in orders">
			
			<div class="mbBlock">
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
			</div>

			<div class="pcBlock">


				<div>
					<div class="hiddenName">商品ID</div>
					<a v-bind:href="persons[get_id[index].persons_id].persons_platform_url + order.orders_id "
					v-if="persons[get_id[index].persons_id]"
					target="_blank">
					<div class="icon_wrap">
						
						<span class="break_all">
							
							@{{order.orders_id }} 
						</span>
						<i class="fa-solid fa-arrow-up-right-from-square"></i>
					</div>
					
				</a>

			</div>
			<div >
				<div class="hiddenName">顧客情報</div>

				<a v-bind:href='`/customers/detail/?id=${order.customers_id}`'>
					
					<ul>
						<li >
							<span v-if="customers">
								@{{ customers[get_id[index].customers_id].customers_nickname }}
							</span>
							
						</li>
						<li >
							<span v-if="customers">
								@{{ customers[get_id[index].customers_id].customers_name }}
							</span>

							
							
						</li>
					</ul>
				</a>

			</div>
			<div>
				<div class="hiddenName">商品情報</div>

				<ul>
					{{-- <li v-if="order.persons_id !== 0"> --}}

						<span	v-if="persons[get_id[index].persons_id]">
							@{{ persons[get_id[index].persons_id].persons_name }}
							
						</span>
					</li>
					<li v-if="order.products_id !== 0">
						<span	v-if="products[get_id[index].products_id]">
							@{{ products[get_id[index].products_id].products_name }}

						</span>
					</li>
					<li v-if="order.products_options_id !== 0"> 
						<span	v-if="products_options[get_id[index].products_options_id]">

						@{{ products_options[get_id[index].products_options_id].products_options_name}}</li>
					</span>
				</ul>

				
			</div>
			<div>
				<div class="hiddenName">料金</div>

				@{{order.orders_price}}円

			</div>
			
			

			<div class="tabInvi">
				<span v-if="order.orders_is_reserve_finished == '1' && order.orders_is_ship_finished == '1'">完了</span>
				<span v-if="order.orders_is_reserve_finished == '1' && order.orders_is_ship_finished == '2'">完了</span>
				<span v-if="order.orders_is_reserve_finished == '1' && order.orders_is_ship_finished == '0'">鑑定済み</span>

				{{-- <span v-if="order.orders_is_ship_finished == '1'">発送済み</span> --}}
				{{-- <span v-if="order.orders_is_ship_finished == '2'">発送不要</span> --}}

			</div>
			<div>
				<div class="hiddenName">外注者</div>
				<span	v-if="order.users_id !== 0	&& users[get_id[index].users_id]">
					@{{ users[get_id[index].users_id].nickname }}様
				</span>

			</div>
			<div>
				<div class="hiddenName">購入日</div>
				<div class="break_all">
					
					@{{ moment(order.created_at ) }}
				</div>

			</div>


			
			<div>
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
				
			</div>


		</div>


	</li>

</ul>
</div>


