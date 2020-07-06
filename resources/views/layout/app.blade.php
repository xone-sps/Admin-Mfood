<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | M FOOD</title>
        <!-- Styles -->
        @yield('meta_search')
        @yield('scripts_header')
    </head>
    <body>
    <div id="app">
    </div>
    <noscript>
        <div id="noscript-warning"><h2 class="title"> M FOOD works best with JavaScript enabled.</h2></div>
    </noscript>
    @yield('scripts_footer')
    </body>
</html>
