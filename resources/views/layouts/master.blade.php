<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix("/css/app.css") }}">
    <title> @yield('title', 'Home page') </title>
</head>
<body>
    @include('layouts.header')
    <section class="container">
        @yield('content')
    </section>
    @section('footerScripts')
        <script src="app.js"></script>
    @show
</body>
</html>
