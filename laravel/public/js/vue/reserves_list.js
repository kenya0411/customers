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
    methods: {  // filtersじゃなくmethods
      moment: function (date) {
        return moment(date).format('YYYY/MM/DD')
      },
  
      copyToClipboard(text) {
        navigator.clipboard.writeText(text)
        .then(() => {
          console.log(text)
        })
        .catch(e => {
          console.error(e)
        })
      },
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


    listUpdate(name,id) {
      //データベースに上書き
      let url = '/reserves/ajax_update/';
      console.log(this.orders[id - 1].orders_notice)

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

