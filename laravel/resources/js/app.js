/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
// sss

// import VPagination from "@hennge/vue3-pagination";
// import "@hennge/vue3-pagination/dist/vue3-pagination.css";
// 
/*--------------------------------------------------- */
/* カウントダウン
/*--------------------------------------------------- */
import vueCounter from "./vueCounter";
import { createApp } from "vue";

// createApp({
//     setup() {

//         // カウンターを更新する
//         const { counter } = vueCounter();

//         return {
//             counter,
//         };
//     },
// }).mount("#counter");

/*--------------------------------------------------- */
/* test
/*--------------------------------------------------- */
// import ExampleComponent from './components/ExampleComponent.vue'

// createApp({
//     components:{
//         ExampleComponent
//     }
// }).mount('#test')


import User from './components/User.vue'


createApp({
    components:{
        User
    }
}).mount('#user')


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
//   const hige = {
//       el: 'main',
//       data () {
//         return {
//       }
//   },
//     methods: {  // filtersじゃなくmethods
//     moment: function (date) {
//       return moment(date).format('YYYY年MM日DD日')
//     }
//   }
// }

// Vue.createApp(hige).mount('main')