
const hoge = {
	el: '.main_content',
	data () {
		return {
			customers: '',
			search_customers_id: '',//検索用
			current_page:1,
			last_page: "",
			range: 0,
			first_range: 8,
			is_loaded: false,
			processing: false,
				}
			},
			methods: {

				// async load_page() {
				//	 var url = '/customers/ajax?page='+this.current_page
				//	 axios.get(url)
				//	 .then(response => [
				//		 all = response.data.customers,
				//		 this.customers = response.data.customers.data,
				//		 this.current_page = all.current_page,
				//		 this.last_page = all.last_page,
				//		 ])
				//	 .catch(error => console.log(error))

				// },
				//検索用
				async search_page() {
				this.processing = true;

				 let url = '/customers/ajax_search/?customers_name=' + this.search_customers_id+'&page='+this.current_page;
				 axios.get(url)
				 .then(response => [
					all = response.data.customers,
				range = this.first_range,
					
					this.customers = response.data.customers.data,
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
			 moment: function (date) {
				return moment(date).format('YYYY/MM/DD')
			},
		},

	//ロード時にデータベースから情報を取得
	created:function(){
		this.search_page();
		this.is_loaded = true

	},
	computed:{
		 get_search_data() {//監視用データをまとめる
			 return [
			 this.current_page,//今のページネーション
			 this.search_customers_id,
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
		get_search_data(val){//監視用データの値が変更されたら発動
			this.search_page() 
		},

	},

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();

