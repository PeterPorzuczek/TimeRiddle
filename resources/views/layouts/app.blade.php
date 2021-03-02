<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.header-board')
    <body>
        <div id="app">
            @yield('app-content')
        </div>
    </body>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?v=0.12"></script>
</html>
