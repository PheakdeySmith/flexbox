@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <h2 class="title">View All</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">View All</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!--bread-crumb-->

    <div class="section-padding">
        <div class="container-fluid">
            <div class="card-style-grid">
                <div class="row row-cols-xl-4 row-cols-md-2 row-cols-1">

                    <div class="col mb-4">
                        <div class="iq-card card-hover">
                            <div class="block-images position-relative w-100">
                                <div class="img-box w-100">
                                    <a href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html"
                                        class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                    <img src="{{ asset('frontend/assets') }}/images/01.webp" alt="movie-card"
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
                                                <span class="movie-time-text font-normal">2hr : 12mins</span>
                                            </div>
                                        </div>
                                        <div class="watchlist">
                                            <a class="watch-list-not"
                                                href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">
                                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                                    <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
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
                                                    <svg width="15" height="40" class="share-shape"
                                                        viewBox="0 0 15 40" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z"
                                                            fill="#191919"></path>
                                                    </svg>
                                                    <div class=" overflow-hidden">
                                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html"
                                                            target="_blank">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html"
                                                            target="_blank">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                        <a
                                                            href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html#">
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
                                                    <svg width="15" height="40" class="share-shape"
                                                        viewBox="0 0 15 40" fill="none"
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
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
