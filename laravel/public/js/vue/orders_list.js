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
        users: '',
          search_persons: '',//検索用
          search_orders_id: '',//検索用
          search_year: year,//検索用
          search_month: month,//検索用
          current_page:1,//ページネーション用
          last_page: "",//ページネーション用
        }
      },
  methods: {  // filtersじゃなくmethods
    moment: function (date) {
      return moment(date).format('YYYY/MM/DD')
    },
    //ロード時に各種情報をデータベースから取得
    async load_page() {
      let url = '/orders/ajax';
      axios.get(url)
      .then(response => [
        this.persons = response.data.persons,
        this.products = response.data.products,
        this.products_options = response.data.products_options,
        this.customers = response.data.customers,
        this.users = response.data.users,
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
   this.search_page();
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
