
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @include('layouts.header-parts.turbolinks')

    @include('layouts.header-parts.prism-js')

    @include('layouts.header-parts.prism-css')

    <link rel="stylesheet" href="/lib/rawcdn.githack.com/dutchenkoOleg/prismjs-material-theme/a4515a0a25904e57b43ed09c7b5e54095f27e909/css/darker.min.css">

    @include('layouts.header-parts.bootstrap-js')

    <!-- Fonts -->
    @include('layouts.header-parts.google-fonts')

    <!-- Styles -->
    @include('layouts.header-parts.custom-css')
</head>
