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
        fortunes: '',
        users: '',

        }
      },
    methods: {  
      //時間のフォーマット用
      moment: function (date) {
        return moment(date).format('YYYY/MM/DD')
      },
      //発送予約
      reserve_ship(id) {
        let url = '/reserves/ajax_reserve_ship?id='+id;
        //発送の確認
        if(!confirm('発送してもよろしいですか？')){
          /* キャンセルの時の処理 */
          return false;
        }else{
        axios.get(url)
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
      //ロード時にデータベースから情報を取得
      async load_page() {
        let url = '/reserves/ajax';
        axios.get(url)
        .then(response => [
          this.persons = response.data.persons,
          this.products = response.data.products,
          this.products_options = response.data.products_options,
          this.orders = response.data.orders,
          this.users = response.data.users,
          this.customers = response.data.customers,
          this.fortunes = response.data.fortunes,

          ])
        .catch(error => console.log(error))

      },

      //データベースに上書き
    listUpdate(name,id) {
      
      let url = '/reserves/ajax_update/';

      axios.post(url, {
        id: id,
        fortunes_worry: this.fortunes[id - 1].fortunes_worry,
        fortunes_answer: this.fortunes[id - 1].fortunes_answer,
        orders_notice: this.orders[id - 1].orders_notice,
        users_id: this.orders[id - 1].users_id,
        orders_is_ship_finished: this.orders[id - 1].orders_is_ship_finished,
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
         get_update_data() {//監視用データをまとめる
           return [
           this.fortunes,
           ];
         },


       },
       watch: {
    get_update_data(val){//監視用


    },



  },

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();

