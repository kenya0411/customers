 <meta name="csrf-token" content="{{ csrf_token() }}">

<script src="/js/vue.js"></script>
{{-- <script src="https://unpkg.com/vuejs-paginate@2.1.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vuejs-paginate/2.1.0/index.js"></script>
<script src="https://unpkg.com/laravel-vue-pagination@2.3.1/dist/laravel-vue-pagination.umd.min.js"></script>
 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://unpkg.com/vuejs-paginate-next@latest/dist/vuejs-paginate-next.umd.js"></script>
<script src="https://unpkg.com/vuejs-paginate@latest"></script>

<template>
<paginate
:page-count="20"
:page-range="3"
:margin-pages="2"
:click-handler="clickCallback"
:prev-text="'Prev'"
:next-text="'Next'"
:container-class="'pagination'"
:page-class="'page-item'"
>
</paginate>
</template>
<script src="{{ mix('js/app.js') }}"></script>

<script>


export default {
  components: {
    VPagination
  }
}
</script>

