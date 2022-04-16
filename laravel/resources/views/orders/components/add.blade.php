<div class="addFrom formSection ">	 
	<div class="inner">

		<dl>


			<dt>商品ID</dt>
			<dd>
				<input type="text" v-model="orders_id">
			</dd>
			<dt>名前</dt>
			<dd>

				<input type="text" v-model="customers_name">

			</dd>
			<dt>ニックネーム</dt>
			<dd>
				<input type="text" v-model="customers_nickname">

			</dd>
			<dt>リピーターか確認</dt>
			<dd>
				<select name="" id="" 
				v-model="customers_id"
				v-on:change="get_data_repeater()"
				>
				<option value="0">リピーターではありません。</option>
				<option v-bind:value="customer.customers_id" v-for="customer in customers"> @{{ customer.customers_nickname }} - @{{ customer.customers_name }}</option>

			</select>
			<div class="link_customer" v-if="customers_id !== 0">
                <a v-bind:href='`/customers/detail/?id=${customers_id}`' target="_blank">
顧客詳細ページへ→</a>
			</div>
			<a href=""></a>
			</dd>
			<dt>鑑定士</dt>
			<dd>
				<select name="" id="" v-model="persons_id"
				v-on:change="change_products(persons_id,0,0);add_commission_price(persons_id);">
				<option value="0">選択してください。</option>

				<option v-bind:value="person.persons_id" v-for="person in persons"> @{{ person.persons_name }}</option>

			</select>
		</dd>
		<dt>商品名</dt>
		<dd>
			<select	
			v-model="products_id"
			v-on:change="change_products(persons_id,products_id,0);">
			<option value="0"> 選択してください。</option>

			<option v-bind:value="product.products_id" v-for="product in products"> @{{ product.products_name }}</option>

		</select>

	</dd>
	<dt>オプション名</dt>
	<dd>
		<select	
		v-model="products_options_id">
		<option value="0"> 選択してください。</option>

		<option v-bind:value="product_option.products_options_id" v-for="product_option in products_options"> @{{ product_option.products_options_name }}</option>

	</select>

</dd>
<dt>料金</dt>
<dd class="price_dd">
	<div class="flex">
		<div class="flex4">
			<div class="title">[仮の金額]</div>
			<input type="number" inputmode="numeric" v-model="temporary_price" >
		</div>
		<div class="flex4">
			<div class="title">[手数料]</div>
			<input type="number" inputmode="numeric" v-model="persons_platform_fee" ><span>%</span>

		</div>
		<div class="flex4">
			<div class="calcBtn" v-on:click="calculator_price()">
				計算する
			</div>
		</div>
		<div class="flex4">
			<div class="title">[総計]</div>
			<input type="number" inputmode="numeric" v-model="orders_price" >

		</div>
	</div>
</dd>
<dt>発送の要否</dt>
<dd>
<select name="" id="" v-model="orders_is_ship_finished">
	<option value="0">必須</option>
	<option value="2">不要</option>

</select>
</dd>
<dt>住所</dt>
<dd>
	<textarea id=""  class="textarea2" autocomplete="off"
	v-model="customers_address"></textarea>


</dd>
<dt>悩み</dt>
<dd>
	<textarea name="" id="" class="textarea1" autocomplete="off"
	v-model="fortunes_worry"></textarea>
</dd>


</dd>

<dt>注文の備考</dt>
<dd>
	<textarea name="" id="" class="textarea2" autocomplete="off"
	v-model="orders_notice"></textarea>
</dd>


</dl>
<div class="btnWrap">
	<div class="sendBtn pointer" v-on:click="submit_update()">追加する</div>
</div>

</div>

</div>