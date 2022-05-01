
<div class="reserveList listSection" >

@include('reserves.components.parts.modal_namecheck')


	<ul>


		<li class="flexBodyWrap flexWrap" v-for="(order, index) in orders_list" v-if="orders_list.length">
			<div class="countHead">
				No.@{{ index + 1 }}
			</div>
 				<div class="mbBlock">
					 <ul class="no1">

							 <li>@{{ order.customers.customers_nickname }}</li>
							 <li>@{{order.customers.customers_name }}</li>
					 </ul>
					 <div class="no2">
							 <ul>
									<li v-if="order.persons.persons_id !== 0">@{{ order.persons.persons_name }}</li>
									<li v-if="order.products.products_id !== 0">@{{ order.products.products_name }}</li>
									<li v-if="order.products_options.products_options_id !== 0"> @{{ order.products_options.products_options_name}}</li>

							</ul>
					</div>
					<div class="no3">
						<i class="fa-solid fa-circle-chevron-down"></i>	 
						<i class="fa-solid fa-circle-chevron-up"></i>	 

				</div>
			</div> 

			<div class="pcBlock">


								<div class="flex">
									<div class="flex5 no1">
										<div class="flexBlock">
											<span class="title">[商品ID]</span>

											<a v-bind:href="order.persons.persons_platform_url +	order.orders.orders_id" 
											target="_blank">
											<div class="icon_wrap">

												<span>
													@{{ order.orders.orders_id }}

												</span>
												<i class="fa-solid fa-arrow-up-right-from-square"></i>
											</div>

										</a>
									</div>
									<div class="flexBlock">
										<span class="title">[顧客情報]</span>
								<a v-bind:href='`/customers/detail/?id=${order.customers.customers_id}`' >

											<ul>
												<li >
													@{{ order.customers.customers_nickname }}


												</li>
												<li >
													@{{ order.customers.customers_name }}

												</li>
											</ul>
										</a>
									</div>
									<div class="flexBlock">
										<span class="title">[商品情報]</span>
										<ul>
											<li> @{{ order.persons.persons_name }}</li>
											<li> @{{ order.products.products_name }}</li>
											<li> @{{ order.products_options.products_options_name }}</li>

										</ul>
									</div>
									<div class="flexBlock">
										<span class="title">[購入日]</span>
										@{{ moment(order.updated_at ) }}

									</div>

								</div>
								<div class="flex5 no2">
									<span class="title">[悩み]</span>

									<textarea id="" v-model="order.fortunes.fortunes_worry " 
									v-on:keyup.enter.v.backspace="listUpdate('fortunes_worry',order.orders.id,index)" 
									v-on:change="listUpdate('fortunes_worry',order.orders.id,index)"
									v-on:mouseleave="listUpdate('fortunes_worry',order.orders.id,index)"
									></textarea>

								</div>
								<div class="flex5 no3">
									<span class="title">[鑑定結果]</span>

									<textarea name="" id="" v-model="order.fortunes.fortunes_answer" 
									v-on:keyup.enter.v.backspace="listUpdate('fortunes_answer',order.orders.id,index)" 
									v-on:change="listUpdate('fortunes_answer',order.orders.id,index)"
									v-on:mouseleave="listUpdate('fortunes_answer',order.orders.id,index)"
									></textarea>
								</div>
								<div class="flex5 no4">
									<div class="flexBlock">
										<span class="title">[外注]</span>
										<select name="users_id" id="" 
										v-model="order.users.id"
										v-on:change="listUpdate('users_id',order.orders.id,index)">
										<option value="0" >選択してください</option>

										<option v-for="user in users" v-bind:value="user.id">@{{ user.nickname }}</option>
									</select>
								</div>
								<div class="flexBlock">
									<span class="title">[備考]</span>
									<textarea class="orders_notice" id="" v-model="order.orders.orders_notice" 
									v-on:keyup.enter.v.backspace="listUpdate('orders_notice',order.orders.id,index)" 
									v-on:change="listUpdate('orders_notice',order.orders.id,index)"
									v-on:mouseleave="listUpdate('orders_notice',order.orders.id,index)"
									>
								</textarea>
							</div>
							<div class="flexBlock">
								<span class="title">[発送]</span>

								<select name="orders_is_ship_finished" id="" 
								v-model="order.orders.orders_is_ship_finished"
								v-on:change="listUpdate('orders_is_ship_finished',order.orders.id,index)"
								>
								<option value="0"></option>
								<option value="2">発送不要</option>
							</select>
						</div>

					</div> 

					<div class="flex5 no5">
						<div class="btnFlex">
							<div class="btnFlex4 number1">
								<div class="icon_wrap" v-on:click="copyToClipboard(order.orders.id)">
									<i class="fa-solid fa-clipboard"></i>
								</div>
							</div>
							<div class="btnFlex4 number2">
								<div class="icon_wrap" v-on:click="modal_open(order.orders.id)">

									<i class="fa-solid fa-circle-check"></i>
								</div>
							</div>

							<div class="btnFlex4 number3">
								<a	v-bind:href='`/orders/detail/?id=${order.orders.id}`' class="text_wrap">

									編集ページ<i class="fa-solid fa-pencil"></i></a>
								</div>
								<div class="btnFlex4 number4">
									<div v-if="order.orders.orders_is_ship_finished == '0'">


										<button 
										v-on:click="reserve_ship(order.orders.id)"
										>発送予約<i class="fa-solid fa-paper-plane"></i></button>
									</div>
									<div v-if="order.orders.orders_is_ship_finished == '2'">


										<button 
										v-on:click="reserve_ship(order.orders.id)"
										>鑑定完了(発送無し)</button>
									</div>

								</div>

							</div>

						</div>
					</div>




				</div>
			</li>

		<li v-else>
鑑定予約はありません。
</li>
		</ul>
	</div>


