
// 現在のURLからクエリパラメータを取得
let params = (new URL(document.location)).searchParams;

// 'userid'クエリパラメータを取得
let params_id =params.get('userid');

// 'message_count'クエリパラメータを取得
let message_count =params.get('message_count');
let rule="・メッセージに対する返信文を作成してください。\n・相手とはメッセージでのやりとりです。\n・丁寧な文章で作成してください。\n・ですます調の丁寧語で作成してください。\n・冒頭は「ご連絡ありがとうございます」から始めてください。\n・文字数は300文字以内で作成してください。"

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
			users_list: '',
			search_customers_name: '',
			search_customers_data: '',
			// get_id: '',//検索用
			is_loaded: false,
			lines_information_reply:[],//チェックボックス用
			send_direct:false,//直接送信できるかどうかの条件分岐
			gpt:{
				name:"",
				worry:"",
				fortune:"",
				rule:rule,
				message:"",
				result:"",
			},
			editedMessage: '',
            selectedFortune: null, // 選択されたfortuneのIDを保持します
            fortunes: [] // APIから取得したfortunesデータを保持します

		}
	},
	methods: {	
		 // 日付を特定の形式に変換するメソッド
		moment: function (date) {
			let result = moment(date).format("MM/DD H:mm");
			return result
		},
		/*--------------------------------------------------- */
		/* 直接返信用のブロックの条件分岐
		/*--------------------------------------------------- */
		send_direct_check: function(user_id,reply_available_id) {
			//bladeに直接記載してます。
			//load直後に発動させても取得できない場合があるので
			if(reply_available_id){
				for (let i = 0 ; i < reply_available_id.length ; i++){
					if(user_id == reply_available_id[i]){
						this.send_direct = true
					}
				}
			}
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
			let textList = [/けいらん/g, /恵蘭/g,/慧蘭/g,/ケイラン/g,/れんれい/g,/レンレイ/g,/恋霊/g,/フェアリース/g,/零/g,/ぜろさん/g];
			let afterName = 'Rise' ;

			let textList2 = [/メルカリ/g, /めるかり/g,/ここなら/g,/ココナラ/g,/Twitter/g,/ツイッター/g];
			let afterName2 = 'アプリ' ;

			let textList3 = [/\(emoji\)/g];
			let afterName3 = '' ;

			let textList4 = [/keiran-fortune.com/g,/zero-fortune.com/g];
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
		/*アラート
		/*--------------------------------------------------- */
		send_confirm_direct: function(e) {
		// delete_confirm: function(e) {
			if(!confirm('メッセージを依頼せず、直接送信しますか？')){
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
				this.lines_information_reply = response.data.lines_information_reply,
				this.users = response.data.users,
				this.users_list = response.data.users_list,
				this.persons = response.data.persons,
				this.lines_persons = response.data.lines_persons,
				this.lines_temporaries = response.data.lines_temporaries,
				this.is_loaded = true,
				this.gpt.name = response.data.lines_information.lines_customers_name, // ここで名前を設定
				])
			.catch(error => console.log(error)) 


		},
		/*--------------------------------------------------- */
		/* // 鑑定結果を取得
		/*--------------------------------------------------- */		
		async fetch_fortune() {
			let url = '/lines/ajax/fetch_fortune_result';
					console.log(this.response.data)

			// if(this.lines_information.customers_id){

				axios.post(url, {
					customers_id: this.lines_information.customers_id,

				})
				.then(response => [
					this.fortunes = response.data,
					console.log(response.data)


				])
				.catch(error => console.log(error))
			// }

		},
		/*--------------------------------------------------- */
		/* // 返信を作成するメソッド
		/*--------------------------------------------------- */		
		async create_reply(gpt) {
			 window.alert('GPTで返信文を作成します。'); // メソッドが呼び出されたときのアラート
			let url = '/lines/ajax/create_reply';
			 await axios.post(url, {
				gpt: this.gpt,

			})
			.then(response => [
				this.gpt.result = response.data,
			 window.alert('返信文生成しました'),// メソッドが呼び出されたときのアラート
				

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
	// this.load_page();
    this.load_page().then(() => {
        this.gpt.name = this.lines_information.lines_customers_name;//名前を取得

    });
 },
 
mounted() {
    window.onload = ()=>{
        this.scrollToElement();
        // this.fetch_fortune();//鑑定結果をフェッチ

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
    // 最後に送信されたメッセージのタイムスタンプを取得する算出プロパティ
    lastSentMessageTimestamp() {
        // メッセージリストを逆順にループ
        for (let i = this.lines_list.length - 1; i >= 0; i--) {
            // 現在のメッセージが送信者からのものであれば、そのメッセージの作成日時を返す
            if (this.lines_list[i].lines_messages.lines_customers_userid !== this.lines_list[i].lines_messages.lines_messages_from_userid) {
                return this.lines_list[i].lines_messages.created_at;
            }
        }
        // 送信者からのメッセージがなければnullを返す
        return null;
    },
    // 最後に送信されたメッセージ以降に受信したメッセージを取得する算出プロパティ
    receivedMessagesAfterLastSent() {
        // 最後に送信されたメッセージがなければ空の配列を返す
        if (this.lastSentMessageTimestamp === null) {
            return [];
        }
        // メッセージリストをフィルタリングして、受信者からのメッセージで、かつ最後に送信されたメッセージ以降のものだけを返す
        return this.lines_list.filter(line_list =>
            line_list.lines_messages.lines_customers_userid === line_list.lines_messages.lines_messages_from_userid &&
            line_list.lines_messages.created_at > this.lastSentMessageTimestamp
        );
    },
},
watch: {
	get_search_data(val){//監視用
	
	this.search_customers_page();

	},
	load(val){//監視用
	
	this.scrollToElement();

	},
    // receivedMessagesAfterLastSentが変更されたときにgpt.messageを更新
    receivedMessagesAfterLastSent(newVal) {
        this.gpt.message = newVal.map(line_list => line_list.lines_messages.lines_messages_text).join('\n');
    },

         selectedFortune: function (newFortune) {
         	
            // 選択されたfortuneが変更された時にgptの値を更新
            this.gpt.worry = newFortune.fortunes_worry;
            this.gpt.fortune = newFortune.fortunes_answer;
        }
 },
}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
// deleteBtnConfirm();


