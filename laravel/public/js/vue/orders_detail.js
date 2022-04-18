
		let params = (new URL(document.location)).searchParams//クエリ取得用
		let params_id =params.get('id')

	const hoge = {
		el: '.main_content',
		data () {
			return {
				persons: '', 
				products: '',
				products_options: '',
				orders: '',
				customers: '',
				users: '',
				fortunes: '',
				persons_selected: '',//選択した占い師
				temporary_price: '',//仮の金額
      persons_platform_fee: "",//v-model用
			persons_id: "",//v-model用

				}
			},
	methods: { 
		//日付のフォーマット
		moment: function (date) {
			return moment(date).format('YYYY/MM/DD')
		},
		//ロード時に各種情報をデータベースから取得
		async load_page() {
			let url = '/orders/detail/ajax?id='+ params_id;
			axios.get(url)
			.then(response => [
				this.persons = response.data.persons,
				this.persons_selected = response.data.persons_selected[0],//v-model用
				this.products = response.data.products,
				this.products_options = response.data.products_options,
				this.customers = response.data.customers[0],
				this.users = response.data.users,
				this.orders = response.data.orders[0],
				this.fortunes = response.data.fortunes[0],
        console.log(this.orders.persons_id)
        

				])
			.catch(error => console.log(error))

		},
		/*--------------------------------------------------- */
		/*　商品情報の修正
		/*--------------------------------------------------- */
			submit_update(id) {
				let url = '/orders/detail/ajax_update';
			 axios.post(url, {
				id: id,
				orders_id: this.orders.orders_id,
				customers_id: this.customers.customers_id,
				customers_name: this.customers.customers_name,
				customers_nickname: this.customers.customers_nickname,
				persons_id: this.orders.persons_id,
				products_id: this.orders.products_id,
				products_options_id: this.orders.products_options_id,
				orders_price: this.orders.orders_price,
				fortunes_worry: this.fortunes.fortunes_worry,
				fortunes_answer: this.fortunes.fortunes_answer,
				users_id: this.orders.users_id,
				orders_notice: this.orders.orders_notice,
				customers_address: this.customers.customers_address,
				orders_is_reserve_finished: this.orders.orders_is_reserve_finished,
				orders_is_ship_finished: this.orders.orders_is_ship_finished,
			})
			.then(response => [
			location.href = '/orders/detail/?id='+id,
					// location.reload(),
					
				])
			.catch(error => console.log(error)) 
 

			},
		/*--------------------------------------------------- */
		/*	//占い師や商品を変更時に自動で変更
		/*--------------------------------------------------- */
		async change_products(id,persons_id,products_id,products_options_id) {
			let url = '/orders/detail/ajax_change_products';
			
			 axios.post(url, {
				id: id,
				persons_id: persons_id,
				products_id: products_id,
				products_options_id: products_options_id,
			})
			.then(response => [
				this.products = response.data.products,
				this.products_options = response.data.products_options,
				this.orders.products_id = products_id,
				this.orders.products_options_id = products_options_id,

				])
			.catch(error => console.log(error))

		},
		/*--------------------------------------------------- */
		/* 金額を取得
		/*--------------------------------------------------- */
		 async get_temporary_price() {
			let url = '/orders/detail/ajax_get_temporary_price';
			
			 axios.post(url, {
				id: params_id,
				products_id: this.orders.products_id,
				products_options_id: this.orders.products_options_id,
			})
			.then(response => [
				this.temporary_price = response.data.temporary_price,
				])
			.catch(error => console.log(error))

		},
		/*--------------------------------------------------- */
		/* 仮の金額と手数料を計算
		/*--------------------------------------------------- */
		 async calculator_price() {
		 if(!confirm('金額を計算しますか？')){
					/* キャンセルの時の処理 */
					return false;
				}else{
			let commission_price = this.persons_selected.persons_platform_fee / 100;
			this.orders.orders_price = this.temporary_price - this.temporary_price * commission_price;
			}
			

		},			
		/*--------------------------------------------------- */
		/* 注文を削除
		/*--------------------------------------------------- */
		 async submit_delete(id) {
		 if(!confirm('注文情報を削除しますか？')){
					/* キャンセルの時の処理 */
					return false;
				}else{
			let url = '/orders/detail/ajax_delete';
			
			 axios.post(url, {
				id: id,
			})
			.then(response => [
			location.href = '/orders',		
				])
			.catch(error => console.log(error))			}
			

		},	
		async add_commission_price(persons_id) {
		let url = '/orders/add/ajax_add_commission_price';

		axios.post(url, {
		persons_id: persons_id,
		})
		.then(response => [
		this.persons_platform_fee = response.data.persons_platform_fee,
		])
		.catch(error => console.log(error))

		},
	},
	//ロード時にデータベースから情報を取得
	created:function(){
	 this.load_page();
   

 },
 computed:{
				 get_products_data() {//監視用データをまとめる
					 return [
					 this.orders.products_options_id,
					 this.orders.products_id,
					 ];
				 },
         get_persons_data() {//監視用データをまとめる
           return [
           this.orders.persons_id,
           ];

       },
			 },
			 watch: {
		get_products_data(){//監視用
	 this.get_temporary_price();


	 },

    get_persons_data(){//監視用
   this.add_commission_price(this.orders.persons_id);


   },
 },

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();
