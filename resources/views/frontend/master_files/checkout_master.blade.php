<!DOCTYPE html>
<html>

    <head>
        @include('frontend.layouts.include-css')
    </head>

    <body class="d-flex flex-column min-vh-100">
        @include('frontend.layouts.navbar')
        @yield('content')

        @include('frontend.layouts.footer')
        @include('frontend.layouts.include-js')
        @yield('js-extra')
    </body>
</html>