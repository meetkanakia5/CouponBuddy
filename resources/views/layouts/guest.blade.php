<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dist/img/favicon.ico') }}" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/autoCompleteAddress.js') }}" defer></script>
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANlbVsy06mEx8KrK4xj1vDaNhe4NJUJ8k&libraries=places&callback=initMap"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
    <script>
        $(document).ready(function(){
            autocompleteAddress("#address","#zip_code","#direction","#latitude","#longitude");
        });
    </script>
</html>

