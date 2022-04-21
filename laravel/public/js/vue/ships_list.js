	let d = new Date();
	let year = d.getFullYear();
	let month = d.getMonth() +1;

	const hoge = {
		el: '.main_content',
		data () {
			return {
				persons: '', 
				orders_list: [],
				search_persons: 0,
			is_loaded: false,

			}
		},
		methods: {	
			//時間のフォーマット用
			moment: function (date) {
				return moment(date).format('YYYY/MM/DD')
			},
			//発送完了
			ship_shipped(id) {
				let url = '/ships/ajax_ship_shipped';
				//発送の確認
				if(!confirm('発送完了しましたか？')){
					/* キャンセルの時の処理 */
					return false;
				}else{
					axios.post(url, {
						id: id,
					})
					.then(response => [
						location.reload(),
						])
					.catch(error => console.log(error))
				} 

			},
			//発送報告完了
			ship_finished(id) {
				let url = '/ships/ajax_ship_finished';
				axios.post(url, {
					id: id,
				})
				.then(response => [
					location.reload(),
					])
				.catch(error => console.log(error))

			},

			//ロード時にデータベースから情報を取得
			async load_page() {
				let url = '/ships/ajax';
				axios.get(url)
				.then(response => [
					this.orders_list = response.data.orders_list,
					this.persons = response.data.persons,
					this.is_loaded = true,
					console.log(this.orders_list )
					
					])
				.catch(error => console.log(error))

			},
			/*--------------------------------------------------- */
			/* //検索用の情報をデータベースから取得
			/*--------------------------------------------------- */		
			async search_page() {
				
				let url = '/ships/ajax_search/';
				if(this.search_persons !== 0){
					axios.post(url, {
					persons_id: this.search_persons,
				})
				.then(response => [
					// this.orders_id = response.data.orders_id,
					// this.orders = response.data.orders,
					this.orders_list = response.data.orders_list,

					])
				.catch(error => console.log(error))				
				}


			},
			//データベースに上書き
			listUpdate(id,index) {
				
				let url = '/ships/ajax_update/';
				
				axios.post(url, {
					id: id,
					ships_is_other_name: this.orders_list[index].ships.ships_is_other_name,
					ships_notice: this.orders_list[index].ships.ships_notice,
					ships_add_product1: this.orders_list[index].ships.ships_add_product1,
					ships_add_product2: this.orders_list[index].ships.ships_add_product2,
					ships_add_product3: this.orders_list[index].ships.ships_add_product3,
				})
				.then(response => [

					])
				.catch(error => console.log(error)) 
			}
		},

	//ロード時にデータベースから情報を取得
	created:function(){
		this.load_page();

	},
	computed:{
		// get_update_data() {//監視用データをまとめる
		// 	return [
		// 	this.fortunes,
		// ];
		// },
		get_search_persons() {//監視用データをまとめる
			return [
			this.search_persons,
		];
		},

	},
	watch: {
		get_search_persons(val){//監視用
		this.search_page();

	},



	},

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();

