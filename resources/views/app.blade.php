<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <!-- museo-sans from fonts.adobe.com -->
        <link rel="stylesheet" href="https://use.typekit.net/lqw5sjc.css">
        <link rel="icon" type="image/png" href="/ico.png">

        <!-- Scripts -->
        @routes
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="font-sans antialiased" style="margin-bottom: 0px !important">
        @inertia
    </body>
</html>
