<div class="cast-tabs">
    <div class="container-fluid">
        <div class="content-details trending-info g-border iq-rtl-direction">
            <ul class="iq-custom-tab tab-bg-fill d-flex nav nav-pills mb-5 " role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active show" data-bs-toggle="pill"
                        href="#cast-1"
                        role="tab" aria-selected="true">Cast</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill"
                        href="#crew-1"
                        role="tab" aria-selected="false" tabindex="-1">Crew</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="cast-1" class="tab-pane animated fadeInUp active show" role="tabpanel">
                    <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
                        data-slide="5" data-laptop="5" data-tab="3" data-mobile="2" data-mobile-sm="1"
                        data-autoplay="false" data-loop="false" data-navigation="true" data-pagination="true">
                        <ul class="list-inline swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);"
                            id="swiper-wrapper-a6fb8fe7bdad1db4" aria-live="polite">
                            @foreach ($movie->actors as $actor)
                            <li class="swiper-slide swiper-slide-active" style="width: 263.8px;" role="group"
                                aria-label="1 / 2">
                                <div class="cast-images m-0 row align-items-center position-relative">
                                    <div class="col-4 img-box p-0">
                                        <img src="{{ $actor->profile_photo ? $actor->profile_photo : asset('frontend/assets/images/default-profile.png') }}" class="img-fluid"
                                            alt="image" loading="lazy">
                                    </div>
                                    <div class="col-8 block-description">
                                        <h6 class="iq-title">
                                            <a href="{{ route('frontend.actorDetail', ['id' => $actor->id]) }}"
                                                tabindex="0">{{ $actor->name }}</a>
                                        </h6>
                                        <div class="video-time d-flex align-items-center my-2">
                                            <small class="text-white">As {{ $actor->pivot->character }}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                </div>

                <div id="crew-1" class="tab-pane animated fadeInUp" role="tabpanel">
                    <div class="position-relative swiper swiper-card swiper-initialized swiper-horizontal swiper-pointer-events"
                        data-slide="5" data-laptop="5" data-tab="3" data-mobile="2" data-mobile-sm="2"
                        data-autoplay="false" data-loop="false" data-navigation="true" data-pagination="true">
                        <ul class="list-inline swiper-wrapper" id="swiper-wrapper-19f10557f27f10f1810"
                            aria-live="polite" style="transition-duration: 0ms;">
                            @foreach ($movie->directors as $director)
                            <li class="swiper-slide">
                                <div class="cast-images m-0 row align-items-center position-relative">
                                    <div class="col-4 img-box p-0">
                                        <img src="{{ $director->profile_photo ? $director->profile_photo : asset('frontend/assets/images/default-profile.png') }}" class="img-fluid"
                                            alt="image" loading="lazy">
                                    </div>
                                    <div class="col-8 block-description starring-desc ">
                                        <h6 class="iq-title">
                                            <a href="{{ route('frontend.directorDetail', ['id' => $director->id]) }}"
                                                tabindex="0">{{ $director->name }}</a>
                                        </h6>
                                        <div class="video-time d-flex align-items-center my-2">
                                            <small class="text-white">{{ $director->pivot->job }}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
