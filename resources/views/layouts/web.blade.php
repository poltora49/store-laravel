<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="{{ asset('css/admin/modern.css') }}" rel="stylesheet">

    @stack('style')
</head>
<body>
    
    <header>
        @yield('header')
    </header>

    <main class="py-4">
        @yield('content')
    </main>

    @stack('scripts')
    <script src="{{ asset('js/admin/app.js') }}" type="text/javascript"></script>
</body>
</html>
