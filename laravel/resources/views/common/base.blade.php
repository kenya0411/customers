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

  <main>
    <section class="mainHeading">
      <div class="maxWid mbPad">
        <h2>@yield('heading')</h2>
      </div>
    </section>
    @yield('content')
    </main>




@include('common.footer')

  </body>
  </html>