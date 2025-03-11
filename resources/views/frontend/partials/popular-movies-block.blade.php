<div class="popular-movies-block">
    <div class="container-fluid">
        <section class="overflow-hidden">
            <div class="d-flex align-items-center justify-content-between px-md-3 px-1 my-4">
                <h5 class="main-title text-capitalize mb-0">popular movies</h5>
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html"
                    class="text-primary iq-view-all text-decoration-none flex-none">View All</a>
            </div>
            <div class="card-style-slider">
                <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
                    data-slide="6" data-laptop="6" data-tab="3" data-mobile="2" data-mobile-sm="2"
                    data-autoplay="false" data-loop="true" data-navigation="true" data-pagination="true">
                    <ul class="p-0 swiper-wrapper m-0 list-inline" id="swiper-wrapper-eb416d19d3bf1134" aria-live="polite">
                        @foreach ($popularMovies as $index => $movie)
                            <li class="swiper-slide {{ $index === 0 ? 'swiper-slide-active' : ($index === 1 ? 'swiper-slide-next' : 'swiper-active') }} {{ $index === count($popularMovies) - 1 ? 'last' : '' }}"
                                role="group" aria-label="{{ $index + 1 }} / {{ count($popularMovies) }}"
                                data-swiper-slide-index="{{ $index }}" style="width: 219.833px;">
                                <div class="iq-card card-hover">
                                    <div class="block-images position-relative w-100">
                                        <div class="img-box w-100">
                                            <a href=""
                                                class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                            <img src="{{ $movie->poster_url }}"
                                                alt="{{ $movie->title }}"
                                                class="img-fluid object-cover w-100 d-block border-0">
                                        </div>
                                        <div class="card-description with-transition">
                                            <div class="cart-content">
                                                <div class="content-left w-100">
                                                    <h5 class="iq-title text-capitalize">
                                                        <a href="">{{ $movie->title }}</a>
                                                    </h5>
                                                    <div class="d-flex align-items-center justify-content-between my-2">
                                                        <div class="movie-time">
                                                            <span class="movie-time-text font-normal">{{ $movie->duration }}mm</span>
                                                        </div>
                                                        <div class="watchlist">
                                                            <a class="watch-list-not" href="{{ route('frontend.watchlist') }}">
                                                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-10">
                                                                    <path d="M12 4V20M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                </svg>
                                                                <span class="watchlist-label"> Watchlist </span>
                                                            </a>
                                                        </div>
                                                    </div>
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
                                                            <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z" fill="#191919"></path>
                                                            </svg>
                                                            <div class=" overflow-hidden">
                                                                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                                                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                                                <a href="#"><i class="fas fa-link"></i></a>
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
                                                            <svg width="15" height="40" class="share-shape" viewBox="0 0 15 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.8842 40C6.82983 37.2868 1 29.3582 1 20C1 10.6418 6.82983 2.71323 14.8842 0H0V40H14.8842Z" fill="#191919"></path>
                                                            </svg>
                                                            <div class=" overflow-hidden"><span>+51</span></div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="iq-button">
                                                <a href=""
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
                    <div class="swiper-button swiper-button-next" tabindex="0" role="button"
                        aria-label="Next slide" aria-controls="swiper-wrapper-eb416d19d3bf1134"></div>
                    <div class="swiper-button swiper-button-prev" tabindex="0" role="button"
                        aria-label="Previous slide" aria-controls="swiper-wrapper-eb416d19d3bf1134"></div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </section>
    </div>
</div>
