@extends('frontend.layouts.app')

@section('styles')
    <style>
        .movie-info-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .movie-time {
            flex: 0 0 auto;
        }

        .watchlist {
            flex: 0 0 auto;
        }

        .watch-list-not {
            display: flex;
            align-items: center;
            color: #fff;
        }

        .watchlist-label {
            margin-left: 4px;
        }
    </style>
@endsection

@section('content')

    <div class="section-padding">
        <div class="container-fluid">
            @if (isset($director))
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="cast-box position-relative">
                            <img src="{{ $director->profile_photo ? $director->profile_photo : asset('frontend/assets/images/default-profile.png') }}"
                                class="img-fluid" alt="image" loading="lazy">

                            {{-- <ul class="p-0 m-0 list-unstyled widget_social_media position-absolute w-100 text-center">
                                <li>
                                    <a href="#" class="position-relative">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="position-relative">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="position-relative">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            </ul> --}}
                        </div>

                        @if ($director->birth_date)
                            <h5 class="mt-5 mb-4 text-white fw-500">Personal Details</h5>
                            <h6 class="font-size-18 text-white fw-500">Born:</h6>
                            <div class="seperator d-flex align-items-center flex-wrap mb-3">
                                <span>{{ $director->birth_date ? $director->birth_date->format('F j, Y') : 'N/A' }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-9 col-md-7 mt-5 mt-md-0">
                        <h4 class="fw-500">{{ $director->name }}</h4>
                        <div class="seperator d-flex align-items-center flex-wrap mb-3">
                            <span class="fw-semibold">Director</span>
                        </div>

                        @if ($director->biography)
                            <p>{{ $director->biography }}</p>
                        @else
                            <p>No biography available.</p>
                        @endif

                        <div class="pb-md-5">
                            <h5 class="main-title text-capitalize mb-4">Directed Movies</h5>
                            <div class="card-style-grid mb-5">
                                <div class="row row-cols-xl-5 row-cols-sm-2 row-cols-1">
                                    @if (count($movies) > 0)
                                        @foreach ($movies as $movie)
                                            <div class="col mb-4">
                                                <div class="iq-card card-hover">
                                                    <div class="block-images position-relative w-100">

                                                        <div class="img-box w-100">
                                                            <a href="{{ route('frontend.detail', $movie->id) }}"
                                                                class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                            @if ($movie->poster_url)
                                                                <img src="{{ $movie->poster_url }}"
                                                                    alt="{{ $movie->title }}"
                                                                    class="img-fluid object-cover w-100 d-block border-0">
                                                            @else
                                                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                                                    style="height: 200px;">
                                                                    <i class="fas fa-film fa-3x text-white"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="card-description with-transition">
                                                            <div class="cart-content">
                                                                <div class="content-left">
                                                                    <h5 class="iq-title text-capitalize">
                                                                        <a
                                                                            href="{{ route('frontend.detail', $movie->id) }}">
                                                                            {{ Str::limit($movie->title, 30, '...') }}
                                                                        </a>
                                                                    </h5>
                                                                    <div class="movie-info-container">
                                                                        <div class="movie-time">
                                                                            <span
                                                                                class="movie-time-text font-normal">{{ $movie->duration }}
                                                                                mins</span>
                                                                        </div>
                                                                        <div class="watchlist">
                                                                            <form
                                                                                action="{{ route('watchlist.toggle', $movie->id) }}"
                                                                                method="POST" class="d-inline">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="watch-list-not border-0 bg-transparent p-0">
                                                                                    <svg width="10" height="10"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        class="icon-10">
                                                                                        <path d="M12 4V20M20 12H4"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"></path>
                                                                                    </svg>
                                                                                    <span class="watchlist-label"> Watchlist
                                                                                    </span>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="block-social-info align-items-center">
                                                            <ul class="p-0 m-0 d-flex gap-2 music-play-lists">

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
                                        @endforeach
                                    @else
                                        <p>No movies found for this director.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($actor)
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="cast-box position-relative">
                            <img src="{{ $actor->profile_photo ? $actor->profile_photo : asset('frontend/assets/images/default-actor.webp') }}"
                                class="img-fluid object-cover w-100" alt="{{ $actor->name }}" loading="lazy">
                            {{-- <ul class="p-0 m-0 list-unstyled widget_social_media position-absolute w-100 text-center">
                                <li>
                                    <a href="#" class="position-relative">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="position-relative">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="position-relative">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            </ul> --}}
                        </div>

                        @if ($actor->birth_date)
                            <h5 class="mt-5 mb-4 text-white fw-500">Personal Details</h5>
                            <h6 class="font-size-18 text-white fw-500">Born:</h6>
                            <div class="seperator d-flex align-items-center flex-wrap mb-3">
                                <span>{{ $actor->birth_date ? $actor->birth_date->format('F j, Y') : 'N/A' }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-9 col-md-7 mt-5 mt-md-0">
                        <h4 class="fw-500">{{ $actor->name }}</h4>
                        <div class="seperator d-flex align-items-center flex-wrap mb-3">
                            <span class="fw-semibold">Actor</span>
                        </div>

                        @if ($actor->biography)
                            <p>{{ $actor->biography }}</p>
                        @else
                            <p>No biography available.</p>
                        @endif

                        <div class="pb-md-5">
                            <h5 class="main-title text-capitalize mb-4">Movies</h5>
                            <div class="card-style-grid mb-5">
                                <div class="row row-cols-xl-5 row-cols-sm-2 row-cols-1">
                                    @if ($actor->movies->count() > 0)
                                        @foreach ($actor->movies as $movie)
                                            <div class="col mb-4">
                                                <div class="iq-card card-hover">
                                                    <div class="block-images position-relative w-100">

                                                        <div class="img-box w-100">
                                                            <a href="{{ route('frontend.detail', $movie->id) }}"
                                                                class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                            @if ($movie->poster_url)
                                                                <img src="{{ $movie->poster_url }}"
                                                                    alt="{{ $movie->title }}"
                                                                    class="img-fluid object-cover w-100 d-block border-0">
                                                            @else
                                                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                                                    style="height: 200px;">
                                                                    <i class="fas fa-film fa-3x text-white"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="card-description with-transition">
                                                            <div class="cart-content">
                                                                <div class="content-left w-100">
                                                                    <h5 class="iq-title text-capitalize">
                                                                        <a
                                                                            href="">{{ Str::limit($movie->title, 15) }}</a>

                                                                    </h5>
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between my-2">
                                                                        <div class="movie-time">
                                                                            <span
                                                                                class="movie-time-text font-normal">{{ $movie->duration }}mins</span>
                                                                        </div>
                                                                        <div class="watchlist border-0 bg-transparent">
                                                                            <form action="{{ route('watchlist.store') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="user_id"
                                                                                    value="{{ auth()->id() }}">
                                                                                <input type="hidden" name="movie_id"
                                                                                    value="{{ $movie->id }}">
                                                                                <input type="hidden" name="source"
                                                                                    value="frontend">
                                                                                <button type="submit"
                                                                                    class="watch-list-not border-0 bg-transparent">
                                                                                    <svg width="10" height="10"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        class="icon-10">
                                                                                        <path d="M12 4V20M20 12H4"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"></path>
                                                                                    </svg>
                                                                                    <span class="watchlist-label">
                                                                                        Watchlist </span>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="block-social-info align-items-center">
                                                            <ul class="p-0 m-0 d-flex gap-2 music-play-lists">

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
                                        @endforeach
                                    @else
                                        <p>No movies found for this actor.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <p>No information found.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
