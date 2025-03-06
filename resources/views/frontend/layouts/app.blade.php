<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flex Box Movies</title>

    <!-- Primary Meta Tags -->
    <meta name="description" content="Watch online movies for free, watch movies free in high quality without registration. Just a better place for watching online movies for free.">
    <meta name="keywords" content="movies, watch movies, free movies, online movies, streaming">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Flex Box Movies">
    <meta property="og:description" content="Watch online movies for free in high quality without registration">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/assets/favicon-16x16.png') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <script defer src="{{ asset('frontend/assets/js/app-home.min.js') }}"></script>
</head>

<body class="bg-bodys">
    @include('frontend.partials.navbar')

    @yield('content')

    @include('frontend.partials.footer')

    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/dropdown-fix.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/collapse-fix.js') }}"></script>
</body>
</html>
