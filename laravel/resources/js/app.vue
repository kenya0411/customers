<template>
          <div v-for="index of userlists" :key="index">
              <h2>
                {{ index.last_name }} {{ index.first_name }}
              </h2>
              <div>
                {{ format(index.created_at) }}
              </div>
          </div>
</template>

<script>
import dayjs from "dayjs";
dayjs.locale("ja");

export default {
  props: {
    userlists: Array,
  },

  methods: {
    format(date) {
      let created_at = dayjs(date).format("YYYY--MM-DD");
      return created_at;
    },
  },
};
</script>