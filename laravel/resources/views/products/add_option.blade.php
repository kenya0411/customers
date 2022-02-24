    
@extends('common.base'){{-- 継承元 --}}
@section('title','add'){{-- タイトル --}}

@section('heading','option登録画面'){{-- 見出し --}}

@section('content')
<section class="productFrom maxWid mbPad formSection"  id="app">   

    <form action="./add_option" method="post">
        @csrf

        <dl>
            <dt>date:</dt>
            <dd>      

                <select name="date_year" v-model="v_date_year" id="example">
                    @php
                    $d = now();
                    $year = $d->format('Y');
                    $year_add = $d->addYears(1)->format('Y');

                    @endphp
                    <option value="{{ $year }}" selected>{{ $year }}年</option>
                    <option value="{{ $year_add }}">{{ $year_add }}年</option>

                </select>
                <select name="date_month" v-model="v_date_month" id="example2">
                    @php
                    $month = $d->format('n');
                    $month_add = $d->addMonths(1)->format('n');
                    @endphp
                    <option value="{{ $month }}" selected>{{ $month }}月</option>
                    <option value="{{ $month_add }}">{{ $month_add }}月</option>

                </select>
            </dd>

            <dt>persons_name</dt>
            <dd>
                <select name="persons_id" v-model="v_persons" id="">

                    @foreach ($persons as $person)
                    <option value="{{ $person->persons_id}}">{{ $person->persons_name}}</option>
                    @endforeach
                </select>
            </dd>
            <dt>products_name</dt>
            <dd>


                <select name="products_number" v-model="v_products" id="">
                    {{-- <option value=""></option> --}}
      <option v-for="product in products"  v-bind:value="product.products_id" >@{{ product.products_name }}</option>
                    
                </select>
            </dd>

            <dt> products_options_name:</dt>
            <dd>            
                <input type="text" name="products_options_name" value="{{ old('products_options_name') }} " >
                @error('products_options_name')
                <div class="errorMessage">
                    {{ $message }}<br>

                </div>
                @enderror
            </dd>
            <dt> products_options_price:</dt>
            <dd>            
                <input type="number" name="products_options_price" inputmode="numeric" value="{{ old('products_price') }} " >
                @error('products_options_price')
                <div class="errorMessage">
                    {{ $message }}<br>
                </div>
                @enderror
            </dd>



            <dt> products_options_detail  :</dt>
            <dd>            
                <textarea name="products_options_detail" id="" cols="30" rows="10"></textarea>
                @error('products_options_detail')
                <div class="errorMessage">
                    {{ $message }}<br>
                </div>
                @enderror
            </dd>


        </dl>
        <div class="btnWrap">
            <input type="submit" class="sendBtn" value="登録する">
            
        </div>

    </form>



</section>



<script>
 const hoge = {
  el: '#app',
  data () {
    return {
      products: [],
      v_products: '',
      persons: [],
      v_persons: '',
      v_date_year: {{ $year }},
      v_date_month: {{ $month }},
    }
  },


    watch: {
v_date_year(val){
    this.v_date_year = val
    this.v_persons = ''

    this.products = ''

},
v_date_month(val){
    this.v_date_month = val
    this.v_persons = ''

    this.products = ''

},
v_persons(val){
      let url = '/products/add_option_ajax?persons_id=' + val+'&date_year='+this.v_date_year+'&date_month='+this.v_date_month;
if(val){
    axios.get(url)
      .then(response => [
        this.products = response.data,
        ])
      .catch(error => console.log(error))
}

},

  }

}


    Vue.createApp(hoge).mount('#app')



</script>

@endsection
