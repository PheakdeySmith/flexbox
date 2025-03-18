<footer class="footer footer-default">
    <div class="container-fluid">
        <div class="footer-bottom border-top">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="font-size-14">
                        {!! \App\Models\Setting::get('copyright_text') ?? '© <span class="currentYear">2025</span> <span class="text-primary">STREAMIT</span>. All Rights Reserved. All videos and shows on this platform are trademarks of, and all related images and content are the property of, Streamit Inc. Duplication and copy of this is strictly prohibited.' !!}
                    </p>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <h6 class="font-size-14 pb-1">Download {{ \App\Models\Setting::get('site_name') ?? 'Streamit' }} Apps </h6>
                    <div class="d-flex align-items-center">
                        @if(\App\Models\Setting::get('google_play_link'))
                        <a class="app-image" href="{{ \App\Models\Setting::get('google_play_link') }}">
                            <img src="{{ asset('frontend/assets') }}/images/google-play.webp" loading="lazy" alt="play-store">
                        </a>
                        @endif

                        @if(\App\Models\Setting::get('apple_store_link'))
                        <a class="ms-3 app-image" href="{{ \App\Models\Setting::get('apple_store_link') }}">
                            <img src="{{ asset('frontend/assets') }}/images/apple.webp" loading="lazy" alt="app-store">
                        </a>
                        @endif
                    </div>
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
