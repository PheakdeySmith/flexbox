<div class="details-part">
    <div class="container-fluid">
        <div class="row">
            @if ($movie)
                <div class="col-lg-12">
                    <!-- Movie Description Start-->
                    <div class="trending-info mt-4 pt-0 pb-4">
                        <div class="row">
                            <div class="col-md-9 col-12 mb-auto">
                                <div class="d-block d-lg-flex align-items-center">
                                    <h2 class="trending-text fw-bold texture-text text-uppercase my-0 fadeInLeft animated d-inline-block"
                                        data-animation-in="fadeInLeft" data-delay-in="0.6"
                                        style="opacity: 1; animation-delay: 0.6s">
                                        {{ $movie->title }}
                                    </h2>
                                    <div class="slider-ratting d-flex align-items-center ms-lg-3 ms-0">
                                        <ul
                                            class="ratting-start p-0 m-0 list-inline text-warning d-flex align-items-center justify-content-left">
                                            @for ($i = 1; $i <= 10; $i++)
                                                @if ($movie->imdb_rating >= $i)
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <!-- Full Star -->
                                                @elseif ($movie->imdb_rating >= $i - 0.5)
                                                    <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                                                    <!-- Half Star -->
                                                @else
                                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                    <!-- Empty Star -->
                                                @endif
                                            @endfor
                                        </ul>
                                        <span class="text-white ms-2">{{ $movie->imdb_rating }} (IMDB)</span>

                                    </div>
                                </div>
                                <ul class="p-0 mt-2 list-inline d-flex flex-wrap movie-tag">
                                    @foreach ($movie->genres as $genre)
                                        <li class="trending-list"><a class="text-primary"
                                                href="{{ route('frontend.viewAll', ['section' => 'genre', 'genre_id' => $genre->id]) }}">{{ $genre->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="d-flex flex-wrap align-items-center text-white text-detail flex-wrap mb-4">
                                    {{-- <span class="badge bg-secondary">{{ $movie->genres->first()->name }}</span> --}}
                                    <span class="ms-3 font-Weight-500 genres-info me-1">Playtime: {{ $movie->duration }}
                                        mins, </span>
                                    <span class="trending-year trending-year-list font-Weight-500 genres-info">
                                        Release Date:
                                        {{ \Carbon\Carbon::parse($movie->release_date)->format('F j, Y') }}
                                    </span>
                                </div>
                                <form id="favorite-form-{{ $movie->id }}"
                                    action="{{ route('favorite.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                    <input type="hidden" name="source" value="frontend">
                                </form>
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-4">

<ul class="list-inline p-0 share-icons music-play-lists mb-n2  me-2">
                                        <form id="watchlist-form-{{ $movie->id }}"
                                            action="{{ route('watchlist.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                            <input type="hidden" name="source" value="frontend">
                                        </form>

                                        <li onclick="document.getElementById('watchlist-form-{{ $movie->id }}').submit()"
                                            class="watchlist-btn" data-bs-toggle="tooltip" title="Add to Watchlist">
                                            <span class="btn-inner">
                                                <i class="fa-solid fa-bookmark"></i>
                                            </span>
                                        </li>


                                        <li onclick="document.getElementById('favorite-form-{{ $movie->id }}').submit()"
                                            class="watchlist-btn" data-bs-toggle="tooltip" title="Add to Favorite">
                                            <span class="btn-inner">
                                                <i class="fa-solid fa-heart"></i>
                                            </span>
                                        </li>

                                        <li onclick="openModal()" class="watchlist-btn" data-bs-toggle="modal"
                                            data-bs-target="#showPlaylist" title="Add to Playlist">
                                            <span class="btn-inner">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                        </li>

                                    </ul>

                                    @if (auth()->check())
                                        @php
                                            $user = auth()->user();
                                            $hasBoughtMovie = false;

                                            // Check if user has bought this movie
                                            if (isset($movie) && $movie) {
                                                $hasBoughtMovie = $user
                                                    ->orders()
                                                    ->whereHas('items', function ($query) use ($movie) {
                                                        $query->where('movie_id', $movie->id);
                                                    })
                                                    ->where('status', 'completed')
                                                    ->exists();
                                            }
                                        @endphp

@if (!$hasBoughtMovie && !$movie->is_free)
                                            <div class="iq-button">
                                                <a href="{{ route('frontend.addToCart', $movie->id) }}"
                                                    class="btn btn-sm" id="button-addon2">Add to Cart</a>
                                            </div>
                                        @elseif($hasBoughtMovie)
                                            <div class="iq-button">
                                                <span class="btn btn-sm btn-success disabled">
                                                    <i class="fa-solid fa-check me-1"></i> Purchased
                                                </span>
                                            </div>
                                        @elseif($movie->is_free)
                                            <div class="iq-button">
                                                <span class="btn btn-sm btn-info disabled">
                                                    <i class="fa-solid fa-gift me-1"></i> Free
                                                </span>
                                            </div>
                                        @endif
                                    @else
                                        @if (!$movie->is_free)
                                            <div class="iq-button">
                                                <a href="{{ route('frontend.addToCart', $movie->id) }}"
                                                    class="btn btn-sm" id="button-addon2">Add to Cart</a>
                                            </div>
                                        @else
                                            <div class="iq-button">
                                                <span class="btn btn-sm btn-info disabled">
                                                    <i class="fa-solid fa-gift me-1"></i> Free
                                                </span>
                                            </div>
                                        @endif
                                    @endif

</div>
                                <ul class="iq-blogtag list-unstyled d-flex flex-wrap align-items-center gap-3 p-0">
                                    <li class="iq-tag-title text-primary mb-0">
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        Genres:
                                    </li>
                                    @foreach ($movie->genres as $genre)
                                        <li>
                                            <a class="title"
                                                href="{{ route('frontend.viewAll', ['section' => 'genre', 'genre_id' => $genre->id]) }}">{{ $genre->name }}</a>
                                            <span class="text-secondary">,</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="trailor-video col-md-3 col-12 mt-lg-0 mt-4 mb-md-0 mb-1 text-lg-right">
                                <a data-fslightbox="html5-video" href="{{ $movie->trailer_url }}"
                                    class="video-open playbtn block-images position-relative playbtn_thumbnail">
                                    <img src="{{ $movie->backdrop_url }}"
                                        class="attachment-medium-large size-medium-large wp-post-image" alt=""
                                        loading="lazy">
                                    <span class="content btn btn-transparant iq-button">
                                        <i class="fa fa-play me-2 text-white"></i>
                                        <span>Trailer Link</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Movie Description End --> <!-- Movie Source Start -->
                    <div class="content-details trending-info">
                        <ul class="iq-custom-tab tab-bg-gredient-center d-flex nav nav-pills align-items-center text-center mb-5 justify-content-center list-inline"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link show active" data-bs-toggle="pill"
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html#description-01"
                                    role="tab" aria-selected="true">
                                    Description
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="pill"
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html#review-01"
                                    role="tab" aria-selected="false" tabindex="-1">
                                    Rate &amp; Review
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="description-01" class="tab-pane animated fadeInUp active show" role="tabpanel">
                                <div class="description-content">
                                    <p>
                                        {{ $movie->description }}
                                    </p>
                                </div>
                            </div>
                            <div id="review-01" class="tab-pane animated fadeInUp" role="tabpanel">
                                <div class="streamit-reviews">
                                    <div id="comments" class="comments-area validate-form">
                                        <p class="masvideos-noreviews mt-3">
                                            There are no reviews yet.
                                        </p>
                                    </div>
                                    <div class="review_form">
                                        <div class="comment-respond">
                                            <h3 class="fw-500 my-2">Be the first to review "{{ $movie->title }}"</h3>
                                            <p class="comment-notes"><span>Your email address will not be
                                                    published.</span>
                                                <span>Required fields are marked <span class="required">*</span></span>
                                            </p>

                                            <form action="{{ route('review.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="source" value="frontend">
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">

                                                <!-- Rating -->
                                                <div class="d-flex align-items-center mb-4">
                                                    <label>Your rating</label>
                                                    <div class="star-rating ms-4">
                                                        <input type="hidden" name="rating" id="selected-rating"
                                                            required>
                                                        <div class="stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="fa-regular fa-star star-item"
                                                                    data-rating="{{ $i }}"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Comment -->
                                                <div class="form-group">
                                                    <label class="mb-2">Your Comment <span
                                                            class="required">*</span></label>
                                                    <textarea class="form-control" name="comment" cols="5" rows="8" required></textarea>
                                                </div>

                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label class="mb-2">Name</label>
                                                    <input class="form-control" type="text"
                                                        value="{{ auth()->user()->name ?? '' }}" readonly>
                                                </div>

                                                <!-- Email -->
                                                <div class="form-group">
                                                    <label class="mb-2">Email <span
                                                            class="required">*</span></label>
                                                    <input class="form-control" type="email"
                                                        value="{{ auth()->user()->email ?? '' }}" readonly>
                                                </div>

                                                <!-- Hidden Fields -->
                                                <input type="hidden" name="contains_spoilers" value="0">
                                                <input type="hidden" name="is_approved" value="1">

                                                <div class="form-submit mt-4">
                                                    <button type="submit" class="btn btn-primary">Submit
                                                        Review</button>
                                                </div>
                                            </form>

                                            @if (session('error'))
                                                <div class="alert alert-danger">{{ session('error') }}</div>
                                            @endif

                                            @if (session('success'))
                                                <div class="alert alert-success">{{ session('success') }}</div>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Movie Source End -->
                </div>
            @else
                <p>Movie not found.</p>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="showPlaylist" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <div>
                    <h1 class="modal-title fs-5 fw-500" ;">
                        Choose a Playlist
                    </h1>
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" style="margin-right:300px;"
                    onclick="window.location.href='{{ route('frontend.watchlist') }}'">
                    <i class="fa-solid fa-plus me-1"></i>Create New Playlist
                </button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('frontend.playlistStore') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source" value="frontend">
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}"> <!-- Add this line -->
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="contains_spoilers" value="0">
                    <input type="hidden" name="is_approved" value="1">


                    <!-- Playlists with checkboxes -->
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="fw-bold mb-0">Select Playlists</label>
                        </div>
                        <div class="playlist-list">
                            @foreach ($playlists as $playlist)
                                @php
                                    $exists = DB::table('movie_playlist')
                                        ->where('movie_id', $movie->id)
                                        ->where('playlist_id', $playlist->id)
                                        ->exists();
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="playlists[]"
                                        value="{{ $playlist->id }}" id="playlist{{ $playlist->id }}"
                                        {{ $exists ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="playlist{{ $playlist->id }}">
                                        {{ $playlist->name }} {{ $exists ? '(Already added)' : '' }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center gap-3 mt-4">
                        <button type="button" class="btn btn-sm btn-light text-uppercase fw-medium"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary text-uppercase fw-medium">
                            Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<style>
    .star-rating {
        display: inline-block;
    }

    .star-rating .stars {
        display: flex;
        flex-direction: row;
    }

    .star-rating .star-item {
        font-size: 24px;
        color: #ddd;
        cursor: pointer;
        margin: 0 2px;
        transition: color 0.2s;
    }

    .star-rating .star-item:hover,
    .star-rating .star-item.active {
        color: #ffc107;
    }

    /* This ensures only stars up to the hovered one are highlighted */
    .star-rating .star-item.hover~.star-item {
        color: #ddd;
    }

    .watchlist-btn.active {
        background-color: #007bff;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star-item');
        const ratingInput = document.getElementById('selected-rating');

        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                let rating = this.getAttribute('data-rating');
                stars.forEach(s => s.style.color = s.getAttribute('data-rating') <= rating ?
                    '#ffc107' : '#ddd');
            });

            star.addEventListener('click', function() {
                let rating = this.getAttribute('data-rating');
                ratingInput.value = rating;

                stars.forEach(s => {
                    s.classList.remove('fa-regular', 'fa-solid');
                    s.classList.add(s.getAttribute('data-rating') <= rating ?
                        'fa-solid' : 'fa-regular');
                });
            });
        });

        document.querySelector('.stars').addEventListener('mouseleave', function() {
            let selected = ratingInput.value;
            stars.forEach(star => star.style.color = star.getAttribute('data-rating') <= selected ?
                '#ffc107' : '#ddd');
        });
    });
</script>
