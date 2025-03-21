<div class="related-block">
    <div class="container-fluid">
        <section class="overflow-hidden">
            <div class="d-flex align-items-center justify-content-between px-md-3 px-1 my-4">
                <h5 class="main-title text-capitalize mb-0">related for you</h5>
                <a href="{{ route('frontend.viewAll', ['section' => 'related']) }}"
                    class="text-primary iq-view-all text-decoration-none flex-none">View All</a>
            </div>
            <div class="card-style-slider">
                <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
                    data-slide="6" data-laptop="6" data-tab="3" data-mobile="2" data-mobile-sm="2"
                    data-autoplay="false" data-loop="true" data-navigation="true" data-pagination="true">
                    <ul class="p-0 swiper-wrapper m-0  list-inline" id="swiper-wrapper-9f79b2221fd162ef"
                        aria-live="polite" style="transform: translate3d(-1319px, 0px, 0px); transition-duration: 0ms;">
                        @foreach ($relatedMovies as $index => $movie)
                            <li class="swiper-slide {{ $index === 0 ? 'swiper-slide-active' : ($index === 1 ? 'swiper-slide-next' : 'swiper-active') }} {{ $index === count($relatedMovies) - 1 ? 'last' : '' }}"
                                role="group" aria-label="{{ $index + 1 }} / {{ count($relatedMovies) }}"
                                data-swiper-slide-index="{{ $index }}" style="width: 219.833px;">
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
                                                        <a href="">{{ $movie->title }}</a>
                                                    </h5>
                                                    <div class="d-flex align-items-center justify-content-between my-2">
                                                        <div class="movie-time">
                                                            <span
                                                                class="movie-time-text font-normal">{{ $movie->duration }}mins</span>
                                                        </div>
                                                        <div class="watchlist border-0 bg-transparent">
                                                            <form action="{{ route('watchlist.store') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ auth()->id() }}">
                                                                <input type="hidden" name="movie_id"
                                                                    value="{{ $movie->id }}">
                                                                <input type="hidden" name="source" value="frontend">
                                                                <button type="submit"
                                                                    class="watch-list-not border-0 bg-transparent">
                                                                    <svg width="10" height="10"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon-10">
                                                                        <path d="M12 4V20M20 12H4" stroke="currentColor"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </svg>
                                                                    <span class="watchlist-label"> Watchlist </span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="block-social-info align-items-center">
                                            <ul class="p-0 m-0 d-flex gap-2 music-play-lists">


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
                    <div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                        aria-controls="swiper-wrapper-9f79b2221fd162ef"></div>
                    <div class="swiper-button swiper-button-prev" tabindex="0" role="button"
                        aria-label="Previous slide" aria-controls="swiper-wrapper-9f79b2221fd162ef"></div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </section>
    </div>
</div>
