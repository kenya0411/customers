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
      }
  },
  //ロード時にデータベースから情報を取得
  created:function(){
      var url = '/orders/ajax'
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
        this.persons = response.data.persons,
        this.products = response.data.products,
        this.products_options = response.data.products_options,
        this.orders = response.data.orders,
        this.users = response.data.users,
        this.customers = response.data.customers,
        ])
      .catch(error => console.log(error))
  },
  computed:{
         get_search_data() {//監視用データをまとめる
       return [
       this.search_persons,
       this.search_orders_id,
       this.search_year,
       this.search_month,
       ];
   },


},
watch: {
    get_search_data(val){//監視用
      let url = '/orders/ajax_search/?persons_id=' + this.search_persons+'&year='+this.search_year+'&month='+this.search_month+'&orders_id='+this.search_orders_id;
      axios.get(url)
      .then(response => [
        // this.persons = response.data.persons,
        this.orders = response.data.orders,
        
        ])
      .catch(error => console.log(error))

    },


},
  methods: {  // filtersじゃなくmethods
    moment: function (date) {
      return moment(date).format('YYYY/MM/DD')
    }
  }
}

Vue.createApp(hoge).mount('.main_content')
    mbSlideToggle();
    deleteBtnConfirm();

