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
                            </div>
                            <div>
                                <a href="{{ route('frontend.account') }}" class="text-white">
                                    <h6 class="font-size-18 text-capitalize text-white fw-500">
                                        {{ Auth::user()->name }}
                                    </h6>
                                    <span class="font-size-14 text-white fw-500">
                                        {{ Auth::user()->email }}
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
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <div
                                                                        class="d-flex align-items-center gap-1 font-size-12">
                                                                        <i class="fa-solid fa-star text-primary"></i>
                                                                        <span
                                                                            class="text-body fw-semibold text-capitalize">{{ $watchlist->movie->imdb_rating }}</span>
                                                                    </div>

                                                                    <div
                                                                        class="d-flex align-items-center gap-1 font-size-12">
                                                                        <i class="fa-regular fa-clock text-primary"></i>
                                                                        <span
                                                                            class="text-body fw-semibold">{{ $watchlist->movie->duration }} mins</span>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <a href="#" class="btn-remove"
                                                                        data-id="{{ $watchlist->id }}"
                                                                        data-url="{{ route('watchlist.destroy', $watchlist->id) }}"
                                                                        data-source="frontend">
                                                                        <i class="fa-regular fa-trash-can"></i>
                                                                    </a>

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
                                        @foreach ($favorites as $favorite)
                                            <div class="col mb-4">
                                                <div class="watchlist-warpper card-hover-style-two">
                                                    <div class="block-images position-relative w-100">
                                                        <div class="img-box">
                                                            <a href="https://templates.iqonic.design/streamit-dist/frontend/html/watchlist-detail.html"
                                                                class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                            <img src="{{ $favorite->movie->backdrop_url }}"
                                                                alt="movie-card"
                                                                class="img-fluid object-cover w-100 d-block border-0" />
                                                        </div>
                                                        <div class="card-description">
                                                            <h5 class="text-capitalize fw-500">
                                                                <a
                                                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html">{{ $favorite->movie->title }}</a>
                                                            </h5>
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="d-flex align-items-center gap-1 font-size-12">
                                                                    <i class="fa-solid fa-star text-primary"></i>
                                                                    <span
                                                                        class="text-body fw-semibold text-capitalize">{{ $favorite->movie->imdb_rating }}</span>
                                                                </div>
                                                                <div class="d-flex align-items-center gap-1 font-size-12">
                                                                    <i class="fa-regular fa-clock text-primary"></i>
                                                                    <span
                                                                        class="text-body fw-semibold">{{ $favorite->movie->duration }} mins</span>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <a href="#" class="btn-remove"
                                                                        data-id="{{ $favorite->id }}"
                                                                        data-url="{{ route('favorite.destroy', $favorite->id) }}"
                                                                        data-source="frontend">
                                                                        <i class="fa-regular fa-trash-can"></i>
                                                                    </a>

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

<style>
    .btn-remove {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        padding: 0;
        flex-shrink: 0;
        transform: translateY(-5px);
        align-self: flex-start;
    }

    .btn-remove i {
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-remove:hover {
        border-color: rgba(255, 77, 77, 0.5);
        background: rgba(255, 77, 77, 0.1);
    }

    .btn-remove:hover i {
        color: #ff4d4d;
        transform: scale(1.1);
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-remove');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const favoriteId = this.getAttribute('data-id');
            const deleteUrl = this.getAttribute('data-url');
            const source = this.getAttribute('data-source'); // Get source value

            Swal.fire({
                title: 'Delete Favorite?',
                text: 'Are you sure you want to remove this favorite?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(result => {
                if (result.isConfirmed) {
                    // Create a form dynamically
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;
                    form.style.display = 'none';

                    // CSRF Token and DELETE Method
                    form.appendChild(createInput('_token', '{{ csrf_token() }}'));
                    form.appendChild(createInput('_method', 'DELETE'));
                    form.appendChild(createInput('source', source)); // Send the source parameter

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
});

// Function to create hidden input elements
function createInput(name, value) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.value = value;
    return input;
}

</script>
