    <ul class="pagination">
      <li
      v-for="page in last_page" v-on:click="current_page = page">@{{ page }}</li>

    </ul>