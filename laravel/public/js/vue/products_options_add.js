
    mbSlideToggle();
  
    const hoge = {
      el: '.main_content',
      data () {
        return {
          persons: '', 
          products: '',
          search_persons: '',//検索用
      }
  }, 
  methods: { 
    async change_products(persons_id) {
      let url = '/orders/detail/ajax_change_products';
      console.log('test')
      
      
       axios.post(url, {
        persons_id: persons_id,
      })
      .then(response => [
        this.products = response.data.products,

        ])
      .catch(error => console.log(error))

    },
  },
  //ロード時にデータベースから情報を取得
  created:function(){
      var url = '/products/ajax'
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
        this.persons = response.data.persons,
        this.products = response.data.products,
        ])
      .catch(error => console.log(error))
  },
  computed:{
         get_search_data() {
       return [
       this.search_persons,
       ];
   },


},
watch: {
    get_search_data(val){

    //   let url = '/products/ajax_search/?persons_id=' + this.search_persons;
    //   console.log(url)
    //   axios.get(url)
    //   .then(response => [
    //     // this.persons = response.data.persons,
    //     this.products = response.data.products,
    //     console.log(this.products),
        
    //     ])
    //   .catch(error => console.log(error))

    // },


}
}
}
Vue.createApp(hoge).mount('.main_content')