<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA Hub</title>

    <!-- ✅ Load CSS directly from public -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Favicon -->
    <link rel="icon" href="https://cdn.nba.com/logos/nba-primary-logo.svg">
</head>
<body class="bg-gray-900 text-white font-sans antialiased flex flex-col min-h-screen">

{{-- Navigation --}}
@include('layouts.navigation')

{{-- Page Content --}}
<main class="flex-grow">
    @yield('content')
</main>

{{-- Footer --}}
@include('layouts.footer')

<!-- ✅ Load JS directly from public -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
