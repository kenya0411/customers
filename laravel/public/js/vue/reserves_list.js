	let d = new Date();
	let year = d.getFullYear();
	let month = d.getMonth() +1;

	const hoge = {
		el: '.main_content',
		data () {
			return {
				users: '',
				orders_list: [],
				isActive: false,//モーダル用
				name_check: '',//名前確認用
				is_loaded: false,

				}
			},
		methods: {	
			//時間のフォーマット用
			moment: function (date) {
				return moment(date).format('YYYY/MM/DD')
			},
			async load_page(){
				let url = '/reserves/ajax';
				
			axios.post(url, {
			})
			.then(response => [
					this.orders_list = response.data.orders_list,
					this.users = response.data.users,
					this.is_loaded = true,
				])
			.catch(error => console.log(error)) 
		},		
			//モーダルウインドウ（名前チェック用）
			modal_open(id) {
				this.isActive = true
				let url = '/reserves/ajax_name_check?id='+id;

				axios.get(url)
				.then(response => [
					this.name_check = response.data.html,
					console.log(response.data.html),
					
					
					])
				.catch(error => console.log(error))
			},
			modal_close(){
				this.isActive = false

			},

			//発送予約
			reserve_ship(id) {
				let url = '/reserves/ajax_reserve_ship';
				//発送の確認
				if(!confirm('鑑定完了しましたか？')){
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
			//クリップボードに保存
			copyToClipboard(id) {
				let url = '/reserves/ajax_clipboard_copy?id='+id;
				
				axios.get(url)
				.then(response => [
				navigator.clipboard.writeText(response.data.html)
					
					])
				.catch(error => console.log(error))
			},


			//データベースに上書き
		listUpdate(name,id,index) {
			
			let url = '/reserves/ajax_update/';
			
			axios.post(url, {
				id: id,
				fortunes_worry: this.orders_list[index].fortunes.fortunes_worry,
				fortunes_answer: this.orders_list[index].fortunes.fortunes_answer,
				orders_notice: this.orders_list[index].orders.orders_notice,
				users_id: this.orders_list[index].users.id,
				orders_is_ship_finished: this.orders_list[index].orders.orders_is_ship_finished,
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
 // 	computed:{
	// 	get_update_data() {//監視用データをまとめる
	// 		return [
	// 		this.orders,
	// 			];
	// 	},


	// },
	// watch: {
	// 	get_update_data(val){//監視用
	// this.test(this.orders);

	// 	},
	// },

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();

