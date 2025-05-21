<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-900 text-white font-sans antialiased">
@include('layouts.navigation')

<main class="p-6 max-w-7xl mx-auto">
    @yield('content')
</main>

@include('layouts.footer')

{{-- Optional script stack for page-specific JS --}}
@stack('scripts')
</body>
</html>
