<div class="orderList listSection" > 
<ul>
    <li class="flexHead flexWrap">
<script>

import apps from '/js/app.vue'

</script>
<div class="pcBlock">
    

        <div >商品ID</div>
        <div >顧客情報</div>
        <div>商品情報</div>
        <div>金額</div>
        <div>鑑定・発送</div>
        <div>外注</div>
        <div>日付</div>
        <div></div>
        </div>


<div class="mbBlock">
        <div >顧客情報</div>
        <div>鑑定・発送</div>
    

     </div>
    </li>

    <li class="flexBodyWrap flexWrap" v-for="order in orders">
 
 <div class="mbBlock">
                   <ul class="no1">

                    <li>@{{ customers[order.customers_id - 1].customers_nickname }}</li>
                    {{-- <li>@{{ customers}}</li> --}}
                    {{-- <li>@{{customer.customers_name }}</li> --}}
                </ul>
                <div class="no2">
                    
              {{-- <span v-if="customer.customers_fortune_is_finished == 'true'">鑑定済み</span> --}}
{{-- <span v-if="customer.customers_ship_is_finished == 'true'">発送済み</span> --}}
                </div>
<div class="no3">
<i class="fa-solid fa-circle-chevron-down"></i>    
<i class="fa-solid fa-circle-chevron-up"></i>    
    
</div>
 </div>

 <div class="pcBlock">

            <div>
                <div class="hiddenName">商品ID</div>
                <a :href="persons[order.persons_id - 1].persons_platform_url + order.orders_id " target="_blank">
                    <div class="icon_wrap">
                        
                    <span>
                       @{{order.orders_id }} 
                    </span>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                
                </a>

</div>
            <div >
                <div class="hiddenName">顧客情報</div>

                <a :href="">
                    
                <ul>
                    <li v-if="order.customers_id !== 0">
                    @{{ customers[order.customers_id - 1].customers_nickname }}
                        
                    </li>
                    <li v-if="order.customers_id !== 0">
                    @{{ customers[order.customers_id - 1].customers_name }}
                        
                    </li>
                </a>

            </div>
            <div>
                <div class="hiddenName">商品情報</div>

                <ul>
                    <li v-if="order.persons_id !== 0">@{{ persons[order.persons_id - 1].persons_name }}</li>
                    <li v-if="order.products_id !== 0">@{{ products[order.products_id - 1].products_name }}</li>
                    <li v-if="order.products_options_id !== 0"> @{{ products_options[order.products_options_id - 1].products_options_name}}</li>
                   
                    {{-- <li>@{{ products_options[order.products_options_id - 1].products_options_name }}</li> --}}
                {{--     <li>@{{customer.persons_name}}</li>
                    <li>@{{customer.products_name}}</li>
                    <li>@{{customer.products_options_name}}</li> --}}
                </ul>

             
            </div>
            <div>
                <div class="hiddenName">料金</div>

                @{{order.orders_price}}円

            </div>
           
         

     <div class="tabInvi">
<span v-if="order.orders_is_reserve_finished == '1'">鑑定済み</span>
<span v-if="order.orders_is_ship_finished == '1'">発送済み</span>

</div>
            <div v-if="order.users_id !== 0">
                <div class="hiddenName">外注者</div>
@{{ users[order.users_id - 1].name }}様
        </div>
            <div >
                <div class="hiddenName">日付</div>
        @{{ order.updated_at }} 
        </div>


     
            <div>
                     <div class="pcInvi">
        <div class="editBtn">
                                        {{-- <a :href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'>商品情報</a> --}}
            
        </div>
         
     </div>
                <ul class="icon_list tabInvi">
                    <li>
                  <div class="worry">
                      <img src="/img/common/icon/order_icon1.png" class="retina" alt="鑑定">
                  </div>   
                    </li>
                    <li>
                                        {{-- <a :href='`/customers/detail/?id=${customer.id}&date_year=${customer.date_year}&date_month=${customer.date_month}`'><img src="/img/common/icon/order_icon2.png" class="retina" alt="編集"></a> --}}

                    </li>
                
                </ul>
 

            </div>


 </div>


        {{-- @endforeach --}}
{{-- <script src="{{ asset('js/components/customers_select_product_list.js') }}"></script> --}}

</li>
</ul>
</div>

<script>
</script>
<script>
// injectからdayjsを呼び出す
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
          search_year: '',//検索用
          search_month: '',//検索用
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
        console.log( this.persons)
        ])
      .catch(error => console.log(error))
  },
  computed:{
         get_search_data() {
       return [
       this.search_persons,
       this.search_orders_id,
       this.search_year,
       this.search_month,
       ];
   },


},
watch: {
    get_search_data(val){
      let url = '/orders/ajax_search/?persons_id=' + this.search_persons+'&year='+this.search_year+'&month='+this.search_month+'&orders_id='+this.search_orders_id;
      console.log(url)
      axios.get(url)
      .then(response => [
        // this.persons = response.data.persons,
        this.orders = response.data.orders,
        console.log(this.orders),
        
        ])
      .catch(error => console.log(error))

    },


}
}

Vue.createApp(hoge).mount('.main_content')
    mbSlideToggle();
    deleteBtnConfirm();

</script>

