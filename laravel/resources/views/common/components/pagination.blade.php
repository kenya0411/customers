    <ul class="pagination">

       <li 
      v-on:click="current_page = frontPageRange[0]"
      v-if="current_page !== frontPageRange[0]">
      <i class="fa-solid fa-angles-left"></i>
      </li>

      <li v-for="page in middlePageRange"
      v-bind:class="[current_page == page ? 'is_active' : '']" 
      v-on:click="current_page = page"
      :disabled="processing">
      @{{ page }}
      </li>

      <li
      v-on:click="current_page = endPageRange[0]" 
      v-if="current_page !== endPageRange[0]">
      <i class="fa-solid fa-angles-right"></i>
      </li>
    </ul>