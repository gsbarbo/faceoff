<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>FaceOff | Home</title>
    @include('partials.header')
</head>
<body class="bg-charcoal text-steel-gray">

@include('partials.navbar')

<main class="mt-3 container mx-auto">
    @yield('content')
</main>

@include('partials.scripts')
</body>
</html>
