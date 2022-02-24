var today = new Date();
var this_year = today.getFullYear();
var this_month = today.getMonth() + 1;

 const hoge = {
  el: '#app',
  data () {
    return {
      products: '',
      v_products: '',
      persons: '',
      v_persons: '',
      products_options: '',
      v_products_options:'',
      v_date_year: this_year,
      v_date_month: this_month,
    }
  },


    watch: {
v_date_year(val){
    this.v_date_year = val
    this.v_persons = ''
    this.products = ''
    this.products_options = ''

},
v_date_month(val){
    this.v_date_month = val
    this.v_persons = ''
    this.products = ''
    this.products_options = ''

},
v_persons(val){
        this.persons = val;
    this.products_options = ''

      let url = '/customers/ajax/add?persons_id=' + val+'&date_year='+this.v_date_year+'&date_month='+this.v_date_month;
      console.log('test')
if(val){
    axios.get(url)
      .then(response => [
        this.products = response.data,
        this.v_products = this.products[0]['products_id'],

        ])
      .catch(error => console.log(error))
}



},
v_products(val){
      let url = '/customers/ajax/add_option?persons_id=' + this.persons+'&date_year='+this.v_date_year+'&date_month='+this.v_date_month+'&products_id='+val;

if(val){
    axios.get(url)
      .then(response => [
        this.products_options = response.data,
        // this.v_products_options = this.products_options[0]['products_options_id'],
        this.v_products_options = '',

        ])
      .catch(error => console.log(error))
}
  }

}
}


    Vue.createApp(hoge).mount('#app')