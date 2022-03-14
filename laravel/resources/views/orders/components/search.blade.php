@extends('common.search'){{-- 継承元 --}}


@section('search_content')

<li class="me-3">
<div class="input-group">
<input type="text"  placeholder="商品ID" aria-label="商品ID" aria-describedby="input-group-left" name="search_text" v-model="search_orders_id">
<span class="input-group-text" id="input-group-left-example"><i class="fa-solid fa-magnifying-glass"></i></span>

</div>
</li>

<li class=" me-3">


<select aria-label="Default select" name="date_year" v-model="search_year" id="">
<option selected="">年</option>

@php
$d = now();
$year = $d->format('Y');
$year_add = $d->addYears(1)->format('Y');

@endphp
@for ($i = 2021; $i <= $year_add ; $i++)
<option value="{{ $i}}">{{ $i }}年</option>
@endfor

</select>
</li>
<li class=" me-3">


<select  aria-label="Default select" name="date_month" v-model="search_month" id="">
@for ($i = 1; $i <= 12; $i++)
<option value="{{ $i}}">{{ $i }}月</option>
@endfor
</select>
</li>



@endsection