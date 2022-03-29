
<script src="/js/vue.js"></script>
{{-- <script src="https://unpkg.com/vuejs-paginate@2.1.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vuejs-paginate/2.1.0/index.js"></script>
<script src="https://unpkg.com/laravel-vue-pagination@2.3.1/dist/laravel-vue-pagination.umd.min.js"></script>
 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src=”https://unpkg.com/vuejs-paginate-next@latest/dist/vuejs-paginate-next.umd.js“></script>
<script src="https://unpkg.com/vuejs-paginate@latest"></script>

   <div id="counter">
        カウントアップ: @{{ counter }}
    </div>
<div id="test" >
    <example-component></example-component>
  </div>
      <script src="{{ mix('js/app.js') }}"></script>