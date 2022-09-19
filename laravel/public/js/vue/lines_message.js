// let d = new Date();
// let year = d.getFullYear();
// let month = d.getMonth() +1;
let params = (new URL(document.location)).searchParams//クエリ取得用
let params_id =params.get('userid')

const hoge = {
	el: '.main_content',
	data () {
		return {
			lines_customers: '',
			lines_list: '',
			lines_information: '',
			lines_temporaries: '',
			userid: '',
			customers: '',
			users: '',
			// get_id: '',//検索用
			is_loaded: false,
		}
	},
	methods: {	
		moment: function (date) {

			let result = moment(date).format("MM月DD日");
			

			return result
		},

		/*--------------------------------------------------- */
		/* 鑑定士の名前を置換
		/*--------------------------------------------------- */
		change_name: function (text) {
			let textList = ['けいらん', '恵蘭', '慧蘭','ケイラン','れんれい','レンレイ','恋霊','フェアリース'];
			let afterName = 'Rise' ;
				let result = text;
				
				if(!result){
				console.log(text)


				}else{
					textList.forEach(function(element){
				result = result.replace(element, afterName );
		});
			return result			
				}

		},
			// /*--------------------------------------------------- */
			// /* 月の合計料金を出力
			// /*--------------------------------------------------- */
			// get_total_price() {
			// 	let url = '/orders/ajax_get_total_price';
			// 	axios.post(url, {
			// 		year: this.search_year,
			// 		month: this.search_month,
			// 	})
			// 	.then(response => [
			// 		this.total_price = response.data.total_price,
					
			// 		])
			// 	.catch(error => console.log(error))
			// },
			// /*--------------------------------------------------- */
			// /* //モーダルウインドウ（鑑定用）
			// /*--------------------------------------------------- */
			
			// modal_open_answer(id) {
			// 	this.isActive = true
			// 	this.modal_answer_is = true
			// 	let url = '/orders/ajax_modal_fortunes';
			// 	axios.post(url, {
			// 		id: id,
			// 	})
			// 	.then(response => [
			// 		this.modal_fortunes = response.data.modal_fortunes,
			// 		])
			// 	.catch(error => console.log(error))
			// },

			// /*--------------------------------------------------- */
			// /* //モーダルウインドウ（お礼用）
			// /*--------------------------------------------------- */
			
			// modal_open_reply(id) {
			// 	this.modal_reply_is = true
			// 	this.isActive = true
			// 	let url = '/orders/ajax_modal_fortunes';
			// 	axios.post(url, {
			// 		id: id,
			// 	})
			// 	.then(response => [
			// 		this.modal_fortunes = response.data.modal_fortunes,
					
			// 		])
			// 	.catch(error => console.log(error))
			// },
			// /*--------------------------------------------------- */
			// /*モーダルを閉じる 
			// /*--------------------------------------------------- */
			// modal_close(){
			// 	this.isActive = false;
			// 	this.modal_fortunes = '';
			// 	this.modal_answer_is = false
			// 	this.modal_reply_is = false

			// },
		/*--------------------------------------------------- */
		/* //ロード時に各種情報をデータベースから取得
		/*--------------------------------------------------- */
		
		async load_page() {
			let url = '/lines/ajax';

			axios.post(url, {
				userid: params_id,
			})
			.then(response => [
				this.lines_customers = response.data.lines_customers,
				this.lines_list = response.data.lines_list,
				this.lines_information = response.data.lines_information,
				this.users = response.data.users,
				this.lines_temporaries = response.data.lines_temporaries,
				this.is_loaded = true,
				])
			.catch(error => console.log(error)) 


		},
		/*--------------------------------------------------- */
		/* //検索用の情報をデータベースから取得＋ページネーションの情報を取得
		/*--------------------------------------------------- */		
		// async search_page() {
		// 		this.processing = true;
			
		// 	let url = '/orders/ajax_search';
		// 	 await axios.post(url, {
		// 		persons_id: this.search_persons,
		// 		year: this.search_year,
		// 		month: this.search_month,
		// 		orders_id: this.search_orders_id,
		// 		page: this.current_page,
		// 		customers_name: this.search_customers_name,
		// 		fortunes_answer: this.search_fortunes_answer,

		// 	})
		// 	.then(response => [
		// 		all = response.data.orders,
		// 		range = this.first_range,
		// 		this.orders = response.data.orders.data,
		// 		this.get_id = response.data.get_id,
		// 		this.current_page = all.current_page,
		// 		this.last_page = all.last_page,
		// 		this.range = this.last_page - 2 < range ?  this.last_page - 5 : range,

		// 		this.processing = false,
				
				

		// 		])
		// 	.catch(error => console.log(error))

		// },

	},

	//ロード時にデータベースから情報を取得
	created:function(){
	// this.search_page();
	this.load_page();

 },
 computed:{
	get_search_data() {//監視用データをまとめる
		return [
		// this.search_persons,
		// this.search_orders_id,
		// this.search_year,
		// this.search_month,
		// this.search_customers_name,
		// this.search_fortunes_answer,
		];
	},
	get_current_page_data() {//監視用データをまとめる
		return [
		// this.current_page,
		];
	},


 },
watch: {
	get_search_data(val){//監視用
	this.current_page = 1;

	// this.search_page();

	},
	get_current_page_data(val){//監視用
	// this.search_page();


	},
 },

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();
