<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>one volt</title>
        <meta name="robots" content="noindex, follow" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend') }}/images/favicon.ico">

        <!-- CSS
 ============================================ -->
        <!-- google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900"
            rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/vendor/bootstrap.min.css">
        <!-- Icon Font CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/vendor/bicon.min.css">
        <!-- Flat Icon CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/vendor/flaticon.css">
        <!-- audio & video player CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins/plyr.css">
        <!-- Slick CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins/slick.min.css">
        <!-- nice-select CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins/nice-select.css">
        <!-- perfect scrollbar css -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins/perfect-scrollbar.css">
        <!-- light gallery css -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins/lightgallery.min.css">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
    </head>

    <body>
        @include('frontend.layout.header')

        <main>
            @yield('content')

        </main>

        <!-- Scroll to top start -->
        <div class="scroll-top not-visible">
            <i class="bi bi-finger-index"></i>
        </div>
        <!-- Scroll to Top End -->

        {{-- @include('frontend.layout.footer') --}}

        <!-- JS============================================ -->

        <!-- Modernizer JS -->
        <script src="{{ asset('frontend') }}/js/vendor/modernizr-3.6.0.min.js"></script>
        <!-- jQuery JS -->
        <script src="{{ asset('frontend') }}/js/vendor/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('frontend') }}/js/vendor/bootstrap.bundle.min.js"></script>
        <!-- Slick Slider JS -->
        <script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
        <!-- nice select JS -->
        <script src="{{ asset('frontend') }}/js/plugins/nice-select.min.js"></script>
        <!-- audio video player JS -->
        <script src="{{ asset('frontend') }}/js/plugins/plyr.min.js"></script>
        <!-- perfect scrollbar js -->
        <script src="{{ asset('frontend') }}/js/plugins/perfect-scrollbar.min.js"></script>
        <!-- light gallery js -->
        <script src="{{ asset('frontend') }}/js/plugins/lightgallery-all.min.js"></script>
        <!-- image loaded js -->
        <script src="{{ asset('frontend') }}/js/plugins/imagesloaded.pkgd.min.js"></script>
        <!-- isotope filter js -->
        <script src="{{ asset('frontend') }}/js/plugins/isotope.pkgd.min.js"></script>
        <!-- Main JS -->
        <script src="{{ asset('frontend') }}/js/main.js"></script>
    </body>

</html>