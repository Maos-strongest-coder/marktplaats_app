<!DOCTYPE html>
    <html lang="en" class="h-full bg-gray-100">
        <head>
            <meta charset="UTF-8">
                <title>Mo's Marktplaats - @yield('title')</title>
                <script src="https://cdn.tailwindcss.com"></script>
        </head>

        <body class="h-full">
            @include('partials.header')
            @include('partials.nav')
            @include('partials.errors')
            
            @yield('content')
        </body>
    </html>