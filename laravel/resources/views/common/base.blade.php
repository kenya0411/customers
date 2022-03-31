<!DOCTYPE html>
<html lang="jp">
<head>
  <meta name="description" content="" />
  <meta name="Keywords" content="" />

@include('common.header')

  <title>@yield('title')</title>

</head>

<body class="frontPage">
@include('common.nav')

  
@include('common.side')

  <main>
    <section class="mainHeading common_padding" >
        <h2>@yield('heading')</h2>
    </section>
    <section class="main_content common_padding" >
    @yield('content')
    </section>
    
    </main>


@yield('vue')
{{-- <script src="/js/vue/common.js"></script> --}}


@include('common.footer')

  </body>
  </html>