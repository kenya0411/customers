let d = new Date();
let year = d.getFullYear();
let month = d.getMonth() +1;

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
			search_persons: '',//検索用
			search_orders_id: '',//検索用
			search_customers_name: '',//検索用
			search_year: year,//検索用
			search_month: month,//検索用
			get_id: '',//検索用
			current_page:1,//ページネーション用
			last_page: "",//ページネーション用
			isActive: false,//モーダル用
			modal_fortunes: "",//モーダル用
			total_price: 0,//月の合計料金

		}
	},
	methods: {	
		moment: function (date) {
			return moment(date).format("MM月DD日")
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
			/* //モーダルウインドウ（名前チェック用）
			/*--------------------------------------------------- */
			
			modal_open(id) {
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
			modal_close(){
				this.isActive = false;
				this.modal_fortunes = '';

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
				this.users = response.data.users,
				])
			.catch(error => console.log(error))

		},
		/*--------------------------------------------------- */
		/* //検索用の情報をデータベースから取得＋ページネーションの情報を取得
		/*--------------------------------------------------- */		
		async search_page() {
			
			let url = '/orders/ajax_search/';
			// let url = '/orders/ajax_search/?persons_id=' + this.search_persons+'&year='+this.search_year+'&month='+this.search_month+'&orders_id='+this.search_orders_id+'&page='+this.current_page+'&customers_name='+this.search_customers_name;
			axios.post(url, {
				persons_id: this.search_persons,
				year: this.search_year,
				month: this.search_month,
				orders_id: this.search_orders_id,
				page: this.current_page,
				customers_name: this.search_customers_name,
				

			})
			.then(response => [
				all = response.data.orders,
				this.orders = response.data.orders.data,
				this.get_id = response.data.get_id,
				this.current_page = all.current_page,
				this.last_page = all.last_page,
				console.log('test')
				
				

				])
			.catch(error => console.log(error))

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
		this.current_page,
		];
	},


 },
watch: {
	get_search_data(val){//監視用
	// this.search_page();
	// this.get_total_price();
	console.log(this.search_year)
	
	},
 },

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();
