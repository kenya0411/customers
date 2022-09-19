
let params = (new URL(document.location)).searchParams//クエリ取得用
let params_id =params.get('userid')//ユーザーID


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
			let result = moment(date).format("MM/DD H:mm");
			return result
		},

		/*--------------------------------------------------- */
		/* スクロールを一番下にする
		/*--------------------------------------------------- */
		  scrollToElement() {
		  	//メッセージの一番下のセレクタを取得
			let element = document.getElementsByClassName('end_message')[0];

			element.scrollIntoView(false);
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

	},

	//ロード時にデータベースから情報を取得
	created:function(){
	this.load_page();

 },
mounted() {
    window.onload = ()=>{
        	this.scrollToElement();

    }
}
}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
// deleteBtnConfirm();


