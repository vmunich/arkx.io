<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.3.1/css/regular.css" integrity="sha384-pofSFWh/aTwxUvfNhg+LRpOXIFViguTD++4CNlmwgXOrQZj1EOJewBT+DmUVeyJN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.3.1/css/brands.css" integrity="sha384-AOiME8p6xSUbTO/93cbYmpOihKrqxrLjvkT2lOpIov+udKmjXXXFLfpKeqwTjNTC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.3.1/css/fontawesome.css" integrity="sha384-Yz2UJoJEWBkb0TBzOd2kozX5/G4+z5WzWMMZz1Np2vwnFjF5FypnmBUBPH2gUa1F" crossorigin="anonymous">
        <link rel="shortcut icon" href="{{ asset('favicon.png')}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
        @include('layouts.partials.cookie-consent')
        @stack('styles')
    </head>

    <body class="font-sans">
        <div id="app">
            {{ $slot }}
        </div>

        {{-- <div class="white-mask"></div> --}}
    </body>

    <script src={{ asset('js/app.js') }}></script>
    @stack('scripts')

    @auth
        @include('layouts.partials.beacon')
    @endauth
</html>
