
const hoge = {
  el: '.main_content',
  data () {
    return {
          customers: '',
          search_customers_id: '',//検索用
          current_page:1,
          last_page: "",
        }
      },
      methods: {

        // async load_page() {
        //   var url = '/customers/ajax?page='+this.current_page
        //   axios.get(url)
        //   .then(response => [
        //     all = response.data.customers,
        //     this.customers = response.data.customers.data,
        //     this.current_page = all.current_page,
        //     this.last_page = all.last_page,
        //     ])
        //   .catch(error => console.log(error))

        // },
        //検索用
        async search_page() {
         let url = '/customers/ajax_search/?customers_name=' + this.search_customers_id+'&page='+this.current_page;
         axios.get(url)
         .then(response => [
          all = response.data.customers,
          this.customers = response.data.customers.data,
          this.current_page = all.current_page,
          this.last_page = all.last_page,
          ])
         .catch(error => console.log(error))

       },
       moment: function (date) {
        return moment(date).format('YYYY/MM/DD')
      },
    },

  //ロード時にデータベースから情報を取得
  created:function(){
    this.search_page();

  },
  computed:{
         get_search_data() {//監視用データをまとめる
           return [
           this.current_page,//今のページネーション
           this.search_customers_id,
           ];
         },

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

