
<div class="reserveList listSection" >
@include('reserves.components.parts.modal_namecheck')


	<ul>


		<li class="flexBodyWrap flexWrap" v-for="(order, index) in orders_list">
			<div class="countHead" v-if="order.orders.users_id === {{ Auth::user()->id }}">	


				商品ID：@{{ order.orders.orders_id }}
			</div>
 				<div class="mbBlock" v-if="order.orders.users_id === {{ Auth::user()->id }}">

					 <div class="no1">
							 <ul>
									<li v-if="order.products.products_id !== 0">@{{ order.products.products_name }}</li>

							</ul>
					</div>
					<div class="no3">
						<i class="fa-solid fa-circle-chevron-down"></i>	 
						<i class="fa-solid fa-circle-chevron-up"></i>	 

				</div>
			</div> 

			<div class="pcBlock" v-if="order.orders.users_id === {{ Auth::user()->id }}">


								<div class="flex">
									<div class="flex5 no1">
										<div class="flexBlock">
											<span class="title">[商品ID]</span>

												<span>
													@{{ order.orders.orders_id }}
												</span>
											
									</div>
									<div class="flexBlock">
										<span class="title">[顧客情報]</span>
								<a v-bind:href='`/customers/detail/?id=${order.customers.customers_id}`' >

											<ul>
									
												<li >
													@{{ order.customers.customers_name }}

												</li>
											</ul>
										</a>
									</div>
									<div class="flexBlock">
										<span class="title">[商品情報]</span>
										<ul>
											<li> @{{ order.products.products_name }}</li>

										</ul>
									</div>
									<div class="flexBlock">
										<span class="title">[鑑定者]</span>
									@{{ order.users.nickname }}様
									</div>	

								</div>
								<div class="flex5 no2">
									<span class="title">[悩み]</span>
									    <div class="textBox pre-line">
									@{{ change_name (order.fortunes.fortunes_worry )}}
        
    </div>
									

								</div>
								<div class="flex5 no3">
									<span class="title"><strong>[鑑定結果]</strong></span>

									<textarea name="" id="" v-model="order.fortunes.fortunes_answer"
									v-on:keyup.enter.v.backspace="listUpdate('fortunes_answer',order.orders.id,index)" 
									v-on:change="listUpdate('fortunes_answer',order.orders.id,index)"
									v-on:mouseleave="listUpdate('fortunes_answer',order.orders.id,index)"></textarea>
								</div>
								<div class="flex5 no4">
						
								<div class="flexBlock">
									<span class="title">[備考]</span>
									<textarea class="orders_notice" readonly >
								</textarea>
							</div>
					

					</div> 

					<div class="flex5 no5">
						<div class="btnFlex">
				
							<div class="btnFlex4 number2">
								<div class="icon_wrap" v-on:click="modal_open(order.orders.id)">

									<i class="fa-solid fa-circle-check"></i>
								</div>
							</div>

								<div class="btnFlex4 number4">


										<button 
										v-on:click="submit_edit_finish('fortunes_answer',order.orders.id,index)"
										>鑑定結果の入力完了</button>
								
								</div>

							</div>

						</div>
					</div>




				</div>


			</li>

		</ul>
	</div>

