<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if (isset($title)) {{ $title }} @else Chat Application @endif</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (auth()->check())
        <script>
            window.Laravel = {
                userId: {{ auth()->id() }}
            };
        </script>
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="mb-5">
        @include('layouts.nav')
    </div>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @yield('scripts')
</body>

</html>
