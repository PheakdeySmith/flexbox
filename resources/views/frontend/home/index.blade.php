@extends('frontend.layouts.app')

@section('content')
    @include('frontend.partials.slider')

    {{-- @include('frontend.partials.continue-watching') --}}

    @include('frontend.partials.top-ten-block')

    @include('frontend.partials.verticle-slider')

    @include('frontend.partials.popular-movies-block')

    @include('frontend.partials.favourite-person-block')

    @include('frontend.partials.movie-geners-block')

    @include('frontend.partials.recommended-block')

    <!-- Latest Movies Section -->
    <div class="latest-movies-block">
        <div class="container-fluid">
            <section class="overflow-hidden">
                <div class="d-flex align-items-center justify-content-between px-md-3 px-1 my-4">
                    <h5 class="main-title text-capitalize mb-0">latest movies</h5>
                    <a href="{{ route('frontend.viewAll', ['section' => 'latest']) }}"
                        class="text-primary iq-view-all text-decoration-none flex-none">View All</a>
                </div>
                <div class="card-style-slider">
                    <div class="position-relative swiper swiper-card" data-slide="6" data-laptop="6" data-tab="3"
                        data-mobile="2" data-mobile-sm="2" data-autoplay="false" data-loop="true" data-navigation="true"
                        data-pagination="true">
                        <ul class="p-0 swiper-wrapper m-0 list-inline">
                            @foreach ($latestMovies as $index => $movie)
                                <li class="swiper-slide">
                                    <div class="iq-card card-hover">
                                        <div class="block-images position-relative w-100">
                                            <div class="img-box w-100">
                                                <a href="{{ route('frontend.detail', $movie->id) }}"
                                                    class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}"
                                                    class="img-fluid object-cover w-100 d-block border-0">
                                            </div>
                                            <div class="card-description with-transition">
                                                <div class="cart-content">
                                                    <div class="content-left w-100">
                                                        <h5 class="iq-title text-capitalize">
                                                            <a
                                                                href="{{ route('frontend.detail', $movie->id) }}">{{ $movie->title }}</a>
                                                        </h5>
                                                        <div class="d-flex align-items-center justify-content-between my-2">
                                                            <div class="movie-time">
                                                                <span
                                                                    class="movie-time-text font-normal">{{ $movie->duration }}mm</span>
                                                            </div>
                                                            @if (auth()->check())
                                                                <div class="watchlist border-0 bg-transparent">
                                                                    <form action="{{ route('watchlist.store') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="user_id"
                                                                            value="{{ auth()->id() }}">
                                                                        <input type="hidden" name="movie_id"
                                                                            value="{{ $movie->id }}">
                                                                        <input type="hidden" name="source"
                                                                            value="frontend">
                                                                        <button type="submit"
                                                                            class="watch-list-not border-0 bg-transparent">
                                                                            <svg width="10" height="10"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon-10">
                                                                                <path d="M12 4V20M20 12H4"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            <span class="watchlist-label"> Watchlist </span>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block-social-info align-items-center">
                                                <div class="iq-button">
                                                    <a href="{{ route('frontend.detail', $movie->id) }}"
                                                        class="btn text-uppercase position-relative rounded-circle">
                                                        <i class="fa-solid fa-play ms-0"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="swiper-button swiper-button-next"></div>
                        <div class="swiper-button swiper-button-prev"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Free Movies Section -->
    <div class="free-movies-block">
        <div class="container-fluid">
            <section class="overflow-hidden">
                <div class="d-flex align-items-center justify-content-between px-md-3 px-1 my-4">
                    <h5 class="main-title text-capitalize mb-0">free movies</h5>
                    <a href="{{ route('frontend.viewAll', ['section' => 'free']) }}"
                        class="text-primary iq-view-all text-decoration-none flex-none">View All</a>
                </div>
                <div class="card-style-slider">
                    <div class="position-relative swiper swiper-card" data-slide="6" data-laptop="6" data-tab="3"
                        data-mobile="2" data-mobile-sm="2" data-autoplay="false" data-loop="false" data-navigation="true"
                        data-pagination="true">
                        <ul class="p-0 swiper-wrapper m-0 list-inline">
                            @foreach ($specials as $index => $movie)
                                <li class="swiper-slide">
                                    <div class="iq-card card-hover">
                                        <div class="block-images position-relative w-100">
                                            <div class="img-box w-100">
                                                <a href="{{ route('frontend.detail', $movie->id) }}"
                                                    class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}"
                                                    class="img-fluid object-cover w-100 d-block border-0">
                                            </div>
                                            <div class="card-description with-transition">
                                                <div class="cart-content">
                                                    <div class="content-left w-100">
                                                        <h5 class="iq-title text-capitalize">
                                                            <a
                                                                href="{{ route('frontend.detail', $movie->id) }}">{{ $movie->title }}</a>
                                                        </h5>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between my-2">
                                                            <div class="movie-time">
                                                                <span
                                                                    class="movie-time-text font-normal">{{ $movie->duration }}mm</span>
                                                            </div>
                                                            @if (auth()->check())
                                                                <div class="watchlist">
                                                                    <form action="{{ route('watchlist.store') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="user_id"
                                                                            value="{{ auth()->id() }}">
                                                                        <input type="hidden" name="movie_id"
                                                                            value="{{ $movie->id }}">
                                                                        <input type="hidden" name="source"
                                                                            value="frontend">
                                                                        <button type="submit"
                                                                            class="watch-list-not border-0 bg-transparent">
                                                                            <svg width="10" height="10"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon-10">
                                                                                <path d="M12 4V20M20 12H4"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            <span class="watchlist-label"> Watchlist
                                                                            </span>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block-social-info align-items-center">
                                                <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                                                    {{-- @if (auth()->check())
                                                        <li class="share position-relative d-flex align-items-center text-center mb-0">
                                                            <span class="w-100 h-100 d-inline-block bg-transparent favorite-btn"
                                                                  data-movie-id="{{ $movie->id }}">
                                                                <i class="fa-regular fa-heart"></i>
                                                            </span>
                                                        </li>
                                                    @endif --}}

                                                    <a href="{{ route('favorite.store') }}"
                                                        class="btn btn-primary btn-sm favorite-btn"
                                                        data-movie-id="{{ $movie->id }}"
                                                        style="padding: 2px 7px; font-size: 12px; margin-left: 103px;">
                                                        <i class="fa-regular fa-heart"></i>
                                                    </a>

                                                </ul>

                                                <div class="iq-button">
                                                    <a href="{{ route('frontend.detail', $movie->id) }}"
                                                        class="btn text-uppercase position-relative rounded-circle">
                                                        <i class="fa-solid fa-play ms-0"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="swiper-button swiper-button-next"></div>
                        <div class="swiper-button swiper-button-prev"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- @include('frontend.partials.streamit-card') --}}

    {{-- @include('frontend.partials.streamit-block') --}}

    {{-- @include('frontend.partials.tab-slider') --}}

    {{-- @include('frontend.partials.top-pics-block') --}}
@endsection
