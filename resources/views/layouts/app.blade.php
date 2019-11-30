<!doctype html>
<html lang="{{ str_replace('_', '-', config('app.locale')) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Vision') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @component('partials.navigation')
        @endcomponent
        @if (session('status'))
            <div class="alert alert-success m-0 py-3 px-lg-5" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <main>
            @yield('content')
        </main>
        <footer class="container py-4 text-center">
            <p>© {{ config('app.name') }} {{ date('Y') }} | <a href="{{ config('app.github') }}">GitHub</a></p>
        </footer>
    </div>
    <script src="//kit.fontawesome.com/{{ config('ui.font_awesome') }}.js" crossorigin="anonymous"></script>
</body>
</html>
