@if (auth()->check())
    @php
        $user = auth()->user();
        $hasBoughtMovie = false;
        $isSubscriber = false;

        // Check if user has bought this movie
        if (isset($movie) && $movie) {
            // Assuming you have a purchases or orders relationship on the User model
            // that can be used to check if the user has purchased this movie
            $hasBoughtMovie = $user->orders()
                ->whereHas('items', function($query) use ($movie) {
                    $query->where('movie_id', $movie->id);
                })
                ->where('status', 'completed')
                ->exists();
        }

        // Check if user has subscriber role using Spatie Roles
        $isSubscriber = $user->hasRole('subscriber');

        // User can watch if they bought the movie or have a subscriber role
        $canWatchMovie = $hasBoughtMovie || $isSubscriber;
    @endphp

    <div class="iq-main-slider site-video mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pt-0">
                        <div data-setup="{}" preload="auto"
                            class="video-js vjs-big-play-centered w-100 vjs-paused vjs-controls-enabled vjs-workinghover vjs-v7 vjs-user-active my-video-dimensions"
                            poster="" id="my-video" tabindex="-1" role="region" lang="en" translate="no"
                            aria-label="Video Player">

                            @if (isset($movie) && $movie->video_url && $canWatchMovie)
                                @if (str_contains($movie->video_url, 'youtube.com'))
                                    <div style="margin-top: 100px;">
                                        @php
                                            // Extract video ID from YouTube URL
                                            $videoId = '';
                                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $movie->video_url, $match)) {
                                                $videoId = $match[1];
                                            }
                                        @endphp

                                        @if($videoId)
                                            <iframe
                                                id="youtube-player"
                                                src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=0&rel=0"
                                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen
                                                onerror="handleYouTubeError()"
                                            ></iframe>

                                            <div id="youtube-fallback" class="iq-content_restriction" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                                <div class="iq-restriction_box">
                                                    <span class="subscribe-text">This video cannot be embedded due to YouTube restrictions.</span>
                                                    <div class="iq-button">
                                                        <a href="{{ $movie->video_url }}" target="_blank" class="btn text-uppercase position-relative">
                                                            <span class="button-text">Watch on YouTube</span>
                                                            <i class="fa-brands fa-youtube"></i>
                                                        </a>
                                                    </div>
                                                    <span class="mt-3">The video creator has disabled embedding on other websites.</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="iq-content_restriction">
                                                <div class="iq-restriction_box">
                                                    <span class="subscribe-text">Invalid YouTube URL format.</span>
                                                    <div class="iq-button">
                                                        <a href="{{ $movie->video_url }}" target="_blank" class="btn text-uppercase position-relative">
                                                            <span class="button-text">Try Opening Link</span>
                                                            <i class="fa-solid fa-external-link"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div style="margin-top: 100px;">
                                        <video id="my-video_html5_api"
                                            poster="{{ $movie->backdrop_url ?? 'https://i.ytimg.com/vi_webp/rKVEoyTedv4/maxresdefault.webp' }}"
                                            class="vjs-tech" preload="auto" data-setup="{}" tabindex="-1" role="application">
                                            <source src="{{ $movie->video_url }}" type="video/mp4">
                                        </video>
                                    </div>
                                @endif
                            @elseif (isset($movie) && !$movie->video_url && $canWatchMovie)
                                <div class="iq-content_restriction">
                                    <div class="iq-restriction_box">
                                        <span class="subscribe-text">This movie hasn't been added yet.</span>
                                        <div class="iq-button">
                                            <a href="{{ route('frontend.movie') }}" class="btn text-uppercase position-relative">
                                                <span class="button-text">Browse Other Movies</span>
                                                <i class="fa-solid fa-film"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @elseif (isset($movie) && !$canWatchMovie)
                                <div class="iq-content_restriction">
                                    <div class="iq-restriction_box">
                                        <span class="subscribe-text">You need to subscribe or purchase this movie to watch it.</span>
                                        <div class="iq-button">
                                            <a href="{{ route('frontend.subscription') }}" class="btn text-uppercase position-relative">
                                                <span class="button-text">Subscribe Now</span>
                                                <i class="fa-solid fa-crown"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="iq-main-slider site-video">
        <div class="container-fluid">
            <div class="iq-content_restriction">
                <div class="iq-restriction_box">
                    <span class="subscribe-text">You must be logged in to view this content.</span>
                    <div class="iq-button">
                        <a href="{{ route('frontend.subscription') }}" class="btn text-uppercase position-relative">
                            <span class="button-text">Subscribe To Watch</span>
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                    <span> Already a Member?</span>
                    <div class="iq-button">
                        <a href="{{ route('frontend.login') }}" class="btn text-uppercase position-relative">
                            <span class="button-text">Log in</span>
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
function handleYouTubeError() {
    document.getElementById('youtube-player').style.display = 'none';
    document.getElementById('youtube-fallback').style.display = 'block';
}

// Also check for YouTube embedding errors
document.addEventListener('DOMContentLoaded', function() {
    const iframe = document.getElementById('youtube-player');
    if (iframe) {
        // Check if iframe loaded correctly
        iframe.addEventListener('error', handleYouTubeError);

        // Additional check for YouTube embedding errors
        setTimeout(function() {
            try {
                // If YouTube player is in error state, show fallback
                if (iframe.contentWindow.document.body.innerHTML.includes('unavailable')) {
                    handleYouTubeError();
                }
            } catch (e) {
                // Cross-origin error might occur, which actually indicates the iframe loaded
                // This is normal and we can ignore it
            }
        }, 2000);
    }
});
</script>
