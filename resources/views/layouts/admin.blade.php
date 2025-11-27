<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>FaceOff | Admin</title>
    @include('partials.header')
</head>
<body class="bg-charcoal text-steel-gray">

@include('partials.admin.navbar')

<main class="mt-3 p-3 container mx-auto">
    @yield('content')
</main>

@include('partials.scripts')
<x-alerts/>
</body>
</html>
