<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Ogani | Template')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/ogani/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/ogani/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/ogani/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/ogani/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/ogani/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/ogani/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/ogani/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/ogani/css/style.css') }}" type="text/css">
    @yield('css')
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

@yield('content')

<!-- Js Plugins -->
<script src="{{ asset('vendor/ogani/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/ogani/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/ogani/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('vendor/ogani/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('vendor/ogani/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('vendor/ogani/js/mixitup.min.js') }}"></script>
<script src="{{ asset('vendor/ogani/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('vendor/ogani/js/main.js') }}"></script>
<!-- Sweetalert2-->
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

@yield('js')
</body>

</html>
