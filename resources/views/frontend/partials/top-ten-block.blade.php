<div class="top-ten-block">
    <div class="container-fluid">
      <section class="overflow-hidden">
        <div class="d-flex align-items-center justify-content-between px-md-3 px-1 mb-4">
          <h5 class="main-title text-capitalize mb-0">Top Ten Movies to Watch</h5>
          <a href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html"
            class="text-primary iq-view-all text-decoration-none flex-none">View All</a>
        </div>
        <div
          class="position-relative swiper swiper-card iq-top-ten-block-slider swiper-initialized swiper-horizontal swiper-pointer-events"
          data-slide="6" data-laptop="6" data-tab="3" data-mobile="2" data-mobile-sm="2" data-autoplay="false"
          data-loop="false" data-navigation="true" data-pagination="true">
          <ul class="p-0 swiper-wrapper mb-5 list-inline" id="swiper-wrapper-4cc5e57d51101016f4" aria-live="polite"
            style="transform: translate3d(0px, 0px, 0px);">
            @foreach($topTenMovies as $index => $movie)
              <li class="swiper-slide" role="group" aria-label="{{ $index + 1 }} / 10">
                <div class="iq-top-ten-block">
                  <div class="block-image position-relative">
                    <div class="img-box">
                      <a class="overly-images" href="{{ route('frontend.detail', $movie->id) }}">
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }} movie-card"
                          class="img-fluid object-cover">
                      </a>
                      <span class="top-ten-numbers texture-text">{{ $index + 1 }}</span>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
          <div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
            aria-controls="swiper-wrapper-4cc5e57d51101016f4" aria-disabled="false"></div>
          <div class="swiper-button swiper-button-prev swiper-button-disabled" tabindex="-1" role="button"
            aria-label="Previous slide" aria-controls="swiper-wrapper-4cc5e57d51101016f4" aria-disabled="true"></div>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
      </section>
    </div>
  </div>
