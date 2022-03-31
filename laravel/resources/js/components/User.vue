<template>
  <div>
    <ul class="pagination">
      <button
      v-for="page in last_page"  v-on:click="current_page = page">{{ page }}</button>

    </ul>
    <ul>
      <li v-for="user in users" :key="user.id">{{ user.id}}: {{ user.orders_id }}</li>
    </ul>
  </div>
</template>

<script>

export default {
  data() {
    return {
      users: [],
      current_page:1,
      last_page: "",
    };
  },
  methods: {
    async getUsers() {
      const result = await axios.get(`/vue/ajax?page=${this.current_page}`);
      const users = result.data;
      this.current_page = users.current_page;
      this.last_page = users.last_page;
      this.users = users.data;
      console.log(this.last_page)
      
    },

    // async test() {
    //   var url = '/vue/ajax'
    //   axios.get(url)
    //   .then(response => [
    //     //商品データや顧客データを取得
    //     this.users = response.data.orders,
    //     this.persons = response.data.persons,

    //     ])
    //   .catch(error => console.log(error))
    // }
  },

  created:function() {
    this.getUsers();

  },
  computed:{
         get_search_data() {//監視用データをまとめる
           return [
           this.current_page,
           ];
         },


       },
       watch: {
    get_search_data(){//監視用
      this.getUsers();

    },
  },
};
</script>


<style>
.pagination {
  display: flex;
  list-style-type: none;
}
.pagination li {
  border: 1px solid #ddd;
  padding: 6px 12px;
  text-align: center;
}
.active {
  background-color: #337ab;
  color:white;
}
.inactive{
  color: #337ab;
}
.pagination li + li {
  border-left: none;
}
</style>