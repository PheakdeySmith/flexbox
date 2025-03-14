@extends('frontend.layouts.app')

@section('content')
    <div style="color: black;">.
        <section class="section-padding-bottom mt-5">
            <div class="profile-box">
                <div class="container-fluid">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="account-logo d-flex align-items-center position-relative">
                                <img src="{{ Auth::user()->user_profile ? asset(Auth::user()->user_profile) : asset('frontend/assets/images/default-profile.png') }}"
                                    class="img-fluid" alt="User Profile" loading="lazy">
                                {{-- <i class="fa-regular fa-pen-to-square"></i> --}}
                            </div>
                            <div>
                                <a href="{{ route('frontend.account') }}" class="text-white">
                                    <h6 class="font-size-18 text-capitalize text-white fw-500">
                                        {{ Auth::user()->name }} <!-- This will display the user's name -->
                                    </h6>
                                    <span class="font-size-14 text-white fw-500">
                                        {{ Auth::user()->email }} <!-- This will display the user's email -->
                                    </span>
                            </div>
                        </div>
                        <div class="iq-button">
                            <a href="https://templates.iqonic.design/streamit-dist/frontend/html/pricing-plan.html"
                                class="btn text-uppercase position-relative">
                                <span class="button-text">Subscription</span>
                                <i class="fa-solid fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs">
                <div class="container-fluid">
                    <div class="content-details iq-custom-tab-style-two">
                        <ul class="d-flex justify-content-center nav nav-pills tab-header" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link show" data-bs-toggle="pill"
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html#playlist"
                                    role="tab" aria-selected="false" tabindex="-1">Playlist</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="pill"
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html#watchlist"
                                    role="tab" aria-selected="false" tabindex="-1">Watchlist</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="pill"
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html#favorites"
                                    role="tab" aria-selected="true">Favorites</a>
                            </li>
                        </ul>
                        <div class="tab-content px-0">
                            <div id="playlist" class="tab-pane animated fadeInUp" role="tabpanel">
                                <div class="overflow-hidden">
                                    <div class="d-flex align-items-center justify-content-between my-4">
                                        <h5 class="main-title text-capitalize mb-0">
                                            My playlist
                                        </h5>
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                                        @foreach ($playlists as $playlist)
                                            <div class="col mb-4">
                                                <div class="watchlist-warpper card-hover-style-two">
                                                    <div class="block-images position-relative w-100">
                                                        <div class="img-box">
                                                            <a href="{{ route('frontend.playlistDetail', $playlist->id) }}"
                                                                class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                        </div>
                                                        <div class="card-description">
                                                            <h5 class="text-capitalize fw-500">
                                                                <a
                                                                    href="{{ route('frontend.playlistDetail', $playlist->id) }}">
                                                                    {{ $playlist->name ?? 'Unnamed Playlist' }}
                                                                </a>
                                                            </h5>
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="d-flex align-items-center gap-1 font-size-12">
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                    <span
                                                                        class="text-body fw-semibold text-capitalize">{{ $playlist->movies->count() }}
                                                                        Movies</span>
                                                                </div>
                                                                <div class="d-flex align-items-center gap-1 font-size-12">
                                                                    <i class="fa-regular fa-clock text-primary"></i>
                                                                    <span
                                                                        class="text-body fw-semibold text-capitalize">{{ $playlist->created_at->diffForHumans() }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="text-center">
                                        <div class="iq-button">
                                            <button type="button" class="btn text-uppercase position-relativ"
                                                data-bs-toggle="modal" data-bs-target="#addNewPlaylist">
                                                <span class="button-text">Create Playlist</span>
                                                <i class="fa-solid fa-play"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="watchlist" class="tab-pane animated fadeInUp" role="tabpanel">
                                <div class="overflow-hidden">
                                    <div class="d-flex align-items-center justify-content-between my-4">
                                        <h5 class="main-title text-capitalize mb-0">
                                            My watchlist
                                        </h5>
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                                        @foreach ($watchlists as $watchlist)
                                            <div class="col mb-4">
                                                <div class="watchlist-warpper card-hover-style-two">
                                                    <div class="block-images position-relative w-100">
                                                        <div class="img-box">
                                                            <a href="https://templates.iqonic.design/streamit-dist/frontend/html/watchlist-detail.html"
                                                                class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                            <img src="{{ $watchlist->movie->backdrop_url }}"
                                                                alt="movie-card"
                                                                class="img-fluid object-cover w-100 d-block border-0" />
                                                        </div>
                                                        <div class="card-description">
                                                            <h5 class="text-capitalize fw-500">
                                                                <a
                                                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">{{ $watchlist->movie->title }}</a>
                                                            </h5>
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="d-flex align-items-center gap-1 font-size-12">
                                                                    <i class="fa-solid fa-star text-primary"></i>
                                                                    <span
                                                                        class="text-body fw-semibold text-capitalize">{{ $watchlist->movie->imdb_rating }}</span>
                                                                </div>

                                                                <div class="d-flex align-items-center gap-1 font-size-12">
                                                                    <i class="fa-regular fa-clock text-primary"></i>
                                                                    <span
                                                                        class="text-body fw-semibold text-capitalize">{{ $watchlist->movie->duration }}</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div id="favorites" class="tab-pane animated fadeInUp active show" role="tabpanel">
                                <div class="overflow-hidden">
                                    <div class="d-flex align-items-center justify-content-between my-4">
                                        <h5 class="main-title text-capitalize mb-0">
                                            My favourite
                                        </h5>
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                                        <div class="col mb-4">
                                            <div class="watchlist-warpper card-hover-style-two">
                                                <div class="block-images position-relative w-100">
                                                    <div class="img-box">
                                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/watchlist-detail.html"
                                                            class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                        <img src="{{ asset('frontend/assets') }}/images/01.webp"
                                                            alt="movie-card"
                                                            class="img-fluid object-cover w-100 d-block border-0" />
                                                    </div>
                                                    <div class="card-description">
                                                        <h5 class="text-capitalize fw-500">
                                                            <a
                                                                href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">Play
                                                                List 1</a>
                                                        </h5>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-solid fa-earth-americas text-primary"></i>
                                                                <span
                                                                    class="text-body fw-semibold text-capitalize">Public</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-regular fa-eye text-primary"></i>
                                                                <span class="text-body fw-semibold text-capitalize">3
                                                                    Views</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="watchlist-warpper card-hover-style-two">
                                                <div class="block-images position-relative w-100">
                                                    <div class="img-box">
                                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/watchlist-detail.html"
                                                            class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                        <img src="{{ asset('frontend/assets') }}/images/02.webp"
                                                            alt="movie-card"
                                                            class="img-fluid object-cover w-100 d-block border-0" />
                                                    </div>
                                                    <div class="card-description">
                                                        <h5 class="text-capitalize fw-500">
                                                            <a
                                                                href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">Play
                                                                List 2</a>
                                                        </h5>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-solid fa-earth-americas text-primary"></i>
                                                                <span
                                                                    class="text-body fw-semibold text-capitalize">Private</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-regular fa-eye text-primary"></i>
                                                                <span class="text-body fw-semibold text-capitalize">1
                                                                    Views</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="watchlist-warpper card-hover-style-two">
                                                <div class="block-images position-relative w-100">
                                                    <div class="img-box">
                                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/watchlist-detail.html"
                                                            class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                        <img src="{{ asset('frontend/assets') }}/images/03.webp"
                                                            alt="movie-card"
                                                            class="img-fluid object-cover w-100 d-block border-0" />
                                                    </div>
                                                    <div class="card-description">
                                                        <h5 class="text-capitalize fw-500">
                                                            <a
                                                                href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">Play
                                                                List 3</a>
                                                        </h5>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-solid fa-earth-americas text-primary"></i>
                                                                <span
                                                                    class="text-body fw-semibold text-capitalize">Public</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-regular fa-eye text-primary"></i>
                                                                <span class="text-body fw-semibold text-capitalize">10
                                                                    Views</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="watchlist-warpper card-hover-style-two">
                                                <div class="block-images position-relative w-100">
                                                    <div class="img-box">
                                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/watchlist-detail.html"
                                                            class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                        <img src="{{ asset('frontend/assets') }}/images/04.webp"
                                                            alt="movie-card"
                                                            class="img-fluid object-cover w-100 d-block border-0" />
                                                    </div>
                                                    <div class="card-description">
                                                        <h5 class="text-capitalize fw-500">
                                                            <a
                                                                href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">Play
                                                                List 4</a>
                                                        </h5>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-solid fa-earth-americas text-primary"></i>
                                                                <span
                                                                    class="text-body fw-semibold text-capitalize">Public</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-regular fa-eye text-primary"></i>
                                                                <span class="text-body fw-semibold text-capitalize">30
                                                                    Views</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="watchlist-warpper card-hover-style-two">
                                                <div class="block-images position-relative w-100">
                                                    <div class="img-box">
                                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/watchlist-detail.html"
                                                            class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                        <img src="{{ asset('frontend/assets') }}/images/05.webp"
                                                            alt="movie-card"
                                                            class="img-fluid object-cover w-100 d-block border-0" />
                                                    </div>
                                                    <div class="card-description">
                                                        <h5 class="text-capitalize fw-500">
                                                            <a
                                                                href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">Play
                                                                List 5</a>
                                                        </h5>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-solid fa-earth-americas text-primary"></i>
                                                                <span
                                                                    class="text-body fw-semibold text-capitalize">Private</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-regular fa-eye text-primary"></i>
                                                                <span class="text-body fw-semibold text-capitalize">2
                                                                    Views</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="watchlist-warpper card-hover-style-two">
                                                <div class="block-images position-relative w-100">
                                                    <div class="img-box">
                                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/watchlist-detail.html"
                                                            class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                        <img src="{{ asset('frontend/assets') }}/images/06.webp"
                                                            alt="movie-card"
                                                            class="img-fluid object-cover w-100 d-block border-0" />
                                                    </div>
                                                    <div class="card-description">
                                                        <h5 class="text-capitalize fw-500">
                                                            <a
                                                                href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">Play
                                                                List 6</a>
                                                        </h5>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-solid fa-earth-americas text-primary"></i>
                                                                <span
                                                                    class="text-body fw-semibold text-capitalize">Public</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-regular fa-eye text-primary"></i>
                                                                <span class="text-body fw-semibold text-capitalize">10
                                                                    Views</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="watchlist-warpper card-hover-style-two">
                                                <div class="block-images position-relative w-100">
                                                    <div class="img-box">
                                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/watchlist-detail.html"
                                                            class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                        <img src="{{ asset('frontend/assets') }}/images/07.webp"
                                                            alt="movie-card"
                                                            class="img-fluid object-cover w-100 d-block border-0" />
                                                    </div>
                                                    <div class="card-description">
                                                        <h5 class="text-capitalize fw-500">
                                                            <a
                                                                href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">Play
                                                                List 7</a>
                                                        </h5>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-solid fa-earth-americas text-primary"></i>
                                                                <span
                                                                    class="text-body fw-semibold text-capitalize">Public</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 font-size-12">
                                                                <i class="fa-regular fa-eye text-primary"></i>
                                                                <span class="text-body fw-semibold text-capitalize">50
                                                                    Views</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="iq-button">
                                            <button type="button" class="btn text-uppercase position-relativ"
                                                data-bs-toggle="modal" data-bs-target="#addNewPlaylist">
                                                <span class="button-text">Create Playlist</span>
                                                <i class="fa-solid fa-play"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="addNewPlaylist" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <div>
                        <h1 class="modal-title text-capitalize fs-5 fw-500">
                            Create new Playlist
                        </h1>
                        <p class="mb-0">
                            Please fill in all information below to create new playlist.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('playlist.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="frontend">
                        <div class="form-group">
                            <label class="text-white fw-500 mb-2">Name</label>
                            <input type="text" name="name" class="form-control" required />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-white fw-500 mb-2">Description</label>
                            <textarea name="description" class="form-control" cols="5"></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
@endsection
