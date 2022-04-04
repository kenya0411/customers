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
          search_orders_id: '',//検索用
          fortunes_worry: '',//検索用
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

        async update_page() {
          // console.log(this.fortunes[0].fortunes_worry)
          console.log('test')
          
      // let url = '/reserves/ajax_update/?id=' + this.id+'&fortunes_worry='+this.fortunes_worry+'&fortunes_answer='+this.fortunes_answer;
      // axios.get(url)
      // .then(response => [
        // all = response.data.orders,
        // this.orders = response.data.orders.data,
 

        // ])
      // .catch(error => console.log(error))

    },
      listUpdate(name,id,val) {
    let url = '/reserves/ajax_update/?id=' + id+'&'+name+'='+val;
    console.log(url)
    
      axios.get(url)
      .then(response => [
        this.fortunes = response.data.fortunes,
        console.log( 'testaa'),
        console.log( response.data.test)
 

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
           this.update_page();


      // let url = '/orders/ajax_search/?persons_id=' + this.search_persons+'&year='+this.search_year+'&month='+this.search_month+'&orders_id='+this.search_orders_id;
      // axios.get(url)
      // .then(response => [
      //   // this.persons = response.data.persons,
      //   this.orders = response.data.orders,
        
      //   ])
      // .catch(error => console.log(error))

    },



},

}

Vue.createApp(hoge).mount('.main_content')
    mbSlideToggle();
    deleteBtnConfirm();

