

<div class="searchBlock ">
{{--         <form action="/customers/search" method="get" >
  @csrf --}}
  {{-- <input type="hidden" name="search" value="search"> --}}

  <ul>
   
   @yield('search_content')

   

{{--    <li>
    
     <select name="search_persons_id" v-model="search_persons" id="">
      <option value="0" >選択してください</option>

      <option v-for="person in persons"  v-bind:value="person.persons_id" >@{{ person.persons_name }}</option>
      
      
    </select>
  </li> --}}

</ul>


</div>
