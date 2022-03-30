<template>
  <div>
    <ul>
      <li v-for="user in users">{{ user.orders_id}}: {{ user.id }}
                  {{ user }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
 name: 'User',
  data() {
    return {
      users: [1,2,3],
      current_page:1,
    };
  },
  methods: {
    async getUsers() {
      var url = '/vue/ajax'
      axios.get(url)
      .then(response => [
        //商品データや顧客データを取得
        this.users = response.data.orders,
        this.persons = response.data.persons,
        console.log(this.users),
        console.log(this.persons),
        
        ])
      .catch(error => console.log(error))
  }
      // const result = await axios.get(`/vue?page=${this.current_page}`);

      // const users = result.data;
      // this.users = users.data;
    // }
  },
  watch:function() {
    this.getUsers();
  },

};
</script>