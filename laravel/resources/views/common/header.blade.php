
<?php 
//キャッシュ削除
 // header('Expires: Tue, 1 Jan 2019 00:00:00 GMT');
 // header('Last-Modified:' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');
 // header('Cache-Control:no-cache,no-store,must-revalidate,max-age=0');
 // header('Cache-Control:pre-check=0,post-check=0',false);
 // header('Pragma:no-cache');
//ここまで
 ?>
@php
$d = '?'.now();
// $d = '';
@endphp
                        
 <meta name="csrf-token" content="{{ csrf_token() }}">

<script src="/js/vue.js"></script>
<script src="/js/moment.min.js"></script>
{{-- <script src="https://unpkg.com/vue@next"></script> --}}
   {{-- <script src="https://unpkg.com/vue-router@4.0.5/dist/vue-router.global.js"></script> --}}

   
<script src="https://unpkg.com/vuejs-paginate@2.1.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vuejs-paginate/2.1.0/index.js"></script>
<script src="https://unpkg.com/laravel-vue-pagination@2.3.1/dist/laravel-vue-pagination.umd.min.js"></script>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta name="format-detection" content="telephone=no">
<!-- css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="/css/common/ress.css{{ $d }}">
<link rel="stylesheet" href="/css/common/base.css{{ $d }}">
<link rel="stylesheet" href="/css/common/header.css{{ $d }}">
<link rel="stylesheet" href="/css/common/footer.css{{ $d }}">
<link rel="stylesheet" href="/css/common/side.css{{ $d }}">
<link rel="stylesheet" href="/css/common/common.css{{ $d }}">

<!-- font -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/d5c3364311.js" crossorigin="anonymous"></script>

<link href="https://fonts.googleapis.com/css?family=Noto+Serif+JP:400,700&display=swap&subset=japanese" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">
<!-- js -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/common.js{{ $d }}"></script>
<script type="text/javascript" src="/js/useful.js{{ $d }}"></script>

<!-- osの条件別CSS -->
{{-- <script type="text/javascript" src="/common/js/css_browser_selector.js"></script> --}}
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" async=""></script> --}}
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

