@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <h2 class="title">{{ $title }}</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!--bread-crumb-->

    <div class="section-padding">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="card-title">Filters</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('frontend.viewAll') }}" method="GET" id="filter-form">
                                <input type="hidden" name="section" value="{{ $section }}">

                                @if ($section == 'genre' && isset($genreId))
                                    <input type="hidden" name="genre_id" value="{{ $genreId }}">
                                @endif

                                @if ($section == 'actor' && isset($actorId))
                                    <input type="hidden" name="actor_id" value="{{ $actorId }}">
                                @endif

                                <!-- Genre Filter -->
                                <div class="mb-4">
                                    <h6>Genres</h6>
                                    <div class="genre-list">
                                        @foreach ($genres as $genre)
                                            <div class="form-check">
                                                <a href="{{ route('frontend.viewAll', ['section' => 'genre', 'genre_id' => $genre->id]) }}"
                                                    class="{{ isset($genreId) && $genreId == $genre->id ? 'text-primary fw-bold' : 'text-body' }}">
                                                    {{ $genre->name }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Sections Filter -->
                                <div class="mb-4">
                                    <h6>Sections</h6>
                                    <div class="section-list">
                                        <div class="form-check">
                                            <a href="{{ route('frontend.viewAll', ['section' => 'all']) }}"
                                                class="{{ $section == 'all' ? 'text-primary fw-bold' : 'text-body' }}">
                                                All Movies
                                            </a>
                                        </div>
                                        <div class="form-check">
                                            <a href="{{ route('frontend.viewAll', ['section' => 'recommended']) }}"
                                                class="{{ $section == 'recommended' ? 'text-primary fw-bold' : 'text-body' }}">
                                                Recommended
                                            </a>
                                        </div>
                                        <div class="form-check">
                                            <a href="{{ route('frontend.viewAll', ['section' => 'latest']) }}"
                                                class="{{ $section == 'latest' ? 'text-primary fw-bold' : 'text-body' }}">
                                                Latest
                                            </a>
                                        </div>
                                        <div class="form-check">
                                            <a href="{{ route('frontend.viewAll', ['section' => 'popular']) }}"
                                                class="{{ $section == 'popular' ? 'text-primary fw-bold' : 'text-body' }}">
                                                Popular
                                            </a>
                                        </div>
                                        <div class="form-check">
                                            <a href="{{ route('frontend.viewAll', ['section' => 'top_rated']) }}"
                                                class="{{ $section == 'top_rated' ? 'text-primary fw-bold' : 'text-body' }}">
                                                Top Rated
                                            </a>
                                        </div>
                                        <div class="form-check">
                                            <a href="{{ route('frontend.viewAll', ['section' => 'free']) }}"
                                                class="{{ $section == 'free' ? 'text-primary fw-bold' : 'text-body' }}">
                                                Free Movies
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Search Box (Only shown in search section) -->
                                @if ($section == 'search')
                                    <div class="mb-4">
                                        <h6>Search Again</h6>
                                        <form action="{{ route('frontend.search') }}" method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="query"
                                                    value="{{ $query ?? '' }}" placeholder="Search movies..." required>
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Movie Grid -->
                <div class="col-lg-9 col-md-8">
                    <div class="card-style-grid">
                        <div class="row row-cols-xl-4 row-cols-md-2 row-cols-1">
                            @forelse($movies as $movie)
                                <div class="col mb-4">
                                    <div class="iq-card card-hover">
                                        <div class="block-images position-relative w-100">
                                            <div class="img-box w-100">
                                                <a href="{{ route('frontend.detail', $movie->id) }}"
                                                    class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                <img src="{{ $movie->poster_url ?? asset('frontend/assets/images/01.webp') }}"
                                                    alt="{{ $movie->title }}"
                                                    class="img-fluid object-cover w-100 d-block border-0">
                                            </div>
                                            <div class="card-description with-transition">
                                                <div class="cart-content">
                                                    <div class="content-left">
                                                        <h5 class="iq-title text-capitalize">
                                                            <a
                                                                href="{{ route('frontend.detail', $movie->id) }}">{{ $movie->title }}</a>
                                                        </h5>
                                                        <div class="movie-time d-flex align-items-center my-2">
                                                            <span
                                                                class="movie-time-text font-normal">{{ $movie->duration }}
                                                                mins</span>
                                                        </div>
                                                    </div>
                                                    @if (auth()->check())
                                                        <div class="watchlist">
                                                            <a class="watch-list-not" href="#">
                                                                <svg width="10" height="10" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon-10">
                                                                    <path d="M12 4V20M20 12H4" stroke="currentColor"
                                                                        stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                </svg>
                                                                <span class="watchlist-label"> Watchlist </span>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="block-social-info align-items-center">
                                                <ul class="p-0 m-0 d-flex gap-2 music-play-lists">
                                                    @if (auth()->check())
                                                        {{-- <li class="share position-relative d-flex align-items-center text-center mb-0">
                                                            <span class="w-100 h-100 d-inline-block bg-transparent">
                                                                <i class="fa-regular fa-heart"></i>
                                                            </span>
                                                        </li> --}}
                                                    @endif
                                                </ul>
                                                <div class="iq-button">
                                                    <a href="{{ route('frontend.detail', $movie->id) }}"
                                                        class="btn text-uppercase position-relative rounded-circle">
                                                        <i class="fa-solid fa-play ms-0"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        @if ($section == 'search')
                                            No movies found matching "{{ $query }}". Try a different search term.
                                        @else
                                            No movies found for this section. Try another category or check back later.
                                        @endif
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-center">
                                    {{ $movies->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
