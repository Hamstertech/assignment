<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Techquity Assignment</title>

        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        <div class="relative items-top justify-center min-h-screen bg-gray-900 dark:bg-gray-900 pt-5">
            <div class="max-w-full sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </div>
        
        <div class="hidden bg-amber-600 bg-emerald-600"></div>
    </body>
</html>
