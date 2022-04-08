
<div class="productFrom formSection" >   
	<div class="inner">

		<form action="./add" method="post">
			@csrf

			<dl>


				<dt>鑑定士</dt>
				<dd>
					<select name="persons_id" v-model="search_persons" required 
					v-on:change="change_products(search_persons,0)">
						<option v-for="person in persons"  v-bind:value="person.persons_id" >@{{ person.persons_name }}</option>


					</select>
				</dd>
				<dt>商品名</dt>
				<dd>


					<select name="products_id" v-model="search_products" id="" required>
						{{-- <option value=""></option> --}}
						<option v-for="product in products"  v-bind:value="product.products_id" >@{{ product.products_name }}</option>

					</select>
				</dd>

				<dt> オプション名</dt>
				<dd>            
					<input type="text" name="products_options_name" value="{{ old('products_options_name') }} " required="required">
					@error('products_options_name')
					<div class="errorMessage">
						{{ $message }}<br>

					</div>
					@enderror
				</dd>
				<dt> オプション料金</dt>
				<dd>            
					<input type="number" name="products_options_price" inputmode="numeric" value="{{ old('products_price') }} " >
					@error('products_options_price')
					<div class="errorMessage">
						{{ $message }}<br>
					</div>
					@enderror
				</dd>



				<dt> オプション詳細</dt>
				<dd>            
					<textarea name="products_options_detail" id="" cols="30" rows="10"></textarea>
					@error('products_options_detail')
					<div class="errorMessage">
						{{ $message }}<br>
					</div>
					@enderror
				</dd>


			</dl>
			<div class="btnWrap">
				<input type="submit" class="sendBtn" value="登録する">

			</div>

		</form>

	</div>


</div>