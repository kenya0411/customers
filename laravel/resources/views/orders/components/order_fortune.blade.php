

<div class="orderList listSection" > 
@include('orders.components.parts.modal_fortune')


	<ul>
		<li class="flexHead flexWrap">
			<div class="pcBlock">


				<div >商品ID</div>
				<div >顧客情報</div>
				<div>商品情報</div>
				<div>担当者</div>
				<div></div>
			</div>


			<div class="mbBlock">
				<div >商品ID</div>
				<div>商品情報</div>
				<div>担当者</div>
				<div></div>


			</div>
		</li>

		<li class="flexBodyWrap flexWrap" v-for="(order, index) in orders">

			<div class="mbBlock">
				<div class="no1">
							@{{order.orders_id }} 

				</div>
				<div class="no2">

						<div v-if="order.products_id !== 0">
							<span	v-if="products[get_id[index].products_id]">
								@{{ products[get_id[index].products_id].products_name }}

							</span>
						</div>

				</div>


				<div class="no2">
				<div v-if="order.users_id === {{ Auth::user()->id }}">

				<span v-if="users[get_id[index].users_id]">
					@{{ users[get_id[index].users_id].nickname }}様
				</span>
				</div>
				</div>
				<div class="no3">
					<i class="fa-solid fa-circle-chevron-down"></i>		
					<i class="fa-solid fa-circle-chevron-up"></i>		

				</div>
			</div>

			<div class="pcBlock">


				<div>
					<div class="hiddenName">商品ID</div>

					<div class="icon_wrap">

						<span class="break_all">
							@{{order.orders_id }} 
						</span>
					</div>


				</div>
				<div >
					<div class="hiddenName">顧客情報</div>

					<a v-bind:href='`/customers/detail/?id=${order.customers_id}`'>

						<ul>
							<li >
								詳細



							</li>
						</ul>
					</a>

				</div>
				<div>
					<div class="hiddenName">商品情報</div>

					<ul>

						<li v-if="order.products_id !== 0">
							<span	v-if="products[get_id[index].products_id]">
								@{{ products[get_id[index].products_id].products_name }}

							</span>
						</li>

					</ul>


				</div>




<div>
				<div v-if="order.users_id === {{ Auth::user()->id }}">
					<div class="hiddenName">外注者</div>
		
					<span v-if="users[get_id[index].users_id]">
						@{{ users[get_id[index].users_id].nickname }}様
					</span>
</div>
				</div>
				<div>
					<div class="hiddenName">日付</div>
					<div class="break_all">

						@{{ moment(order.created_at ) }}
					</div>

				</div>
<div></div>


				<div>
					<div class="pcInvi">
						<div class="editBtn">
							<a v-bind:href='`/orders/detail/?id=${order.id}`'>詳細ページ</a>

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


