@extends('common.search'){{-- 継承元 --}}


@section('search_content')



   <li>
    
     <select v-model="search_persons" id="" placeholder="商品ID" aria-label="商品ID">
      <option value="0" >鑑定士を選択してください</option>

      <option v-for="person in persons"  v-bind:value="person.persons_id" >@{{ person.persons_name }}</option>
      
      
    </select>
  </li>

@endsection