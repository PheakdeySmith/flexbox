<div class="movie-geners-block">
    <div class="container-fluid">
      <div class="overflow-hidden">
        <div class="d-flex align-items-center justify-content-between px-md-3 px-1 my-4">
          <h5 class="main-title text-capitalize mb-0">movie genres</h5>
          <a href="{{ route('frontend.viewAll', ['section' => 'all']) }}"
            class="text-primary iq-view-all text-decoration-none flex-none">View All</a>
        </div>
        <div class="card-style-slider">
          <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
            data-slide="6" data-laptop="6" data-tab="3" data-mobile="2" data-mobile-sm="2" data-autoplay="false"
            data-loop="true" data-navigation="true" data-pagination="true">
            <ul class="p-0 swiper-wrapper m-0 list-inline geners-card" id="swiper-wrapper-d6610ff48311eb81d"
              aria-live="polite">
              @foreach($genres as $index => $genre)
              <li class="swiper-slide {{ $index === 0 ? 'swiper-slide-active' : ($index === 1 ? 'swiper-slide-next' : 'swiper-active') }} {{ $index === count($genres) - 1 ? 'last' : '' }}"
                role="group" aria-label="{{ $index + 1 }} / {{ count($genres) }}"
                data-swiper-slide-index="{{ $index }}" style="width: 219.833px;">
                <div class="iq-card-geners card-hover-style-two">
                  <div class="block-images position-relative w-100">
                    <div class="img-box rounded position-relative">
                      <img src="{{ asset('frontend/assets') }}/images/genre.jpg" alt="{{ $genre->name }}"
                        class="img-fluid object-cover w-100 rounded">
                      <div class="blog-description">
                        <h6 class="mb-0 iq-title"><a
                            href="{{ route('frontend.viewAll', ['section' => 'genre', 'genre_id' => $genre->id]) }}"
                            class="text-decoration-none text-capitalize line-count-2 p-2">{{ $genre->name }}</a></h6>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
            <div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
              aria-controls="swiper-wrapper-d6610ff48311eb81d"></div>
            <div class="swiper-button swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
              aria-controls="swiper-wrapper-d6610ff48311eb81d"></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
