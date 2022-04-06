
@extends('common.base'){{-- 継承元 --}}
@section('title','注文編集'){{-- タイトル --}}
@section('heading','注文編集'){{-- 見出し --}}


@section('content')
<div class="backBlock">
    
<div class="backBtn">
    <a href="../">戻る</a>
</div>
</div>



@include('orders.components.detail')


@endsection

@section('vue')
<script src="/js/vue/detail_form.js"></script>

@endsection



<script>


//     let params = (new URL(document.location)).searchParams//クエリ取得用
//     const hoge = {
//       el: '#app',
//       data () {
//         return {
//           persons: '', 
//           id: params.get('id'),
//           products: '',
//           products_options: '',
//           users: '',
//           customers: '',
//       }
//   },
//   //ロード時にデータベースから情報を取得
//   created:function(){
//       var url = '/customers/detail/ajax?id='+this.id
//       axios.get(url)
//       .then(response => [
//         //商品データや顧客データを取得
//         this.customers = response.data.customers[0],
//         this.persons = response.data.persons,
//         this.products = response.data.products,
//         this.products_options = response.data.products_options,
//         this.users = response.data.users,

//         ])
//       .catch(error => console.log(error))



//   },
//   computed:{
//          get_database() {
//         //監視するデータを選択
//        return [
//        this.customers.date_month,
//        this.customers.date_year,
//        this.customers.persons_id,
//        this.customers.products_id,
//        ];
//    },

// },

// watch: {
//     //監視データに変更がある度にデータベースから情報を出力
//     get_database(val){
//       let url = '/customers/detail/ajax_change?persons_id=' + this.customers.persons_id+'&date_year='+this.customers.date_year+'&date_month='+this.customers.date_month+'&products_id='+this.customers.products_id;
//       axios.get(url)
//       .then(response => [
//         this.products = response.data.products,
//         this.products_options = response.data.products_options,
//         console.log(this.products_options)
        
//         ])
//       .catch(error => console.log(error))

//     },


// }
// }

// Vue.createApp(hoge).mount('#app')

</script>
{{-- <script src="{{ asset('js/components/customers_select_product_add.js') }}"></script> --}}

