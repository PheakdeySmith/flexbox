<div class="favourite-person-block">
    <div class="container-fluid">
        <section class="overflow-hidden">
            <div class="d-flex align-items-center justify-content-between px-md-3 px-1 my-4">
                <h5 class="main-title text-capitalize mb-0">
                    @if(isset($director))
                        directors
                    @else
                        favourite person
                    @endif
                </h5>
                <a href="{{ isset($director) ? route('frontend.director') : route('frontend.actor') }}"
                    class="text-primary iq-view-all text-decoration-none">View All</a>
            </div>
            <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
                data-slide="11" data-laptop="11" data-tab="4" data-mobile="2" data-mobile-sm="2" data-autoplay="false"
                data-loop="true" data-navigation="true" data-pagination="true">
                <ul class="p-0 swiper-wrapper m-0  list-inline personality-card" id="swiper-wrapper-ab2e2fa1a69a5a08"
                    aria-live="polite" style="transform: translate3d(-1199.09px, 0px, 0px); transition-duration: 0ms;">

                    @foreach($actors as $person)
                    <li class="swiper-slide" role="group" aria-label="{{ $loop->iteration }} / {{ count($actors) }}"
                        data-swiper-slide-index="{{ $loop->index }}" style="width: 119.909px;">
                        <img src="{{ $person->profile_photo ? $person->profile_photo : asset('frontend/assets/images/default-profile.png') }}" alt="{{ $person->name }}"
                            class="img-fluid object-cover mb-4 rounded">
                        <div class="text-center">
                            <h6 class="mb-0">
                                <a href="{{ isset($director) ? route('frontend.directorDetail', ['id' => $person->id]) : route('frontend.actorDetail', ['id' => $person->id]) }}"
                                    class="font-size-14 text-decoration-none cast-title text-capitalize">{{ $person->name }}</a>
                            </h6>
                            <a href="#"
                                class="font-size-14 text-decoration-none text-capitalize text-body">
                                {{ isset($director) ? 'director' : 'actor' }}
                            </a>
                        </div>
                    </li>
                    @endforeach

                </ul>
                <div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                    aria-controls="swiper-wrapper-ab2e2fa1a69a5a08"></div>
                <div class="swiper-button swiper-button-prev" tabindex="0" role="button"
                    aria-label="Previous slide" aria-controls="swiper-wrapper-ab2e2fa1a69a5a08"></div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </section>
    </div>
</div>
