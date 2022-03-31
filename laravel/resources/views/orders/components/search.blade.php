@extends('common.search'){{-- 継承元 --}}


@section('search_content')

<li class="me-3">
<div class="input-group">
<input type="text"  placeholder="商品ID" aria-label="商品ID" aria-describedby="input-group-left" name="search_text" v-model="search_orders_id">
<span class="input-group-text" id="input-group-left-example"><i class="fa-solid fa-magnifying-glass"></i></span>

</div>
</li>

<li class=" me-3">


{{-- <select aria-label="Default select" name="date_year" v-model="search_year" id=""> --}}
<select aria-label="Default select" name="date_year" v-model="search_year"  id="">
<option value=""></option>

@php
$d = now();
$year = $d->format('Y');
@endphp
@for ($i = 2021; $i <= $year ; $i++)
@if($i == $year)
<option value="{{ $i}}" selected>{{ $i }}年</option>

@else
<option value="{{ $i}}">{{ $i }}年</option>

@endif
@endfor

</select>
</li>
<li class=" me-3">


<select  aria-label="Default select" name="date_month"  v-model="search_month"  id="">
<option value=""></option>

@for ($i = 1; $i <= 12; $i++)
$d = now();

@if($i == $d->format('m'))
<option value="{{ $i}}" selected>{{ $i }}月</option>

@else
<option value="{{ $i}}">{{ $i }}月</option>

@endif

@endfor
</select>
</li>

   <li>
    
     <select name="search_persons_id" v-model="search_persons" id="">
      <option value="0" >選択してください</option>

      <option v-for="person in persons"  v-bind:value="person.persons_id" >@{{ person.persons_name }}</option>
      
      
    </select>
  </li>

@endsection