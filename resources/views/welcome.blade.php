<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{asset('CSS/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('CSS/all.min.css')}}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>

        @include('components.navbar')
        @yield('body')
        <script src="{{asset('JS/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('JS/all.min.js')}}"></script>
    </body>
</html>
