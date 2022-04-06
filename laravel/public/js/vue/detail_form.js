
    let params = (new URL(document.location)).searchParams//クエリ取得用
console.log(params)

  const hoge = {
    el: '.main_content',
    data () {
      return {
        persons: '', 
        products: '',
        products_options: '',
        orders: '',
        customers: '',
        users: '',
        }
      },
  methods: {  // filtersじゃなくmethods
    moment: function (date) {
      return moment(date).format('YYYY/MM/DD')
    },
    //ロード時に各種情報をデータベースから取得
    async load_page() {
      let url = '/orders/detail/ajax?id='+ '1';
      axios.get(url)
      .then(response => [
        this.persons = response.data.persons,
        this.products = response.data.products,
        this.products_options = response.data.products_options,
        this.customers = response.data.customers,
        this.users = response.data.users,
        this.orders = response.data.orders,
        this.fortunes = response.data.fortunes,
        ])
      .catch(error => console.log(error))

    },
        //発送予約
      submit_update(id) {
        console.log(id)
        
        let url = '/orders/detail/ajax_update';
       axios.post(url, {
        id: id,
        orders_id: this.orders[0].orders_id,
        customers_name: this.customers[0].customers_name,
        customers_nickname: this.customers[0].customers_nickname,
        persons_id: this.orders[0].persons_id,
      })
      .then(response => [
        console.log(response.data.test),

          location.reload(),

        ])
      .catch(error => console.log(error)) 
 

      },
    //検索用の情報をデータベースから取得＋ページネーションの情報を取得
    async search_page() {
      let url = '/orders/ajax_search/?persons_id=' + this.search_persons+'&year='+this.search_year+'&month='+this.search_month+'&orders_id='+this.search_orders_id+'&page='+this.current_page;
      axios.get(url)
      .then(response => [
        all = response.data.orders,
        this.orders = response.data.orders.data,
        this.current_page = all.current_page,
        this.last_page = all.last_page,
        console.log(this.orders),

        ])
      .catch(error => console.log(error))

    },
  },
  //ロード時にデータベースから情報を取得
  created:function(){
   // this.search_page();
   this.load_page();

 },
 computed:{
         get_search_data() {//監視用データをまとめる
           return [
           this.search_persons,
           this.search_orders_id,
           this.search_year,
           this.search_month,
           this.current_page,
           ];
         },


       },
       watch: {
    get_search_data(val){//監視用
     this.search_page();


   },


 },

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();
