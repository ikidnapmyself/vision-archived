<!doctype html>
<html lang="{{ str_replace('_', '-', config('app.locale')) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ config('app.name', 'Vision') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{ config('ui.mode') === 'dark' ? 'bg-secondary' : '' }}">
    <div id="app">
        <navbar-component></navbar-component>
        <main>
            @yield('content')
        </main>
        <footer class="container py-4 text-center">
            <p>© {{ config('app.name') }} {{ date('Y') }} | <a href="{{ config('app.github') }}">GitHub</a></p>
        </footer>
    </div>
    <script src="//kit.fontawesome.com/{{ config('ui.font_awesome') }}.js" crossorigin="anonymous"></script>
    <script>
        let Application = {
            location: "{{ url('/') }}",
            locale: "{{ config('app.locale') }}",
            auth: {{ auth()->user() ? 'true' : 'false' }},
            statuses: {
                icons: @json(config('model-status.icons')),
                colors: @json(config('model-status.colors'))
            }
        };
        @if(auth()->user())
            Application.user = @json(auth()->user());
        @endif
    </script>
    @stack('scripts')
    @stack('forms')
</body>
</html>
