
const hoge = {
	el: '.main_content',
	data () {
		return {
			users_deleted: '',
			users: '',
			is_loaded: false,
		}
	},
	methods: {	
		moment: function (date) {

			let result = moment(date).format("MM月DD日");
			console.log(date)
			

			return result
		},

		/*--------------------------------------------------- */
		/*削除の確認
		/*--------------------------------------------------- */
		delete_confirm: function(e) {
		// delete_confirm: function(e) {
			if(!confirm('削除しますか？')){
		  	  e.preventDefault();
				return false;
			}

		},
		/*--------------------------------------------------- */
		/* //ロード時に各種情報をデータベースから取得
		/*--------------------------------------------------- */
		
		async load_page() {
			let url = '/setting/users/ajax';

			axios.post(url)
			.then(response => [
				this.users = response.data.users,
				this.users_deleted = response.data.users_deleted,
				this.permissions = response.data.permissions,
				this.is_loaded = true,
				])
			.catch(error => console.log(error)) 


		},


	},

	//ロード時にデータベースから情報を取得
	created:function(){
	this.load_page();

 },

}

Vue.createApp(hoge).mount('.main_content')
// mbSlideToggle();
// deleteBtnConfirm();
