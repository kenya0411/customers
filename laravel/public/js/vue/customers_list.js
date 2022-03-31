//   let d = new Date();
//   let year = d.getFullYear();
// let month = d.getMonth() +1;

const hoge = {
  el: '.main_content',
  data () {
    return {
          // persons: '', 
          customers: '',
          search_customers_id: '',//検索用
          current_page:1,
          last_page: "",
        }
      },
      methods: {
        async load_page() {
          var url = '/customers/ajax?page='+this.current_page
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
    this.load_page();

  },
  computed:{
         get_search_data() {//監視用データをまとめる
           return [
           this.search_customers_id,
           ];
         },
         get_current_page_data() {//ページネーション用
           return [
           this.current_page,
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
    get_current_page_data() {
      this.load_page();
      
    },

  },

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();

