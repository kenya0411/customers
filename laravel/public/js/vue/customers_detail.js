
    let params = (new URL(document.location)).searchParams//クエリ取得用
    let params_id =params.get('id')

  const hoge = {
    el: '.main_content',
    data () {
      return {
        customers: '',
        orders: '',
        products: '',
        is_loaded: false,

        }
      },
  methods: { 
    //日付のフォーマット
    moment: function (date) {
      return moment(date).format('YYYY年MM月DD日')
    },
    //ロード時に各種情報をデータベースから取得
    async load_page() {
      let url = '/customers/detail/ajax?id='+ params_id;
      axios.get(url)
      .then(response => [
        this.customers = response.data.customers[0],
        this.orders = response.data.orders,
        this.products = response.data.products,
        this.is_loaded = true,

        ])
      .catch(error => console.log(error))

    },    
    /*--------------------------------------------------- */
    /*　顧客情報の修正
    /*--------------------------------------------------- */
      submit_update(id) {
        let url = '/customers/detail/ajax_update';
        
       axios.post(url, {
        id: id,
        customers: this.customers,
      })
      .then(response => [
          location.reload(),
          
          
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
         get_products_data() {//監視用データをまとめる
           return [
           ];
         },


       },
       watch: {
    get_products_data(){//監視用


   },


 },

}

Vue.createApp(hoge).mount('.main_content')
mbSlideToggle();
deleteBtnConfirm();
