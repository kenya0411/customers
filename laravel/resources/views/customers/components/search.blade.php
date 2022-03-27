@extends('common.search'){{-- 継承元 --}}


@section('search_content')

<li class="me-3">
<div class="input-group">
<input type="text"  placeholder="顧客名" aria-label="顧客名" aria-describedby="input-group-left" name="search_text" v-model="search_customers_id">
<span class="input-group-text" id="input-group-left-example"><i class="fa-solid fa-magnifying-glass"></i></span>

</div>
</li>





@endsection