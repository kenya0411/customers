
const hoge = {
	el: '.main_content',
	data () {
		return {
			persons: '',
			lines_persons: '',
			is_loaded: false,
		}
	},
	methods: {	


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
			let url = '/lines/persons/ajax';

			axios.post(url)
			.then(response => [
				this.lines_persons = response.data.lines_persons,
				this.persons = response.data.persons,
				this.is_loaded = true,
				])
			.catch(error => console.log(error)) 


		},


	},

	//ロード時にデータベースから情報を取得
	created:function(){
	// this.search_page();
	this.load_page();

 },



}

Vue.createApp(hoge).mount('.main_content')
// mbSlideToggle();
// deleteBtnConfirm();
