<template>
  <div>
    <ul>
      <!-- <li v-for="user in users">{{ user.orders_id}}: {{ user.id }} -->
      <!-- </li> -->
            <li v-for="user in users" :key="user.id">{{ user.id}}: {{ user.name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  el: '#user',

  data() {
    return {
      users: [1,2,3],
      current_page:1,
    };
  },
  methods: {
    async getUsers() {
      const result = await axios.get(`/vue?page=${this.current_page}`);

      const users = result.data;
      this.users = users.data;
    },
    async test() {
      var url = '/vue/ajax'
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
        this.users = response.data.orders,
        this.persons = response.data.persons,
        
        ])
      .catch(error => console.log(error))
    }
  },
  created:function() {
    this.getUsers();

  }
};
</script>