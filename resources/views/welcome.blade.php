<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shop</title>
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/app.js" defer></script>
    </head>
    <body>
        @if (auth()->check())
            {{ auth()->user()->email }}
        @else
            not logged in
        @endif
        <div id="app">
            <index></index>
        </div>
    </body>
</html>
