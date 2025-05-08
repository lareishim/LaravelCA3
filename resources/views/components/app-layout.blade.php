<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'NBA Hub') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans antialiased">
{{-- Navbar --}}
@include('layouts.navigation')

{{-- Optional Page Header --}}
@isset($header)
    <header class="bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
@endisset

{{-- Main Page Content --}}
<main class="p-6 max-w-7xl mx-auto">
    {{ $slot }}
</main>

{{-- Footer --}}
@include('layouts.footer')
</body>
</html>
