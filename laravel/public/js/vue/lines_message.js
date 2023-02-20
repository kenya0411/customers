
let params = (new URL(document.location)).searchParams//クエリ取得用
let params_id =params.get('userid')//ユーザーID
let message_count =params.get('message_count')//ユーザーID


const hoge = {
	el: '.main_content',
	data () {
		return {
			lines_customers: '',
			lines_list: '',
			lines_information: '',
			lines_temporaries: '',
			lines_persons: '',
			persons: '',
			customers: '',
			users: '',
			search_customers_name: '',
			search_customers_data: '',
			// get_id: '',//検索用
			is_loaded: false,
		}
	},
	methods: {	
		moment: function (date) {
			let result = moment(date).format("MM/DD H:mm");
			return result
		},

		/*--------------------------------------------------- */
		/* スクロールを一番下にする
		/*--------------------------------------------------- */
		  scrollToElement() {
		  	//ロード直後だと取得できない場合があるので、時間差で取得
		  	//メッセージの一番下のセレクタを取得

	    this.$nextTick(function() {
			let element = document.getElementsByClassName('end_message')[0];
			element.scrollIntoView(false);  
    });

		  },
		/*--------------------------------------------------- */
		/* 鑑定士の名前を置換
		/*--------------------------------------------------- */
		change_name: function (text) {
			let textList = [/けいらん/g, /恵蘭/g,/慧蘭/g,/ケイラン/g,/れんれい/g,/レンレイ/g,/恋霊/g,/フェアリース/g,/零/g];
			let afterName = 'Rise' ;

			let textList2 = [/メルカリ/g, /めるかり/g,/ここなら/g,/ココナラ/g,/Twitter/g,/ツイッター/g];
			let afterName2 = 'アプリ' ;

			let textList3 = [/\(emoji\)/g];
			let afterName3 = '' ;

			let textList4 = [/shop.keiran-fortune.com/g,/shop.zero-fortune.com/g];
			let afterName4 = '' ;

			let result = text;
				if(!result){
				}else{
					textList.forEach(function(element){
						result = result.replace(element, afterName );
					});
					textList2.forEach(function(element){
						result = result.replace(element, afterName2 );
					});

					textList3.forEach(function(element){
						result = result.replace(element, afterName3 );
					});

					textList4.forEach(function(element){
						result = result.replace(element, afterName4 );
					});
			return result			
				}

		},
		/*--------------------------------------------------- */
		/*アラート
		/*--------------------------------------------------- */
		delete_confirm: function(e) {
		// delete_confirm: function(e) {
			if(!confirm('削除しますか？')){
		  	  e.preventDefault();
				return false;
			}

		},
		/*--------------------------------------------------- */
		/*アラート
		/*--------------------------------------------------- */
		send_confirm: function(e) {
		// delete_confirm: function(e) {
			if(!confirm('メッセージを送信しますか？')){
		  	  e.preventDefault();
				return false;
			}

		},
		/*--------------------------------------------------- */
		/* //ロード時に各種情報をデータベースから取得
		/*--------------------------------------------------- */
		
		async load_page() {
			let url = '/lines/ajax';
			axios.post(url, {
				userid: params_id,
				message_count: message_count,
			})
			.then(response => [
				this.lines_customers = response.data.lines_customers,
				this.lines_list = response.data.lines_list,
				this.lines_information = response.data.lines_information,
				this.users = response.data.users,
				this.persons = response.data.persons,
				this.lines_persons = response.data.lines_persons,
				this.lines_temporaries = response.data.lines_temporaries,
				this.is_loaded = true,
				])
			.catch(error => console.log(error)) 


		},
		/*--------------------------------------------------- */
		/* //検索用の情報をデータベースから取得＋ページネーションの情報を取得
		/*--------------------------------------------------- */		
		async search_customers_page() {
			
			let url = '/lines/ajax_customers_search';
			 await axios.post(url, {
				search_customers_name: this.search_customers_name,
				persons: this.persons,

			})
			.then(response => [
				this.search_customers_data = response.data,

				])
			.catch(error => console.log(error))

		},
	},

	//ロード時にデータベースから情報を取得
	created:function(){
	this.load_page();

 },
 
mounted() {
    window.onload = ()=>{
        	this.scrollToElement();
    }
},
computed:{
	get_search_data() {//監視用データをまとめる
		return [
		this.search_customers_name,
		];
	},
		load() {//監視用データをまとめる
		return [
		this.is_loaded,
		];
	},
},
watch: {
	get_search_data(val){//監視用
	
	this.search_customers_page();

	},
	load(val){//監視用
	
	this.scrollToElement();

	},
 },
}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
// deleteBtnConfirm();


