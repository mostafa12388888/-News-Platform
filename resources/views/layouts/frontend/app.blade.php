<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Bootstrap News Template - Free HTML Templates" name="keywords" />
    <meta content="Bootstrap News Template - Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="{{ asset('assets/frontEnd/img/favicon.ico') }}" rel="icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet" />

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/frontEnd/lib/slick/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontEnd/lib/slick/slick-theme.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/frontEnd/css/style.css') }}" rel="stylesheet" />
    <!--  file input main css -->
    <link href="{{ asset('assets/vendor/file-input/css/fileinput.min.css') }}" rel="stylesheet" />
    <!-- summer Not -->
    <link href="{{ asset('assets/vendor/summer-not/summernote-bs4.min.css') }}" rel="stylesheet" />

</head>

<body>
    <!-- header page -->
    @include('layouts.frontend.header')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                @section('Breadcrumb')
                    <!-- empty -->
                @show
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- body pages -->
    @yield('body')

    <!-- footer page  -->
    @include('layouts.frontend.footer')
    @auth
        <script>
            const id = {{ auth()->user()->id }};
            const role = "user";
        </script>
        <script src="{{ asset('build/assets/app-b0c697e5.js') }}"></script>
    @endauth


    <!-- jQuery أولًا -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- Libraries -->
    <script src="{{ asset('assets/frontEnd/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/frontEnd/lib/slick/slick.min.js') }}"></script>

    <!-- Plugins that depend on jQuery -->
    <script src="{{ asset('assets/vendor/file-input/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/file-input/themes/bs5/theme.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/summer-not/summernote-bs4.min.js') }}"></script>

    <!-- Main JS Template -->
    <script src="{{ asset('assets/frontEnd/js/main.js') }}"></script>

    <!-- Laravel Echo and User ID (after jQuery too) -->


    @stack('js')
</body>

</html>
