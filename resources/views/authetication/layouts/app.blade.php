<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="en" data-bs-theme="dark" dir="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>StreamIT | Responsive Bootstrap 5 Template</title>
  <!-- Google Font Api KEY-->
  <meta name="google_font_api" content="AIzaSyBG58yNdAjc20_8jAvLNSVi9E4Xhwjau_k">

  <!-- Favicon -->
  <link rel="shortcut icon"
    href="https://templates.iqonic.design/streamit-dist/frontend/html/assets/images/favicon.ico">

  <!-- Library / Plugin Css Build -->
  <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/libs.min.css">

  <!-- font-awesome css -->
  <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/all.min.css">

  <!-- Iconly css -->
  <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/style.css">

  <!-- Animate css -->
  <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/animate.min.css">

  <!-- Streamit Design System Css -->
  <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/streamit.min.css">

  <!-- Custom Css -->
  <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/custom.min.css">

  <!-- Rtl Css -->
  <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/rtl.min.css">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
  <link href="{{ asset('frontend/assets') }}/css/css2" rel="stylesheet">

</head>

<body class=" ">
  <span class="screen-darken"></span>
  <div class="loader simple-loader animate__animated animate__fadeOut d-none">
    <div class="loader-body">
      <img src="{{ asset('frontend/assets') }}/images/loader.gif" alt="loader" class="img-fluid " width="300">
    </div>
  </div>

  <main class="main-content">



    <div class="vh-100" style="background: url(&#39;{{ asset('frontend/assets') }}/images/background.webp&#39;); background-size: cover; background-repeat: no-repeat; position: relative;min-height:500px">
      <div class="container">
        <div class="row justify-content-center align-items-center height-self-center vh-100">

            @yield('content')

        </div>
      </div>
    </div>

  </main>



  <!-- Wrapper End-->
  <!-- Library Bundle Script -->
  <script src="{{ asset('frontend/assets') }}/js/libs.min.js"></script>
  <!-- Plugin Scripts -->
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


</body>

</html>
