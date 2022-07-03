<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title> @yield('title', __('caption.app-name')) </title>

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
    <div id="app" class="relative">
        @include('layouts.header')
        <section class="pt-4 h-4/6 overscroll-auto overflow-auto">
            @yield('content')
        </section>
        @include('layouts.footer')
        @section('footerScripts')
        @show
    </div>
</body>
</html>
