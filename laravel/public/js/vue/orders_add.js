
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
			persons_id: 0,//v-model用
			products_id: 0,//v-model用
			products_options_id: 0,//v-model用
			customers_id: 0,//v-model用
			persons_platform_fee: "",//v-model用
			orders_price: "",//v-model用
			customers_nickname: "",//v-model用
			customers_name: "",//v-model用
		}
},
methods: { 
//日付のフォーマット
moment: function (date) {
	return moment(date).format('YYYY/MM/DD')
},
//ロード時に各種情報をデータベースから取得
async load_page() {
	let url = '/orders/add/ajax';
	axios.get(url)
	.then(response => [
		this.persons = response.data.persons,
		this.products = response.data.products,
		this.products_options = response.data.products_options,
		this.users = response.data.users,

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
	})
	.then(response => [
		location.reload(),

		])
	.catch(error => console.log(error)) 


},
/*--------------------------------------------------- */
/*	//占い師や商品を変更時に自動で変更
/*--------------------------------------------------- */
async change_products(persons_id,products_id,products_options_id) {
	let url = '/orders/detail/ajax_change_products';
	
	axios.post(url, {
		persons_id: persons_id,
		products_id: products_id,
		products_options_id: products_options_id,
	})
	.then(response => [
		this.products = response.data.products,
		this.products_options = response.data.products_options,
		this.products_id = products_id,
		this.products_options_id = products_options_id,

		])
	.catch(error => console.log(error))

},
/*--------------------------------------------------- */
/* 金額を取得
/*--------------------------------------------------- */
async get_temporary_price() {
	let url = '/orders/detail/ajax_get_temporary_price';
	
	axios.post(url, {
		products_id: this.products_id,
		products_options_id: this.products_options_id,
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
		let commission_price = this.persons_platform_fee / 100;
		this.orders_price = this.temporary_price - this.temporary_price * commission_price;
	}
	

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
async search_customers() {
	let url = '/orders/add/ajax_search_customers';
	console.log(this.customers_name)
	
	axios.post(url, {
		customers_name: this.customers_name,
		customers_nickname: this.customers_nickname,
	})
	.then(response => [
		this.customers = response.data.customers,
		console.log('test')
		
		])
	.catch(error => console.log(error))

},


},
/*--------------------------------------------------- */
/* //ロード時にデータベースから情報を取得
/*--------------------------------------------------- */
created:function(){
this.load_page();

},
computed:{
		 get_products_data() {//監視用データをまとめる
		 	return [
		 		this.products_options_id,
		 		this.products_id,
		 	];
		 },
			//リピーターがいるか確認
			get_customers_data() {
				return [
				this.customers_name,
				this.customers_nickname,
				];
			},

		},
		watch: {
			get_products_data(){//監視用
				this.get_temporary_price();

			},
			get_customers_data(){//監視用

				this.search_customers();

			},


		},

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();
