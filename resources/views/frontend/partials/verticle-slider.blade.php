<div class="verticle-slider section-padding-bottom">
    <div class="slider">
        <div class="slider-flex position-relative">
            <div class="slider--col position-relative">
                <div class="vertical-slider-prev swiper-button" tabindex="0" role="button" aria-label="Previous slide"
                    aria-controls="swiper-wrapper-664bf5fbdbd103c8d"><i class="iconly-Arrow-Up-2 icli"></i></div>
                <div class="slider-thumbs" data-swiper="slider-thumbs">
                    <div class="swiper-container swiper-initialized swiper-vertical swiper-pointer-events"
                        data-swiper="slider-thumbs-inner">
                        <div class="swiper-wrapper top-ten-slider-nav" id="swiper-wrapper-664bf5fbdbd103c8d"
                            aria-live="polite"
                            style="transform: translate3d(0px, -1106.67px, 0px); transition-duration: 0ms;">

                            @foreach($verticalSliderMovies as $key => $movie)
                                @php
                                    $classes = 'swiper-slide swiper-bg';
                                    if($key == 0) {
                                        $classes .= ' swiper-slide-active';
                                    } elseif($key == 1) {
                                        $classes .= ' swiper-slide-next';
                                    } elseif($key == 4) {
                                        $classes .= ' swiper-slide-duplicate-prev';
                                    }
                                @endphp
                                <div class="{{ $classes }}" role="group" aria-label="{{ $key + 1 }} / 5"
                                    data-swiper-slide-index="{{ $key }}" style="height: 197.333px; margin-bottom: 24px;">
                                <div class="block-images position-relative">
                                    <div class="img-box slider--image">
                                            <img src="{{ asset($movie->backdrop_url) }}" class="img-fluid"
                                                alt="{{ $movie->title }}" loading="lazy">
                                    </div>
                                    <div class="block-description">
                                        <h6 class="iq-title"><a href="{{ route('frontend.detail', $movie->id) }}">{{ $movie->title }}</a>
                                        </h6>
                                        <div class="movie-time d-flex align-items-center my-2">
                                                <span class="text-body">{{ $movie->duration }} mins</span>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                </div>
                <div class="vertical-slider-next swiper-button" tabindex="0" role="button"
                    aria-label="Next slide" aria-controls="swiper-wrapper-664bf5fbdbd103c8d"><i
                        class="iconly-Arrow-Down-2 icli"></i></div>
            </div>
            <div class="slider-images" data-swiper="slider-images">
                <div class="swiper-container swiper-fade swiper-initialized swiper-vertical swiper-pointer-events"
                    data-swiper="slider-images-inner">
                    <div class="swiper-wrapper " id="swiper-wrapper-7410f68bf3435342a" aria-live="polite"
                        style="transition-duration: 0ms;">

                    @php
                        $transformValues = [
                            0 => 'height: 770px; opacity: 1; transform: translate3d(0px, -3850px, 0px); transition-duration: 0ms;',
                            1 => 'height: 770px; opacity: 0; transform: translate3d(0px, -4620px, 0px); transition-duration: 0ms;',
                            2 => 'height: 770px; opacity: 0; transform: translate3d(0px, -5390px, 0px); transition-duration: 0ms;',
                            3 => 'height: 770px; opacity: 0; transform: translate3d(0px, -6160px, 0px); transition-duration: 0ms;',
                            4 => 'height: 770px; opacity: 0; transform: translate3d(0px, -6930px, 0px); transition-duration: 0ms;'
                        ];
                    @endphp

                    @foreach($verticalSliderMovies as $key => $movie)
                        @php
                            $classes = 'swiper-slide';
                            if($key == 0) {
                                $classes .= ' swiper-slide-visible swiper-slide-active';
                            } elseif($key == 1) {
                                $classes .= ' swiper-slide-next';
                            } elseif($key == 4) {
                                $classes .= ' swiper-slide-duplicate-prev';
                            }
                            $style = $transformValues[$key];
                        @endphp
                        <div class="{{ $classes }}" role="group" aria-label="{{ $key + 1 }} / 5"
                            data-swiper-slide-index="{{ $key }}" style="{{ $style }}">
                            <div class="slider--image block-images"><img
                                    src="{{ asset($movie->backdrop_url) }}" loading="lazy"
                                    alt="{{ $movie->title }}"></div>
                            <div class="description">
                                <div class="block-description">
                                    <ul
                                        class="ps-0 mb-0 mb-1 pb-1 list-inline d-flex flex-wrap align-items-center movie-tag">
                                        @if(isset($movie->genres))
                                            @foreach($movie->genres as $genre)
                                        <li class="position-relative text-capitalize font-size-14 letter-spacing-1">
                                                <a href="{{ route('frontend.viewAll', ['section' => 'genre', 'genre_id' => $genre->id]) }}"
                                                    class="text-white text-decoration-none">{{ $genre->name }}</a>
                                        </li>
                                            @endforeach
                                        @else
                                        <li class="position-relative text-capitalize font-size-14 letter-spacing-1">
                                                <a href="#" class="text-white text-decoration-none">Movie</a>
                                        </li>
                                        @endif
                                    </ul>
                                    <h2 class="iq-title mb-3"><a
                                            href="{{ route('frontend.detail', $movie->id) }}">{{ $movie->title }}</a></h2>
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="slider-ratting d-flex align-items-center">
                                            <ul
                                                class="ratting-start p-0 m-0 list-inline text-warning d-flex align-items-center justify-content-left">
                                                <li>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </li>
                                            </ul>
                                            <span class="text-white ms-2 font-size-14 fw-500">{{ $movie->imdb_rating ?? '4.3' }}/10</span>
                                        </div>
                                        <span class="text-body">{{ $movie->duration }} mins</span>
                                    </div>
                                    <p class="mt-0 mb-3 line-count-2">{{ $movie->description ?? 'No description available' }}</p>
                                    <div class="iq-button">
                                        <a href="{{ route('frontend.detail', $movie->id) }}"
                                            class="btn text-uppercase position-relative">
                                            <span class="button-text">play now</span>
                                            <i class="fa-solid fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </div>
    </div>
</div>
