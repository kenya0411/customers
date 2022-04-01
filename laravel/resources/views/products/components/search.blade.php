    @extends('common.search'){{-- 継承元 --}}


@section('search_content')
   <li>
    
     <select name="search_persons_id" v-model="search_persons" id="">
      <option value="0" >選択してください</option>

      <option v-for="person in persons"  v-bind:value="person.persons_id" >@{{ person.persons_name }}</option>
      
      
    </select>
  </li>
@endsection