    <ul class="pagination">
      <li
      v-for="page in last_page" v-bind:class="[current_page == page ? 'is_active' : '']" v-on:click="current_page = page">@{{ page }}</li>

    </ul>