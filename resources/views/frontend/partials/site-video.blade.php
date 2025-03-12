<div class="iq-main-slider site-video mt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="pt-0">
            <div data-setup="{}" preload="auto"
              class="video-js vjs-big-play-centered w-100 vjs-paused vjs-controls-enabled vjs-workinghover vjs-v7 vjs-user-active my-video-dimensions"
                        poster="" id="my-video" tabindex="-1" role="region" lang="en" translate="no"
                        aria-label="Video Player">

                        @if (isset($movie) && $movie->video_url)
                            <video id="my-video_html5_api"
                                poster="{{ $movie->backdrop_url ?? 'https://i.ytimg.com/vi_webp/rKVEoyTedv4/maxresdefault.webp' }}"
                                class="vjs-tech" preload="auto" data-setup="{}" tabindex="-1" role="application">
                                @if (str_contains($movie->video_url, 'youtube.com'))
                                    <source src="{{ str_replace('watch?v=', 'embed/', $movie->video_url) }}"
                                        type="video/youtube">
                                @else
                                    <source src="{{ $movie->video_url }}" type="video/mp4">
                                @endif
              </video>
                        @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
