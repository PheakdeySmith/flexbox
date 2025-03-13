@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <h2 class="title">Genres</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Genres</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!--bread-crumb-->

    <section class="section-padding">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="main-title text-capitalize mb-0">Movie Genres</h4>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">

                @foreach ($genres as $genre)
                    <div class="col mb-4">
                        <div class="iq-card-geners card-hover-style-two">
                            <div class="block-images position-relative w-100">
                                <div class="img-box rounded position-relative">
                                    <img src="{{ asset('frontend/assets') }}/images/01.webp" alt="geners-img"
                                        class="img-fluid object-cover w-100 rounded">
                                    <div class="blog-description">
                                        <h6 class="mb-0 iq-title"><a
                                                href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html"
                                                class="text-decoration-none text-capitalize line-count-2 p-2">{{ $genre->name }}</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <div class="iq-button">
                    <a href="javascript:void(0)" class="btn text-uppercase position-relative">
                        <span class="button-text">load more</span>
                        <i class="fa-solid fa-play"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
