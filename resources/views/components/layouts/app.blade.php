<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? '' }}</title>
        @filamentStyles
        @vite('resources/css/app.css')
        @livewireStyles
        <style>
            [x-cloak] {
                display: none !important;
             }
          </style>
    </head>
    <body class="min-h-[100svh] bg-[#f7f7f7]">
        {{ $slot }}
        @livewire('notifications')
        @filamentScripts
        @livewireScripts

        @vite('resources/js/app.js')
    </body>
</html>
