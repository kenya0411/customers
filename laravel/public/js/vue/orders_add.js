
let params = (new URL(document.location)).searchParams//クエリ取得用
let params_id =params.get('id')

const hoge = {
	el: '.main_content',
	data () {
		return {
			persons: '', 
			products: '',
			products_options: '',
			customers: '',
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
			orders_notice: "",//v-model用
			orders_is_ship_finished: 0,//v-model用
			is_loaded: false,

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
		this.is_loaded = true,

		])
	.catch(error => console.log(error))

},
/*--------------------------------------------------- */
/*　商品情報の登録
/*--------------------------------------------------- */
submit_update() {
	let url = '/orders/add/ajax_add_update';
	if(!this.orders_id||!this.persons_id||!this.customers_name){
	alert('「鑑定士」「商品ID」「顧客名」のいずれかが未入力です。')
	}else{

		axios.post(url, {
			orders_id: this.orders_id,
			customers_id: this.customers_id,
			customers_name: this.customers_name,
			customers_nickname: this.customers_nickname,
			persons_id: this.persons_id,
			products_id: this.products_id,
			products_options_id: this.products_options_id,
			orders_price: this.orders_price,
			fortunes_worry: this.fortunes_worry,
			orders_notice: this.orders_notice,
			customers_address: this.customers_address,
			orders_is_ship_finished: this.orders_is_ship_finished,
		})
		.then(response => [
			// location.reload(),
			location.href = '/orders',

			])
		.catch(error => console.log(error)) 
	}


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
/*--------------------------------------------------- */
/* 顧客名を確認しリピーターかどうか調べる
/*--------------------------------------------------- */
async search_customers() {
	let url = '/orders/add/ajax_search_customers';
	console.log(this.customers_name)
	axios.post(url, {
		customers_name: this.customers_name,
		customers_nickname: this.customers_nickname,
	})
	.then(response => [
		this.customers = response.data.customers,
		
		])
	.catch(error => console.log(error))

},
/*--------------------------------------------------- */
/* リピーターの場合情報を取得
/*--------------------------------------------------- */
async get_data_repeater() {
	let url = '/orders/add/ajax_get_data_repeater';
	
	axios.post(url, {
		customers_id: this.customers_id,
	})
	.then(response => [
		customer = response.data.customers[0],
		this.customers_name = customer.customers_name,
		this.customers_nickname = customer.customers_nickname,
		this.customers_address = customer.customers_address,
		this.customers_name = customer.customers_name,
		this.customers_note = customer.customers_note,
		
		
		])
	.catch(error => console.log(error))

},
/*--------------------------------------------------- */
/* 鑑定士によって自動で発送不要にする
/*--------------------------------------------------- */
async ships_require_or_not() {
	let url = '/orders/add/ajax_get_data_repeater';
	
	if(this.persons_id ==2){
		this.orders_is_ship_finished = 2;
	}else{
		this.orders_is_ship_finished = 0;

	}
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
			//鑑定士の確認
			get_persons_data() {
				return [
				this.persons_id,
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
			get_persons_data(){//監視用

				this.ships_require_or_not();

			},


		},

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();
