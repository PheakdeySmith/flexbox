<footer class="footer footer-default">
    <div class="container-fluid">
        <div class="footer-bottom border-top pt-4">
            <div class="row">

                <!-- App Download Column -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h6 class="font-size-14 pb-2">Download {{ \App\Models\Setting::get('site_name') ?? 'Streamit' }} Apps </h6>
                    <div class="d-flex align-items-center flex-wrap">
                        @if(\App\Models\Setting::get('google_play_link'))
                        <a class="app-image me-3 mb-2" href="{{ \App\Models\Setting::get('google_play_link') }}">
                            <img src="{{ asset('frontend/assets') }}/images/google-play.webp" loading="lazy" alt="play-store">
                        </a>
                        @endif

                        @if(\App\Models\Setting::get('apple_store_link'))
                        <a class="app-image mb-2" href="{{ \App\Models\Setting::get('apple_store_link') }}">
                            <img src="{{ asset('frontend/assets') }}/images/apple.webp" loading="lazy" alt="app-store">
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Social Media Column -->
                <div class="col-lg-4 col-md-6 mb-4 text-lg-center">
                    <div class="social-media-links">
                        <h6 class="font-size-14 pb-2">Follow Us</h6>
                        <div class="d-flex align-items-center flex-wrap justify-content-lg-center">
                            @if(\App\Models\Setting::get('facebook_link'))
                            <a href="{{ \App\Models\Setting::get('facebook_link') }}" target="_blank" class="me-3 mb-2">
                                <i class="fab fa-facebook-f fa-lg"></i>
                            </a>
                            @endif

                            @if(\App\Models\Setting::get('twitter_link'))
                            <a href="{{ \App\Models\Setting::get('twitter_link') }}" target="_blank" class="me-3 mb-2">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            @endif

                            @if(\App\Models\Setting::get('instagram_link'))
                            <a href="{{ \App\Models\Setting::get('instagram_link') }}" target="_blank" class="me-3 mb-2">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                            @endif

                            @if(\App\Models\Setting::get('whatsapp_link'))
                            <a href="{{ \App\Models\Setting::get('whatsapp_link') }}" target="_blank" class="me-3 mb-2">
                                <i class="fab fa-whatsapp fa-lg"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Copyright Column -->
                <div class="col-lg-4 col-md-12 mb-4 text-lg-end">
                    <p class="font-size-14">
                        {!! \App\Models\Setting::get('copyright_text') ?? '© <span class="currentYear">2025</span> <span class="text-primary">STREAMIT</span>. All Rights Reserved. All videos and shows on this platform are trademarks of, and all related images and content are the property of, Streamit Inc. Duplication and copy of this is strictly prohibited.' !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="back-to-top" style="display: none;" class="animate__animated animate__fadeOut">
    <a class="p-0 btn bg-primary btn-sm position-fixed top border-0 rounded-circle text-white" id="top" href="">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
</div>
