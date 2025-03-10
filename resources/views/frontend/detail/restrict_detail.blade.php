@extends('frontend.layouts.app')

@section('styles')
  <style class="vjs-styles-defaults">
    .video-js {
      width: 300px;
      height: 150px;
    }

    .vjs-fluid {
      padding-top: 56.25%
    }
  </style>

  <style type="text/css">
    .vjs-youtube .vjs-iframe-blocker {
      display: none;
    }

    .vjs-youtube.vjs-user-inactive .vjs-iframe-blocker {
      display: block;
    }

    .vjs-youtube .vjs-poster {
      background-size: cover;
    }

    .vjs-youtube-mobile .vjs-big-play-button {
      display: none;
    }
  </style>
  <style class="fslightbox-styles">
    .fslightbox-absoluted {
      position: absolute;
      top: 0;
      left: 0
    }

    .fslightbox-fade-in {
      animation: fslightbox-fade-in .3s cubic-bezier(0, 0, .7, 1)
    }

    .fslightbox-fade-out {
      animation: fslightbox-fade-out .3s ease
    }

    .fslightbox-fade-in-strong {
      animation: fslightbox-fade-in-strong .3s cubic-bezier(0, 0, .7, 1)
    }

    .fslightbox-fade-out-strong {
      animation: fslightbox-fade-out-strong .3s ease
    }

    @keyframes fslightbox-fade-in {
      from {
        opacity: .65
      }

      to {
        opacity: 1
      }
    }

    @keyframes fslightbox-fade-out {
      from {
        opacity: .35
      }

      to {
        opacity: 0
      }
    }

    @keyframes fslightbox-fade-in-strong {
      from {
        opacity: .3
      }

      to {
        opacity: 1
      }
    }

    @keyframes fslightbox-fade-out-strong {
      from {
        opacity: 1
      }

      to {
        opacity: 0
      }
    }

    .fslightbox-cursor-grabbing {
      cursor: grabbing
    }

    .fslightbox-full-dimension {
      width: 100%;
      height: 100%
    }

    .fslightbox-open {
      overflow: hidden;
      height: 100%
    }

    .fslightbox-flex-centered {
      display: flex;
      justify-content: center;
      align-items: center
    }

    .fslightbox-opacity-0 {
      opacity: 0 !important
    }

    .fslightbox-opacity-1 {
      opacity: 1 !important
    }

    .fslightbox-scrollbarfix {
      padding-right: 17px
    }

    .fslightbox-transform-transition {
      transition: transform .3s
    }

    .fslightbox-container {
      font-family: Arial, sans-serif;
      position: fixed;
      top: 0;
      left: 0;
      background: linear-gradient(rgba(30, 30, 30, .9), #000 1810%);
      touch-action: pinch-zoom;
      z-index: 1000000000;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      -webkit-tap-highlight-color: transparent
    }

    .fslightbox-container * {
      box-sizing: border-box
    }

    .fslightbox-svg-path {
      transition: fill .15s ease;
      fill: #ddd
    }

    .fslightbox-nav {
      height: 45px;
      width: 100%;
      position: absolute;
      top: 0;
      left: 0
    }

    .fslightbox-slide-number-container {
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      height: 100%;
      font-size: 15px;
      color: #d7d7d7;
      z-index: 0;
      max-width: 55px;
      text-align: left
    }

    .fslightbox-slide-number-container .fslightbox-flex-centered {
      height: 100%
    }

    .fslightbox-slash {
      display: block;
      margin: 0 5px;
      width: 1px;
      height: 12px;
      transform: rotate(15deg);
      background: #fff
    }

    .fslightbox-toolbar {
      position: absolute;
      z-index: 3;
      right: 0;
      top: 0;
      height: 100%;
      display: flex;
      background: rgba(35, 35, 35, .65)
    }

    .fslightbox-toolbar-button {
      height: 100%;
      width: 45px;
      cursor: pointer
    }

    .fslightbox-toolbar-button:hover .fslightbox-svg-path {
      fill: #fff
    }

    .fslightbox-slide-btn-container {
      display: flex;
      align-items: center;
      padding: 12px 12px 12px 6px;
      position: absolute;
      top: 50%;
      cursor: pointer;
      z-index: 3;
      transform: translateY(-50%)
    }

    @media (min-width:476px) {
      .fslightbox-slide-btn-container {
        padding: 22px 22px 22px 6px
      }
    }

    @media (min-width:768px) {
      .fslightbox-slide-btn-container {
        padding: 30px 30px 30px 6px
      }
    }

    .fslightbox-slide-btn-container:hover .fslightbox-svg-path {
      fill: #f1f1f1
    }

    .fslightbox-slide-btn {
      padding: 9px;
      font-size: 26px;
      background: rgba(35, 35, 35, .65)
    }

    @media (min-width:768px) {
      .fslightbox-slide-btn {
        padding: 10px
      }
    }

    @media (min-width:1600px) {
      .fslightbox-slide-btn {
        padding: 11px
      }
    }

    .fslightbox-slide-btn-container-previous {
      left: 0
    }

    @media (max-width:475.99px) {
      .fslightbox-slide-btn-container-previous {
        padding-left: 3px
      }
    }

    .fslightbox-slide-btn-container-next {
      right: 0;
      padding-left: 12px;
      padding-right: 3px
    }

    @media (min-width:476px) {
      .fslightbox-slide-btn-container-next {
        padding-left: 22px
      }
    }

    @media (min-width:768px) {
      .fslightbox-slide-btn-container-next {
        padding-left: 30px
      }
    }

    @media (min-width:476px) {
      .fslightbox-slide-btn-container-next {
        padding-right: 6px
      }
    }

    .fslightbox-down-event-detector {
      position: absolute;
      z-index: 1
    }

    .fslightbox-slide-swiping-hoverer {
      z-index: 4
    }

    .fslightbox-invalid-file-wrapper {
      font-size: 22px;
      color: #eaebeb;
      margin: auto
    }

    .fslightbox-video {
      object-fit: cover
    }

    .fslightbox-youtube-iframe {
      border: 0
    }

    .fslightbox-loader {
      display: block;
      margin: auto;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 67px;
      height: 67px
    }

    .fslightbox-loader div {
      box-sizing: border-box;
      display: block;
      position: absolute;
      width: 54px;
      height: 54px;
      margin: 6px;
      border: 5px solid;
      border-color: #999 transparent transparent transparent;
      border-radius: 50%;
      animation: fslightbox-loader 1.2s cubic-bezier(.5, 0, .5, 1) infinite
    }

    .fslightbox-loader div:nth-child(1) {
      animation-delay: -.45s
    }

    .fslightbox-loader div:nth-child(2) {
      animation-delay: -.3s
    }

    .fslightbox-loader div:nth-child(3) {
      animation-delay: -.15s
    }

    @keyframes fslightbox-loader {
      0% {
        transform: rotate(0)
      }

      100% {
        transform: rotate(360deg)
      }
    }

    .fslightbox-source {
      position: relative;
      z-index: 2;
      opacity: 0
    }
  </style>

@endsection

@section('content')
    <!-- Banner Start -->
    <div class="iq-main-slider site-video">
      <div class="container-fluid">
        <div class="iq-content_restriction">
          <div class="iq-restriction_box">
            <span class="subscribe-text">You must be logged in to view this content.</span>
            <div class="iq-button">
              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                class="btn text-uppercase position-relative">
                <span class="button-text">Subscribe To Watch</span>
                <i class="fa-solid fa-play"></i>
              </a>
            </div>
            <span> Already a Member?</span>
            <div class="iq-button">
              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                class="btn text-uppercase position-relative">
                <span class="button-text">Log in</span>
                <i class="fa-solid fa-play"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner End -->

    <div class="details-part">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <!-- Movie Description Start-->
            <div class="trending-info mt-4 pt-0 pb-4">
              <div class="row">
                <div class="col-md-9 col-12 mb-auto">
                  <div class="d-block d-lg-flex align-items-center">
                    <h2
                      class="trending-text fw-bold texture-text text-uppercase my-0 fadeInLeft animated d-inline-block"
                      data-animation-in="fadeInLeft" data-delay-in="0.6" style="opacity: 1; animation-delay: 0.6s">
                      Zombie Island
                    </h2>
                    <div class="slider-ratting d-flex align-items-center ms-lg-3 ms-0">
                      <ul
                        class="ratting-start p-0 m-0 list-inline text-warning d-flex align-items-center justify-content-left">
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                      </ul>
                      <span class="text-white ms-2">4.8 (imdb)</span>
                    </div>
                  </div>
                  <ul class="p-0 mt-2 list-inline d-flex flex-wrap movie-tag">
                    <li class="trending-list"><a class="text-primary"
                        href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html">Action</a>
                    </li>
                    <li class="trending-list"><a class="text-primary"
                        href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html">Adventure</a>
                    </li>
                    <li class="trending-list"><a class="text-primary"
                        href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html">Drama</a>
                    </li>
                  </ul>
                  <div class="d-flex flex-wrap align-items-center text-white text-detail flex-wrap mb-4">
                    <span class="badge bg-secondary">Horror</span>
                    <span class="ms-3 font-Weight-500 genres-info me-1">1hr : 48mins</span>
                    <span class="trending-year trending-year-list font-Weight-500 genres-info">
                      Feb 2017
                    </span>
                  </div>


                  <div class="d-flex align-items-center gap-4 flex-wrap mb-4">
                    <ul class="list-inline p-0 share-icons music-play-lists mb-n2 mx-n2">
                      <li class="share">
                        <span><i class="fa-solid fa-share-nodes"></i></span>
                        <div class="share-box">
                          <svg width="15" height="40" viewBox="0 0 15 40" class="share-shape" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                              fill="#191919"></path>
                          </svg>
                          <div class="d-flex align-items-center">
                            <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#"
                              class="share-ico"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#"
                              class="share-ico"><i class="fa-brands fa-twitter"></i></a>
                            <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#"
                              class="share-ico"><i class="fa-solid fa-link"></i></a>
                          </div>
                        </div>
                      </li>
                      <li><span><i class="fa-solid fa-heart"></i></span></li>
                      <li><span><i class="fa-solid fa-plus"></i></span></li>
                      <li><span><a
                            href="https://templates.iqonic.design/streamit-dist/frontend/html/assets/images/video/trailer.mp4"
                            download=""><i class="fa-solid fa-download"></i></a></span></li>
                    </ul>

                    <button>Add to Cart</button>

                    {{-- <div class="movie-detail-select">
                      <select name="movieselect"
                        class="form-control movie-select select2-basic-single js-states select2-hidden-accessible"
                        data-select2-id="select2-data-1-8vud" tabindex="-1" aria-hidden="true" data-sharkid="__0">
                        <option value="1" data-select2-id="select2-data-3-nuq6">Playlist</option>
                        <option value="2">Zombie Island</option>
                        <option value="3">Sand Dust</option>
                        <option value="4">Jumbo Queen</option>
                      </select>
                    </div> --}}
                  </div>



                  <ul class="iq-blogtag list-unstyled d-flex flex-wrap align-items-center gap-3 p-0">
                    <li class="iq-tag-title text-primary mb-0">
                      <i class="fa fa-tags" aria-hidden="true"></i>
                      Tags:
                    </li>
                    <li><a class="title"
                        href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html">Action</a><span
                        class="text-secondary">,</span></li>
                    <li><a class="title"
                        href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html">Adventure</a><span
                        class="text-secondary">,</span></li>
                    <li><a class="title"
                        href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html">Drama</a><span
                        class="text-secondary">,</span></li>
                  </ul>
                </div>
                <div class="trailor-video col-md-3 col-12 mt-lg-0 mt-4 mb-md-0 mb-1 text-lg-right">
                  <a data-fslightbox="html5-video" href="https://www.youtube.com/watch?v=QCGq1epI9pQ"
                    class="video-open playbtn block-images position-relative playbtn_thumbnail">
                    <img src="{{ asset('frontend/assets') }}/images//01.webp"
                      class="attachment-medium-large size-medium-large wp-post-image" alt="" loading="lazy">
                    <span class="content btn btn-transparant iq-button">
                      <i class="fa fa-play me-2 text-white"></i>
                      <span>Trailer Link</span>
                    </span>
                  </a>
                </div>
              </div>
            </div>
            <!-- Movie Description End --> <!-- Movie Source Start -->
            <div class="content-details trending-info">
              <ul
                class="iq-custom-tab tab-bg-gredient-center d-flex nav nav-pills align-items-center text-center mb-5 justify-content-center list-inline"
                role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active show" data-bs-toggle="pill"
                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#description-01"
                    role="tab" aria-selected="true">
                    Description
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" data-bs-toggle="pill"
                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#review-01"
                    role="tab" aria-selected="false" tabindex="-1">
                    Rate &amp; Review
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" data-bs-toggle="pill"
                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#source-01"
                    role="tab" aria-selected="false" tabindex="-1">
                    Sources
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div id="description-01" class="tab-pane animated fadeInUp active show" role="tabpanel">
                  <div class="description-content">
                    <p>
                      Zombie Island is a 1998 direct-to-video animated comedy horror film
                      based on Hanna-Barbera's Scooby-Doo Saturday-morning cartoons. In the
                      film, Shaggy, Scooby, Fred, Velma, and Daphne reunite after a
                      year-long hiatus from Mystery, Inc. to investigate a bayou island said
                      to be haunted by the ghost of the pirate Morgan Moonscar. The film was
                      directed by Jim Stenstrum, from a screenplay by Glenn Leopold.
                    </p>
                  </div>
                </div>
                <div id="review-01" class="tab-pane animated fadeInUp" role="tabpanel">
                  <div class="streamit-reviews">
                    <div id="comments" class="comments-area validate-form">
                      <p class="masvideos-noreviews mt-3">
                        There are no reviews yet.
                      </p>
                    </div>
                    <div class="review_form">
                      <div class="comment-respond">
                        <h3 class="fw-500 my-2">
                          Be the first to review “Zombie Island”
                        </h3>
                        <p class="comment-notes"><span>Your email address will not be
                            published.</span><span> Required fields are marked<span class="required"> * </span></span>
                        </p>
                        <div class="d-flex align-items-center mb-4"><label>Your
                            rating</label>
                          <div class="star ms-4 text-primary"><span><i class="fa-regular fa-star"></i></span> <span><i
                                class="fa-regular fa-star"></i></span> <span><i class="fa-regular fa-star"></i></span>
                            <span><i class="fa-regular fa-star"></i></span> <span><i
                                class="fa-regular fa-star"></i></span></div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="mb-2">
                                Your review
                                <span class="required">
                                  *
                                </span>
                              </label>
                              <textarea class="form-control" name="comment" cols="5" rows="8" required=""></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="mb-2">
                                Name
                                <span class="required">
                                  *
                                </span>
                              </label>
                              <input class="form-control" name="author" type="text" value="" size="30" required="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="mb-2">
                                Email&nbsp;
                                <span class="required">
                                  *
                                </span>
                              </label>
                              <input class="form-control" name="email" type="email" value="" size="30" required="">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mt-3 mt-3 d-flex gap-2 align-items-center">
                              <input class="form-check-input mt-0" type="checkbox" value="" id="check1" checked="">
                              <label class="form-check-label" for="check1">
                                Save my name, email, and website in this browser for the
                                next time I comment.
                              </label>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-submit mt-4">
                              <div class="iq-button">
                                <button name="submit" type="submit" id="submit"
                                  class="btn text-uppercase position-relative" value="Submit">
                                  <span class="button-text">Submit</span>
                                  <i class="fa-solid fa-play"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="source-01" class="tab-pane animated fadeInUp" role="tabpanel">
                  <div class="source-list-content table-responsive">
                    <table class="table custom-table">
                      <thead>
                        <tr>
                          <th>
                            Links
                          </th>
                          <th>
                            Quality
                          </th>
                          <th>
                            Language
                          </th>
                          <th>
                            Player
                          </th>
                          <th>
                            Date Added
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="iq-button">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                                class="btn text-uppercase position-relative">
                                <span class="button-text"> Play Now</span>
                                <i class="fa-solid fa-play"></i>
                              </a>
                            </div>
                          </td>
                          <td>
                            1080p
                          </td>
                          <td>
                            english
                          </td>
                          <td>
                            MusicBee
                          </td>
                          <td>
                            2021-11-28
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="iq-button">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                                class="btn text-uppercase position-relative">
                                <span class="button-text"> Play Now</span>
                                <i class="fa-solid fa-play"></i>
                              </a>
                            </div>
                          </td>
                          <td>
                            800p
                          </td>
                          <td>
                            english
                          </td>
                          <td>
                            5KPlayer
                          </td>
                          <td>
                            2021-11-25
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="iq-button">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                                class="btn text-uppercase position-relative">
                                <span class="button-text"> Play Now</span>
                                <i class="fa-solid fa-play"></i>
                              </a>
                            </div>
                          </td>
                          <td>
                            720p
                          </td>
                          <td>
                            English
                          </td>
                          <td>
                            MediaMonkey
                          </td>
                          <td>
                            2021-11-20
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- Movie Source End -->
          </div>
        </div>
      </div>
    </div>

    <div class="cast-tabs">
      <div class="container-fluid">
        <div class="content-details trending-info g-border iq-rtl-direction">
          <ul class="iq-custom-tab tab-bg-fill d-flex nav nav-pills mb-5 " role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active show" data-bs-toggle="pill"
                href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#cast-1"
                role="tab" aria-selected="true">Cast</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-bs-toggle="pill"
                href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#crew-1"
                role="tab" aria-selected="false" tabindex="-1">Crew</a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="cast-1" class="tab-pane animated fadeInUp active show" role="tabpanel">
              <div
                class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
                data-slide="5" data-laptop="5" data-tab="3" data-mobile="2" data-mobile-sm="1" data-autoplay="false"
                data-loop="false" data-navigation="true" data-pagination="true">
                <ul class="list-inline swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);"
                  id="swiper-wrapper-ddeb8a13210f70430" aria-live="polite">
                  <li class="swiper-slide swiper-slide-active" style="width: 263.8px;" role="group" aria-label="1 / 2">
                    <div class="cast-images m-0 row align-items-center position-relative">
                      <div class="col-4 img-box p-0">
                        <img src="{{ asset('frontend/assets') }}/images//g1.webp" class="img-fluid" alt="image" loading="lazy">
                      </div>
                      <div class="col-8 block-description">
                        <h6 class="iq-title">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html"
                            tabindex="0">James Chinlund </a>
                        </h6>
                        <div class="video-time d-flex align-items-center my-2">
                          <small class="text-white">As James</small>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="swiper-slide swiper-active last swiper-slide-next" style="width: 263.8px;" role="group"
                    aria-label="2 / 2">
                    <div class="cast-images m-0 row align-items-center position-relative">
                      <div class="col-4 img-box p-0">
                        <img src="{{ asset('frontend/assets') }}/images//g2.webp" class="img-fluid" alt="image" loading="lazy">
                      </div>
                      <div class="col-8 block-description">
                        <h6 class="iq-title">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html"
                            tabindex="0">James Earl Jones </a>
                        </h6>
                        <div class="video-time d-flex align-items-center my-2">
                          <small class="text-white">As Jones</small>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
              </div>
            </div>
            <div id="crew-1" class="tab-pane animated fadeInUp" role="tabpanel">
              <div
                class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
                data-slide="5" data-laptop="5" data-tab="3" data-mobile="2" data-mobile-sm="2" data-autoplay="false"
                data-loop="false" data-navigation="true" data-pagination="true">
                <ul class="list-inline swiper-wrapper" id="swiper-wrapper-f102ff4e1d23d10ce3" aria-live="polite"
                  style="transition-duration: 0ms;">
                  <li class="swiper-slide">
                    <div class="cast-images m-0 row align-items-center position-relative">
                      <div class="col-4 img-box p-0">
                        <img src="{{ asset('frontend/assets') }}/images//g3.webp" class="img-fluid" alt="image" loading="lazy">
                      </div>
                      <div class="col-8 block-description starring-desc ">
                        <h6 class="iq-title">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html"
                            tabindex="0"> Jeff Nathanson </a>
                        </h6>
                        <div class="video-time d-flex align-items-center my-2">
                          <small class="text-white">Writing</small>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="swiper-slide">
                    <div class="cast-images m-0 row align-items-center position-relative">
                      <div class="col-4 img-box p-0">
                        <img src="{{ asset('frontend/assets') }}/images//g5.webp" class="person__poster--image img-fluid" alt="image"
                          loading="lazy">
                      </div>
                      <div class="col-8 block-description starring-desc ">
                        <h6 class="iq-title">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html"
                            tabindex="0"> Irene Mecchi </a>
                        </h6>
                        <div class="video-time d-flex align-items-center my-2">
                          <small class="text-white">Writing</small>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="swiper-slide">
                    <div class="cast-images m-0 row align-items-center position-relative">
                      <div class="col-4 img-box p-0">
                        <img src="{{ asset('frontend/assets') }}/images//g4.webp" class="person__poster--image img-fluid" alt="image"
                          loading="lazy">
                      </div>
                      <div class="col-8 block-description starring-desc ">
                        <h6 class="iq-title">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html"
                            tabindex="0"> Karen Gilchrist </a>
                        </h6>
                        <div class="video-time d-flex align-items-center my-2">
                          <small class="text-white">Production</small>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="recommended-block">
      <div class="container-fluid">
        <div class="overflow-hidden">
          <div class="d-flex align-items-center justify-content-between px-3 pt-2 my-4">
            <h5 class="main-title text-capitalize mb-0">Movies Recommended For You</h5>
          </div>
          <div class="card-style-slider">
            <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
              data-slide="5" data-laptop="5" data-tab="2" data-mobile="2" data-mobile-sm="2" data-autoplay="false"
              data-loop="true" data-navigation="true" data-pagination="true">
              <ul class="p-0 swiper-wrapper m-0  list-inline"
                style="transform: translate3d(-1319px, 0px, 0px); transition-duration: 0ms;"
                id="swiper-wrapper-436cf0615ad7f2510" aria-live="polite">
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 263.8px;"
                  role="group" aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Pricess</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 263.8px;"
                  role="group" aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Soull
                                Meate</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Dangacg</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="5" style="width: 263.8px;"
                  role="group" aria-label="6 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//06.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">crcikeft</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 25mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="6"
                  style="width: 263.8px;" role="group" aria-label="7 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//07.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Avengrs</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active swiper-slide-active" data-swiper-slide-index="0"
                  style="width: 263.8px;" role="group" aria-label="1 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//01(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Giikre</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 12mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active swiper-slide-next" data-swiper-slide-index="1"
                  style="width: 263.8px;" role="group" aria-label="2 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//02.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Arrival</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 22mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active" data-swiper-slide-index="2" style="width: 263.8px;" role="group"
                  aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Pricess</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active" data-swiper-slide-index="3" style="width: 263.8px;" role="group"
                  aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Soull
                                Meate</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active last" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Dangacg</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide" data-swiper-slide-index="5" style="width: 263.8px;" role="group"
                  aria-label="6 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//06.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">crcikeft</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 25mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate-prev" data-swiper-slide-index="6" style="width: 263.8px;"
                  role="group" aria-label="7 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//07.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Avengrs</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                  data-swiper-slide-index="0" style="width: 263.8px;" role="group" aria-label="1 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//01(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Giikre</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 12mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1"
                  style="width: 263.8px;" role="group" aria-label="2 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//02.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Arrival</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 22mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 263.8px;"
                  role="group" aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Pricess</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 263.8px;"
                  role="group" aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Soull
                                Meate</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05.webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Dangacg</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
              </ul>
              <div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                aria-controls="swiper-wrapper-436cf0615ad7f2510"></div>
              <div class="swiper-button swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                aria-controls="swiper-wrapper-436cf0615ad7f2510"></div>
              <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="related-movie-block">
      <div class="container-fluid">
        <div class="overflow-hidden">
          <div class="d-flex align-items-center justify-content-between px-3 pt-2 my-4">
            <h5 class="main-title text-capitalize mb-0">Related Movies</h5>
          </div>
          <div class="card-style-slider">
            <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
              data-slide="5" data-laptop="5" data-tab="2" data-mobile="2" data-mobile-sm="2" data-autoplay="false"
              data-loop="true" data-navigation="true" data-pagination="true">
              <ul class="p-0 swiper-wrapper m-0  list-inline"
                style="transform: translate3d(-1319px, 0px, 0px); transition-duration: 0ms;"
                id="swiper-wrapper-cd49e1910c107225a" aria-live="polite">
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 263.8px;"
                  role="group" aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">We
                                Gare</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 263.8px;"
                  role="group" aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Avengers</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Chosfies</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="5" style="width: 263.8px;"
                  role="group" aria-label="6 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//06(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Tf
                                Oaler</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="6"
                  style="width: 263.8px;" role="group" aria-label="7 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//07(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Another
                                Danger</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active swiper-slide-active" data-swiper-slide-index="0"
                  style="width: 263.8px;" role="group" aria-label="1 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//01(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">giikre</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr :
                                12mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active swiper-slide-next" data-swiper-slide-index="1"
                  style="width: 263.8px;" role="group" aria-label="2 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//02(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">YoShi</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr :
                                22mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active" data-swiper-slide-index="2" style="width: 263.8px;" role="group"
                  aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">We
                                Gare</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active" data-swiper-slide-index="3" style="width: 263.8px;" role="group"
                  aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Avengers</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active last" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Chosfies</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide" data-swiper-slide-index="5" style="width: 263.8px;" role="group"
                  aria-label="6 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//06(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Tf
                                Oaler</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate-prev" data-swiper-slide-index="6" style="width: 263.8px;"
                  role="group" aria-label="7 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//07(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Another
                                Danger</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                  data-swiper-slide-index="0" style="width: 263.8px;" role="group" aria-label="1 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//01(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">giikre</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr :
                                12mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1"
                  style="width: 263.8px;" role="group" aria-label="2 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//02(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">YoShi</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr :
                                22mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 263.8px;"
                  role="group" aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">We
                                Gare</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 263.8px;"
                  role="group" aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Avengers</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Chosfies</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
              </ul>
              <div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                aria-controls="swiper-wrapper-cd49e1910c107225a"></div>
              <div class="swiper-button swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                aria-controls="swiper-wrapper-cd49e1910c107225a"></div>
              <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="video-block">
      <div class="container-fluid">
        <div class="overflow-hidden">
          <div class="d-flex align-items-center justify-content-between px-3 pt-2 my-4">
            <h5 class="main-title text-capitalize mb-0">Related Videos</h5>
          </div>
          <div class="card-style-slider">
            <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
              data-slide="5" data-laptop="5" data-tab="2" data-mobile="2" data-mobile-sm="2" data-autoplay="false"
              data-loop="true" data-navigation="true" data-pagination="true">
              <ul class="p-0 swiper-wrapper m-0  list-inline"
                style="transform: translate3d(-1319px, 0px, 0px); transition-duration: 0ms;"
                id="swiper-wrapper-1582a498cd5c6dcc" aria-live="polite">
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 263.8px;"
                  role="group" aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">We
                                Gare</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 263.8px;"
                  role="group" aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Avengers</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Chosfies</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="5" style="width: 263.8px;"
                  role="group" aria-label="6 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//06(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Tf
                                Oaler</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="6"
                  style="width: 263.8px;" role="group" aria-label="7 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//07(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Another
                                Danger</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active swiper-slide-active" data-swiper-slide-index="0"
                  style="width: 263.8px;" role="group" aria-label="1 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//01(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">giikre</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr :
                                12mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active swiper-slide-next" data-swiper-slide-index="1"
                  style="width: 263.8px;" role="group" aria-label="2 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//02(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">YoShi</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr :
                                22mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active" data-swiper-slide-index="2" style="width: 263.8px;" role="group"
                  aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">We
                                Gare</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active" data-swiper-slide-index="3" style="width: 263.8px;" role="group"
                  aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Avengers</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active last" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Chosfies</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide" data-swiper-slide-index="5" style="width: 263.8px;" role="group"
                  aria-label="6 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//06(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Tf
                                Oaler</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate-prev" data-swiper-slide-index="6" style="width: 263.8px;"
                  role="group" aria-label="7 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//07(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Another
                                Danger</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                  data-swiper-slide-index="0" style="width: 263.8px;" role="group" aria-label="1 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//01(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">giikre</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr :
                                12mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1"
                  style="width: 263.8px;" role="group" aria-label="2 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//02(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">YoShi</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr :
                                22mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 263.8px;"
                  role="group" aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">We
                                Gare</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 263.8px;"
                  role="group" aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Avengers</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05(1).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">Chosfies</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
              </ul>
              <div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                aria-controls="swiper-wrapper-1582a498cd5c6dcc"></div>
              <div class="swiper-button swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                aria-controls="swiper-wrapper-1582a498cd5c6dcc"></div>
              <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Upcoming Start -->
    <section class="upcomimg-block">
      <div class="container-fluid">
        <div class="overflow-hidden">
          <div class="d-flex align-items-center justify-content-between px-3 pt-2 my-4">
            <h5 class="main-title text-capitalize mb-0">Upcoming</h5>
          </div>
          <div class="card-style-slider">
            <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
              data-slide="5" data-laptop="5" data-tab="2" data-mobile="2" data-mobile-sm="2" data-autoplay="false"
              data-loop="true" data-navigation="true" data-pagination="true">
              <ul class="p-0 swiper-wrapper m-0  list-inline"
                style="transform: translate3d(-1319px, 0px, 0px); transition-duration: 0ms;"
                id="swiper-wrapper-25b1fd2a8e7435e0" aria-live="polite">
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 263.8px;"
                  role="group" aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">batter
                                caill</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 55mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 263.8px;"
                  role="group" aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">the
                                co nouerllng</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">fast
                                furious</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="5" style="width: 263.8px;"
                  role="group" aria-label="6 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//06(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">spiderman</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="6"
                  style="width: 263.8px;" role="group" aria-label="7 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//07(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">onepeoc</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active swiper-slide-active" data-swiper-slide-index="0"
                  style="width: 263.8px;" role="group" aria-label="1 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//01(3).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">dinoosaur</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 12mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active swiper-slide-next" data-swiper-slide-index="1"
                  style="width: 263.8px;" role="group" aria-label="2 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//02(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">godilla</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 22mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active" data-swiper-slide-index="2" style="width: 263.8px;" role="group"
                  aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">batter
                                caill</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 55mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active" data-swiper-slide-index="3" style="width: 263.8px;" role="group"
                  aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">the
                                co nouerllng</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-active last" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">fast
                                furious</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide" data-swiper-slide-index="5" style="width: 263.8px;" role="group"
                  aria-label="6 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//06(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">spiderman</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate-prev" data-swiper-slide-index="6" style="width: 263.8px;"
                  role="group" aria-label="7 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//07(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">onepeoc</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr
                                : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                  data-swiper-slide-index="0" style="width: 263.8px;" role="group" aria-label="1 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//01(3).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">dinoosaur</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 12mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1"
                  style="width: 263.8px;" role="group" aria-label="2 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//02(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a
                                href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">godilla</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr
                                : 22mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 263.8px;"
                  role="group" aria-label="3 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//03(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">batter
                                caill</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 55mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 263.8px;"
                  role="group" aria-label="4 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//04(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">the
                                co nouerllng</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">1hr : 30mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
                <li class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 263.8px;"
                  role="group" aria-label="5 / 7">
                  <div class="iq-card card-hover">
                    <div class="block-images position-relative w-100">
                      <div class="img-box w-100">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                          class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                        <img src="{{ asset('frontend/assets') }}/images//05(2).webp" alt="movie-card"
                          class="img-fluid object-cover w-100 d-block border-0">
                      </div>
                      <div class="card-description with-transition">
                        <div class="cart-content">
                          <div class="content-left">
                            <h5 class="iq-title text-capitalize">
                              <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html">fast
                                furious</a>
                            </h5>
                            <div class="movie-time d-flex align-items-center my-2">
                              <span class="movie-time-text font-normal">2hr : 45mins</span>
                            </div>
                          </div>
                          <div class="watchlist">
                            <a class="watch-list-not"
                              href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                              <span class="watchlist-label"> Watchlist </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="block-social-info align-items-center">
                        <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fas fa-share-alt"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>
                                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                  </a>
                                  <a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/restricted-content.html#">
                                    <i class="fas fa-link"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="share position-relative d-flex align-items-center text-center mb-0">
                            <span class="w-100 h-100 d-inline-block bg-transparent">
                              <i class="fa-regular fa-heart"></i>
                            </span>
                            <div class="share-wrapper">
                              <div class="share-boxs d-inline-block">
                                <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                    fill="#191919"></path>
                                </svg>
                                <div class=" overflow-hidden">
                                  <span>+51</span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="iq-button">
                          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                            class="btn text-uppercase position-relative rounded-circle">
                            <i class="fa-solid fa-play ms-0"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


                </li>
              </ul>
              <div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                aria-controls="swiper-wrapper-25b1fd2a8e7435e0"></div>
              <div class="swiper-button swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                aria-controls="swiper-wrapper-25b1fd2a8e7435e0"></div>
              <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Upcoming End -->

@endsection
