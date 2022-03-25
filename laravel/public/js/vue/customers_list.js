  let d = new Date();
  let year = d.getFullYear();
let month = d.getMonth() +1;

  const hoge = {
      el: '.main_content',
      data () {
        return {
          persons: '', 
          customers: '',
          search_customers_id: '',//検索用
      }
  },
  //ロード時にデータベースから情報を取得
  created:function(){
      var url = '/customers/ajax'
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
        this.persons = response.data.persons,
        this.customers = response.data.customers,
        ])
      .catch(error => console.log(error))
  },
  computed:{
         get_search_data() {//監視用データをまとめる
       return [
       this.search_customers_id,
       ];
   },


},
watch: {
    get_search_data(val){//監視用
      let url = '/customers/ajax_search/?customers_name=' + this.search_customers_id;
      axios.get(url)
      .then(response => [
        // this.persons = response.data.persons,
        this.customers = response.data.customers,
        
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

