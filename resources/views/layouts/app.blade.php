<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NBA Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans">
@include('partials.navbar')
<main class="p-6">
    @yield('content')
</main>
</body>
</html>
