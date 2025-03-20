<!DOCTYPE html>
<!-- saved from url=(0070)https://templates.iqonic.design/streamit-dist/frontend/html/index.html -->
<html lang="en" data-bs-theme="dark" dir="ltr" style="--header-height: 74px;">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ \App\Models\Setting::get('site_title') ?? 'StreamIT' }}</title>
    <!-- Google Font Api KEY-->
    <meta name="google_font_api" content="AIzaSyBG58yNdAjc20_8jAvLNSVi9E4Xhwjau_k">

    <!-- Favicon -->
    @if(\App\Models\Setting::get('favicon'))
    <link rel="shortcut icon" href="{{ asset('storage/' . \App\Models\Setting::get('favicon')) }}">
    @else
    <link rel="shortcut icon" href="https://templates.iqonic.design/streamit-dist/frontend/html/assets/images/favicon.ico">
    @endif

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/libs.min.css">

    <!-- font-awesome css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/all.min.css">

    <!-- Iconly css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/style.css">

    <!-- Animate css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/animate.min.css">



    <!-- SwiperSlider css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/swiper.min.css">

    <link href="{{ asset('frontend/assets') }}/css/video-js.css" rel="stylesheet">


    <!-- Streamit Design System Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/streamit.min.css">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/custom.min.css">

    <!-- Payment Methods Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/payment-methods.css') }}">

    <!-- Rtl Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/rtl.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="{{ asset('frontend/assets') }}/css/css2" rel="stylesheet">

    <script src="{{ asset('AdminLTE') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/sweetalert2.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Infinite Scroll CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/infinite-scroll.css') }}">

    @stack('styles')
</head>

<body class="  ">
    <span class="screen-darken"></span>
    <!-- loader Start -->
    <!-- loader Start -->
    <div class="loader simple-loader animate__animated animate__fadeOut d-none">
        <div class="loader-body">
            <img src="{{ asset('frontend/assets') }}/images/loader.gif" alt="loader" class="img-fluid "
                width="300">
        </div>
    </div>
    <!-- loader END --> <!-- loader END -->
    <main class="main-content">
        <!--Nav Start-->
        @include('frontend.partials.navbar')
        <!--Nav End-->


        @yield('content')


    </main>

    @include('frontend.partials.footer')

    {{-- @include('frontend.partials.customize') --}}

    @stack('scripts')

    <!-- Wrapper End-->
    <!-- Library Bundle Script -->
    <script src="{{ asset('frontend/assets') }}/js/libs.min.js"></script>
    <!-- Plugin Scripts -->
    <!-- SwiperSlider Script -->
    <script src="{{ asset('frontend/assets') }}/js/swiper.min.js"></script>
    <!-- fslightbox Script -->
    <script src="{{ asset('frontend/assets') }}/js/fslightbox.js" defer=""></script>
    <!-- Lodash Utility -->
    <script src="{{ asset('frontend/assets') }}/js/lodash.min.js"></script>
    <!-- External Library Bundle Script -->
    <script src="{{ asset('frontend/assets') }}/js/external.min.js"></script>
    <!-- countdown Script -->
    <script src="{{ asset('frontend/assets') }}/js/countdown.js"></script>
    <!-- utility Script -->
    <script src="{{ asset('frontend/assets') }}/js/utility.js"></script>
    <!-- Setting Script -->
    <script src="{{ asset('frontend/assets') }}/js/setting.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/setting-init.js" defer=""></script>
    <!-- Streamit Script -->
    <script src="{{ asset('frontend/assets') }}/js/streamit.js" defer=""></script>
    <script src="{{ asset('frontend/assets') }}/js/swiper.js" defer=""></script>

    <!-- Library Bundle Script -->
    <script type="text/javascript" id="www-widgetapi-script" src="{{ asset('frontend/assets') }}/js/www-widgetapi.js"
        async=""></script>
    {{-- <script src="{{ asset('frontend/assets') }}/js/iframe_api"></script> --}}
    <!-- Plugin Scripts -->

    <script src="{{ asset('frontend/assets') }}/js/video.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/youtube.js"></script>

    <!-- Select2 Script -->
    <script src="{{ asset('frontend/assets') }}/js/select2.js" defer=""></script>
    <script src="{{ asset('frontend/assets') }}/js/sweetalert2.min.js" async=""></script>
    <script src="{{ asset('frontend/assets') }}/js/sweet-alert.js" defer=""></script>

    <script>
        $(function() {
            // Initialize SweetAlert2 Toast
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            // Success Toast
            window.showSuccessToast = function(message) {
                Toast.fire({
                    icon: 'success',
                    title: message || 'Operation completed successfully!'
                });
            };

            // Error Toast
            window.showErrorToast = function(message) {
                Toast.fire({
                    icon: 'error',
                    title: message || 'An error occurred!'
                });
            };

            // Warning Toast
            window.showWarningToast = function(message) {
                Toast.fire({
                    icon: 'warning',
                    title: message || 'Warning!'
                });
            };

            // Info Toast
            window.showInfoToast = function(message) {
                Toast.fire({
                    icon: 'info',
                    title: message || 'Information!'
                });
            };

            // Question Toast
            window.showQuestionToast = function(message) {
                Toast.fire({
                    icon: 'question',
                    title: message || 'Question?'
                });
            };

            // Process Flash Messages from Laravel
            @if (session('success'))
                showSuccessToast("{{ session('success') }}");
            @endif

            @if (session('error'))
                showErrorToast("{{ session('error') }}");
            @endif

            @if (session('warning'))
                showWarningToast("{{ session('warning') }}");
            @endif

            @if (session('info'))
                showInfoToast("{{ session('info') }}");
            @endif
        });

    </script>

</body>

</html>
