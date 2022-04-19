<!DOCTYPE html>
<html lang="jp">
<head>
  <meta name="description" content="" />
  <meta name="Keywords" content="" />

@include('common.header')

  <title>@yield('title')</title>

</head>

<body class="frontPage">
  <!-- ローディング画面 -->

@include('common.nav')

  
@include('common.side')

  <main>
    <section class="mainHeading common_padding" >
        <h2>@yield('heading')</h2>
    </section>
    <section class="main_content common_padding" >
<div id="loading" v-bind:class=' {close:is_loaded}'>
  <img src="/img/common/loading.gif" >

  {{-- <div class="spinner"></div> --}}
</div>
    @yield('content')
    </section>
    
    </main>


@yield('vue')
{{-- <script src="/js/vue/common.js"></script> --}}


@include('common.footer')

</script>
  </body>
  </html>