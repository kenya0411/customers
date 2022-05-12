let d = new Date();
let year = d.getFullYear();
// let month = d.getMonth() +1;

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
			fortunes_reply: '',
			search_persons: 0,//検索用
			search_orders_id: '',//検索用
			search_customers_name: '',//検索用
			search_fortunes_answer: '',//検索用
			search_year: year,//検索用
			search_month: 0,//検索用
			get_id: '',//検索用
			current_page:1,//ページネーション用
			last_page: "",//ページネーション用
			isActive: false,//モーダル用
			modal_fortunes: "",//モーダル用
			modal_answer_is: false,//モーダル用
			modal_reply_is: false,//モーダル用
			total_price: 0,//月の合計料金
			range: 0,
			first_range: 8,
			front_dot: false,
			is_loaded: false,
			end_dot: false,
			processing: false,
		}
	},
	methods: {	
		moment: function (date) {
			return moment(date).format("MM月DD日")
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
			/*--------------------------------------------------- */
			/* 月の合計料金を出力
			/*--------------------------------------------------- */
			get_total_price() {
				let url = '/orders/ajax_get_total_price';
				axios.post(url, {
					year: this.search_year,
					month: this.search_month,
				})
				.then(response => [
					this.total_price = response.data.total_price,
					
					])
				.catch(error => console.log(error))
			},
			/*--------------------------------------------------- */
			/* //モーダルウインドウ（鑑定用）
			/*--------------------------------------------------- */
			
			modal_open_answer(id) {
				this.isActive = true
				this.modal_answer_is = true
				let url = '/orders/ajax_modal_fortunes';
				axios.post(url, {
					id: id,
				})
				.then(response => [
					this.modal_fortunes = response.data.modal_fortunes,
					])
				.catch(error => console.log(error))
			},

			/*--------------------------------------------------- */
			/* //モーダルウインドウ（お礼用）
			/*--------------------------------------------------- */
			
			modal_open_reply(id) {
				this.modal_reply_is = true
				this.isActive = true
				let url = '/orders/ajax_modal_fortunes';
				axios.post(url, {
					id: id,
				})
				.then(response => [
					this.modal_fortunes = response.data.modal_fortunes,
					])
				.catch(error => console.log(error))
			},
			/*--------------------------------------------------- */
			/*モーダルを閉じる 
			/*--------------------------------------------------- */
			modal_close(){
				this.isActive = false;
				this.modal_fortunes = '';
				this.modal_answer_is = false
				this.modal_reply_is = false

			},
		/*--------------------------------------------------- */
		/* //ロード時に各種情報をデータベースから取得
		/*--------------------------------------------------- */
		
		async load_page() {
			let url = '/orders/ajax';
			axios.get(url)
			.then(response => [
				this.persons = response.data.persons,
				this.products = response.data.products,
				this.products_options = response.data.products_options,
				this.customers = response.data.customers,
				this.is_loaded = true,
				this.users = response.data.users,
				this.fortunes_reply = response.data.fortunes_reply,
				
				])
			.catch(error => console.log(error))

		},
		/*--------------------------------------------------- */
		/* //検索用の情報をデータベースから取得＋ページネーションの情報を取得
		/*--------------------------------------------------- */		
		async search_page() {
				this.processing = true;
			
			let url = '/orders/ajax_search';
			 await axios.post(url, {
				persons_id: this.search_persons,
				year: this.search_year,
				month: this.search_month,
				orders_id: this.search_orders_id,
				page: this.current_page,
				customers_name: this.search_customers_name,
				fortunes_answer: this.search_fortunes_answer,

			})
			.then(response => [
				all = response.data.orders,
				range = this.first_range,
				this.orders = response.data.orders.data,
				this.get_id = response.data.get_id,
				this.current_page = all.current_page,
				this.last_page = all.last_page,
				this.range = this.last_page - 2 < range ?  this.last_page - 5 : range,

				this.processing = false,
				
				

				])
			.catch(error => console.log(error))

		},
		/*--------------------------------------------------- */
		/* ページネーション用
		/*--------------------------------------------------- */
		calRange(start, end) {
			const range = [];
			for (let i = start; i <= end; i++) {
			range.push(i);
			}
			return range;
		},
		sizeCheck() {
			if (this.last_page <= this.range + 4) {
			return false;
			}
			return true;
		},
	},

	//ロード時にデータベースから情報を取得
	created:function(){
	this.search_page();
	this.load_page();
		this.get_total_price();

 },
 computed:{
	get_search_data() {//監視用データをまとめる
		return [
		this.search_persons,
		this.search_orders_id,
		this.search_year,
		this.search_month,
		this.search_customers_name,
		this.search_fortunes_answer,
		];
	},
	get_current_page_data() {//監視用データをまとめる
		return [
		this.current_page,
		];
	},
	frontPageRange() {
		if (!this.sizeCheck) {
		return this.calRange(1, 1);
		}
		return this.calRange(1, 1);

	},
	middlePageRange() {
		
		if (!this.sizeCheck) return [];
		let start = "";
		let end = "";
		if (this.current_page <= this.first_range && this.last_page <= this.first_range ) {
		start = 1;
		end = this.last_page;
		}
		else if (this.current_page <= this.range) {
		start = 1;
		end = this.range + 2;
		} else if (this.current_page > this.last_page - this.range) {
		start = this.last_page - this.range;
		end = this.last_page;
		} else if(this.range <= 0){
		start = 1;
		end = this.last_page;			
		}
		else {
		start = this.current_page - Math.floor(this.range / 2);
		end = this.current_page + Math.floor(this.range / 2);

		}
		return this.calRange(start, end);
	},
	endPageRange() {

		if (!this.sizeCheck) return [];

		return this.calRange(this.last_page, this.last_page);

	}

 },
watch: {
	get_search_data(val){//監視用
	this.current_page = 1;

	this.search_page();
	this.get_total_price();

	},
	get_current_page_data(val){//監視用
	this.search_page();


	},
 },

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();
