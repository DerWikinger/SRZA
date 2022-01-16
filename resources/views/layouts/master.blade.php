<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title> @yield('title', 'Home page') </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!--Icons-->
    <link href="/css/all.min.css" rel="stylesheet"> <!--load all styles -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix("css/app.css") }}">

</head>
<body>
    <div id="app">
        @include('layouts.header')
        @include('layouts.navbar')
        <section class="main">
            @yield('content')
        </section>
        @section('footerScripts')
        @show
    </div>
</body>
</html>
