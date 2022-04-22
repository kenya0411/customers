    <ul class="pagination">
 {{--      <li
      v-for="page in last_page" 
      v-bind:class="[current_page == page ? 'is_active' : '']" 
      v-on:click="current_page = page">@{{ page }}</li>
 --}}

{{--        <li v-for="page in frontPageRange" 
       v-bind:class="[current_page == page ? 'is_active' : '']" 
      v-on:click="current_page = page">@{{ page }}</li>
<li v-show="front_dot" class="inactive disabled">...</li> --}}
      <li v-for="page in middlePageRange"
      v-bind:class="[current_page == page ? 'is_active' : '']" 
      v-on:click="current_page = page"
      :disabled="processing">@{{ page }}</li>
<li v-show="end_dot" class="inactive disabled">...</li>
      <li v-for="page in endPageRange" 
      v-bind:class="[current_page == page ? 'is_active' : '']" 
      v-on:click="current_page = page">@{{ page }}</li>
    </ul>