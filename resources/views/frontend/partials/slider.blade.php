<div class="iq-banner-thumb-slider">
    <div class="slider">
      <div class="position-relative slider-bg d-flex justify-content-end">
        <div class="position-relative my-auto">
          <div class="horizontal_thumb_slider" data-swiper="slider-thumbs-ott">
            <div class="banner-thumb-slider-nav">
              <div class="swiper-container swiper-initialized swiper-horizontal swiper-pointer-events"
                data-swiper="slider-thumbs-inner-ott">
                <div class="swiper-wrapper" id="swiper-wrapper-84a9673280ac3e15" aria-live="off"
                  style="transform: translate3d(-1492.5px, 0px, 0px); transition-duration: 300ms;">

                  @foreach($sliderMovies as $index => $movie)
                  <div class="swiper-slide swiper-bg {{ $index == 0 ? 'swiper-slide-duplicate-next' : ($index == 1 ? 'swiper-slide-prev' : 'swiper-slide-active') }}"
                    role="group" aria-label="{{ $index + 1 }} / {{ count($sliderMovies) }}"
                    data-swiper-slide-index="{{ $index }}" style="width: 274.5px; margin-right: 24px;">
                    <div class="block-images position-relative ">
                      <div class="img-box">
                        <img src="{{ $movie->poster_url }}" class="img-fluid" alt="{{ $movie->title }}"
                          loading="lazy">
                        <div class="block-description">
                          <h6 class="iq-title fw-500 mb-0">{{ $movie->title }}</h6>
                          <span class="fs-12">{{ floor($movie->duration / 60) }}hr : {{ $movie->duration % 60 }}mins</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach

                  <!-- Duplicate slides for infinite loop effect -->
                  @foreach($sliderMovies as $index => $movie)
                  <div class="swiper-slide swiper-bg swiper-slide-duplicate"
                    role="group" aria-label="{{ $index + 1 }} / {{ count($sliderMovies) }}"
                    data-swiper-slide-index="{{ $index }}" style="width: 274.5px; margin-right: 24px;">
                    <div class="block-images position-relative ">
                      <div class="img-box">
                        <img src="{{ $movie->poster_url }}" class="img-fluid" alt="{{ $movie->title }}"
                          loading="lazy">
                        <div class="block-description">
                          <h6 class="iq-title fw-500 mb-0">{{ $movie->title }}</h6>
                          <span class="fs-12">{{ floor($movie->duration / 60) }}hr : {{ $movie->duration % 60 }}mins</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach

                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
              </div>
              <div class="slider-prev swiper-button" tabindex="0" role="button" aria-label="Previous slide"
                aria-controls="swiper-wrapper-84a9673280ac3e15">
                <i class="iconly-Arrow-Left-2 icli"></i>
              </div>
              <div class="slider-next swiper-button" tabindex="0" role="button" aria-label="Next slide"
                aria-controls="swiper-wrapper-84a9673280ac3e15">
                <i class="iconly-Arrow-Right-2 icli"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="slider-images" data-swiper="slider-images-ott">
          <div class="swiper-container swiper-fade swiper-initialized swiper-horizontal swiper-pointer-events"
            data-swiper="slider-images-inner-ott">
            <div class="swiper-wrapper m-0" id="swiper-wrapper-6a430996634779c2" aria-live="polite"
              style="transition-duration: 300ms;">

              @foreach($sliderMovies as $index => $movie)
              <div class="swiper-slide p-0 {{ $index == 0 ? 'swiper-slide-duplicate-next' : ($index == 1 ? 'swiper-slide-prev' : 'swiper-slide-visible swiper-slide-active') }}"
                role="group" aria-label="{{ $index + 1 }} / {{ count($sliderMovies) }}"
                data-swiper-slide-index="{{ $index }}"
                style="width: 1519px; opacity: 1; transform: translate3d(-{{ $index * 1519 }}px, 0px, 0px); transition-duration: 300ms;">
                <div class="slider--image block-images">
                  <img src="{{ $movie->backdrop_url }}" loading="lazy" alt="{{ $movie->title }}">
                </div>
                <div class="description">
                  <div class="row align-items-center h-100">
                    <div class="col-lg-6 col-md-12">
                      <div class="slider-content">
                        <div class="d-flex align-items-center RightAnimate mb-3">
                          <span class="badge rounded-0 text-dark text-uppercase px-3 py-2 me-3 bg-white mr-3">{{ $movie->maturity_rating }}</span>
                          <ul class="p-0 mb-0 list-inline d-flex flex-wrap align-items-center movie-tag">
                            @foreach($movie->genres as $genre)
                            <li class="position-relative text-capitalize font-size-14 letter-spacing-1">
                              <a href="#" class="text-decoration-none">{{ $genre->name }}</a>
                            </li>
                            @endforeach
                          </ul>
                        </div>
                        <h1 class="texture-text big-font letter-spacing-1 line-count-1 text-capitalize RightAnimate-two">
                          {{ $movie->title }} </h1>
                        <p class="line-count-3 RightAnimate-two">{{ $movie->description }}</p>
                        <div class="d-flex flex-wrap align-items-center gap-3 RightAnimate-three">
                          <div class="slider-ratting d-flex align-items-center">
                            <ul
                              class="ratting-start p-0 m-0 list-inline text-warning d-flex align-items-center justify-content-left">
                              <li>
                                <i class="fa fa-star" aria-hidden="true"></i>
                              </li>
                            </ul>
                            <span class="text-white ms-2 font-size-14 fw-500">{{ $movie->imdb_rating }}/10</span>
                            <span class="ms-2">
                              <img src="{{ asset('frontend/assets') }}/images/imdb-logo.svg" alt="imdb logo"
                                class="img-fluid">
                            </span>
                          </div>
                          <span class="font-size-14 fw-500">{{ floor($movie->duration / 60) }}hr : {{ $movie->duration % 60 }}mins</span>
                          <div class="text-primary font-size-14 fw-500 text-capitalize">genres:
                            @foreach($movie->genres as $index => $genre)
                              <a href="#" class="text-decoration-none {{ $index > 0 ? 'ms-1' : '' }}">{{ $genre->name }}</a>{{ $index < count($movie->genres) - 1 ? ',' : '' }}
                            @endforeach
                          </div>
                          @if($movie->actors->count() > 0)
                          <div class="text-primary font-size-14 fw-500 text-capitalize">Starting:
                            @foreach($movie->actors->take(2) as $index => $actor)
                              <a href="#" class="text-decoration-none {{ $index > 0 ? 'ms-1' : '' }}">{{ $actor->name }}</a>{{ $index < min(1, $movie->actors->count() - 1) ? ',' : '' }}
                            @endforeach
                          </div>
                          @endif
                        </div>
                      </div>
                      <div class="RightAnimate-four">
                        <div class="iq-button">
                          <a href="{{ url('detail') }}" class="btn text-uppercase position-relative">
                            <span class="button-text">stream now</span>
                            <i class="fa-solid fa-play"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

              <!-- Duplicate slides for infinite loop effect -->
              @foreach($sliderMovies as $index => $movie)
              <div class="swiper-slide p-0 swiper-slide-duplicate"
                role="group" aria-label="{{ $index + 1 }} / {{ count($sliderMovies) }}"
                data-swiper-slide-index="{{ $index }}"
                style="width: 1519px; opacity: 0; transform: translate3d(-{{ ($index + count($sliderMovies)) * 1519 }}px, 0px, 0px); transition-duration: 300ms;">
                <div class="slider--image block-images">
                  <img src="{{ $movie->backdrop_url }}" loading="lazy" alt="{{ $movie->title }}">
                </div>
                <div class="description">
                  <div class="row align-items-center h-100">
                    <div class="col-lg-6 col-md-12">
                      <div class="slider-content">
                        <div class="d-flex align-items-center RightAnimate mb-3">
                          <span class="badge rounded-0 text-dark text-uppercase px-3 py-2 me-3 bg-white mr-3">{{ $movie->maturity_rating }}</span>
                          <ul class="p-0 mb-0 list-inline d-flex flex-wrap align-items-center movie-tag">
                            @foreach($movie->genres as $genre)
                            <li class="position-relative text-capitalize font-size-14 letter-spacing-1">
                              <a href="#" class="text-decoration-none">{{ $genre->name }}</a>
                            </li>
                            @endforeach
                          </ul>
                        </div>
                        <h1 class="texture-text big-font letter-spacing-1 line-count-1 text-capitalize RightAnimate-two">
                          {{ $movie->title }} </h1>
                        <p class="line-count-3 RightAnimate-two">{{ $movie->description }}</p>
                        <div class="d-flex flex-wrap align-items-center gap-3 RightAnimate-three">
                          <div class="slider-ratting d-flex align-items-center">
                            <ul
                              class="ratting-start p-0 m-0 list-inline text-warning d-flex align-items-center justify-content-left">
                              <li>
                                <i class="fa fa-star" aria-hidden="true"></i>
                              </li>
                            </ul>
                            <span class="text-white ms-2 font-size-14 fw-500">{{ $movie->imdb_rating }}/10</span>
                            <span class="ms-2">
                              <img src="{{ asset('frontend/assets') }}/images/imdb-logo.svg" alt="imdb logo"
                                class="img-fluid">
                            </span>
                          </div>
                          <span class="font-size-14 fw-500">{{ floor($movie->duration / 60) }}hr : {{ $movie->duration % 60 }}mins</span>
                          <div class="text-primary font-size-14 fw-500 text-capitalize">genres:
                            @foreach($movie->genres as $index => $genre)
                              <a href="#" class="text-decoration-none {{ $index > 0 ? 'ms-1' : '' }}">{{ $genre->name }}</a>{{ $index < count($movie->genres) - 1 ? ',' : '' }}
                            @endforeach
                          </div>
                          @if($movie->actors->count() > 0)
                          <div class="text-primary font-size-14 fw-500 text-capitalize">Starting:
                            @foreach($movie->actors->take(2) as $index => $actor)
                              <a href="#" class="text-decoration-none {{ $index > 0 ? 'ms-1' : '' }}">{{ $actor->name }}</a>{{ $index < min(1, $movie->actors->count() - 1) ? ',' : '' }}
                            @endforeach
                          </div>
                          @endif
                        </div>
                      </div>
                      <div class="RightAnimate-four">
                        <div class="iq-button">
                          <a href="{{ url('detail') }}" class="btn text-uppercase position-relative">
                            <span class="button-text">stream now</span>
                            <i class="fa-solid fa-play"></i>
                          </a>
                        </div>
                      </div>
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
