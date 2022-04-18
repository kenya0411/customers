
const hoge = {
	el: '.main_content',
	data () {
		return {
			persons: '', 
			products: '',
			search_persons: '',//検索用
			current_page:1,//ページネーション用
			last_page: "",//ページネーション用
			range: 2,
			front_dot: false,
			end_dot: false,
	}
},
methods: {	// filtersじゃなくmethods
moment: function (date) {
	return moment(date).format('YYYY/MM/DD')
},
//ロード時に各種情報をデータベースから取得
async load_page() {
	let url = '/products/ajax';
	axios.get(url)
	.then(response => [
		this.persons = response.data.persons,
		// this.products = response.data.products,

		])
	.catch(error => console.log(error))

},
//検索用の情報をデータベースから取得＋ページネーションの情報を取得
async search_page() {
	let url = '/products/ajax_search/?persons_id=' + this.search_persons+'&page='+this.current_page;
	axios.get(url)
	.then(response => [
		all = response.data.products,
		this.products = all.data,
		this.current_page = all.current_page,
		this.last_page = all.last_page,

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
this.load_page();
this.search_page();


},
computed:{
	 get_search_data() {
		return [
		this.current_page,
	 	this.search_persons,
	 	];
	},
	middlePageRange() {
		if (!this.sizeCheck) return [];
		let start = "";
		let end = "";
		if (this.current_page <= this.range) {
		start = 1;
		end = this.range + 2;
		this.front_dot = false;
		this.end_dot = true;
		} else if (this.current_page > this.last_page - this.range) {
		start = this.last_page - this.range - 1;
		end = this.last_page - 2;
		this.front_dot = true;
		this.end_dot = false;
		} else {
		start = this.current_page - Math.floor(this.range / 2);
		end = this.current_page + Math.floor(this.range / 2);
		this.front_dot = true;
		this.end_dot = true;
		}
		return this.calRange(start, end);
	},
	endPageRange() {
		if (!this.sizeCheck) return [];

		return this.calRange(this.last_page - 1, this.last_page);
	}

},
watch: {
get_search_data(val){
	 this.search_page();
	 

},


}
}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();