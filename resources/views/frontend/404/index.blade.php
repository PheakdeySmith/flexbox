<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" dir="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>404</title>

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

<body class="  ">
  <span class="screen-darken"></span>
  <!-- loader Start -->
  <!-- loader Start -->
  <div class="loader simple-loader animate__animated animate__fadeOut d-none">
    <div class="loader-body">
      <img src="{{ asset('frontend/assets') }}/images/loader.gif" alt="loader" class="img-fluid " width="300">
    </div>
  </div>
  <!-- loader END --> <!-- loader END -->
  <main class="main-content">
    <div class="section-padding vh-100 image-flip-rtl"
      style="background: url(&#39;{{ asset('frontend/assets') }}/images/404-two.webp&#39;); background-size: cover; background-repeat: no-repeat; position: relative;min-height:500px">
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <div class="col-lg-6"></div>
          <div class="col-lg-5">
            <img src="{{ asset('frontend/assets') }}/images/404-text.webp" class="mb-5" alt="404" loading="lazy">
            <h4 class="fw-bold text-center">ohhh no..! you lost in imagination.</h4>
            <p class="text-center">we are sorry, but the page you are looking for doesn’t exist.</p>
            <div class="text-center mt-4 pt-3">
              <div class="iq-button">
                <a href="{{ route('frontend.home') }}"
                  class="btn text-uppercase position-relative">
                  <span class="button-text">Back to home</span>
                  <i class="fa-solid fa-play"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-1"></div>
        </div>
      </div>
    </div>
  </main>


  <div id="back-to-top" style="display: none;" class="animate__animated animate__fadeOut">
    <a class="p-0 btn bg-primary btn-sm position-fixed top border-0 rounded-circle text-white" id="top"
      href="https://templates.iqonic.design/streamit-dist/frontend/html/error-page-two.html#top">
      <i class="fa-solid fa-chevron-up"></i>
    </a>
  </div>
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
