@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Movie Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('movie.index') }}">Movies</a></li>
                        <li class="breadcrumb-item active">View Movie</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $movie->title }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('movie.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($movie->poster_url)
                                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="img-fluid mb-3">
                                    @else
                                        <div class="alert alert-secondary text-center py-5">
                                            <i class="fas fa-film fa-5x mb-3"></i>
                                            <p>No poster available</p>
                                        </div>
                                    @endif

                                    @if($movie->backdrop_url)
                                        <div class="mt-3">
                                            <p class="text-muted">Backdrop Image:</p>
                                            <img src="{{ $movie->backdrop_url }}" alt="{{ $movie->title }} backdrop" class="img-fluid">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 40%">TMDB ID</th>
                                                    <td>{{ $movie->tmdb_id ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <td>
                                                        <span class="badge badge-{{ $movie->type == 'movie' ? 'primary' : 'info' }}">
                                                            {{ ucfirst(str_replace('_', ' ', $movie->type)) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Release Date</th>
                                                    <td>{{ $movie->release_date ? $movie->release_date->format('F d, Y') : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Duration</th>
                                                    <td>{{ $movie->duration ? $movie->duration . ' minutes' : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Price</th>
                                                    <td>
                                                        @if($movie->is_free)
                                                            <span class="badge badge-success">Free</span>
                                                        @else
                                                            ${{ number_format($movie->price, 2) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 40%">IMDb Rating</th>
                                                    <td>
                                                        @if($movie->imdb_rating)
                                                            <span class="text-warning">
                                                                <i class="fas fa-star"></i> {{ $movie->imdb_rating }}
                                                            </span>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Country</th>
                                                    <td>{{ $movie->country ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Language</th>
                                                    <td>{{ $movie->language ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Maturity Rating</th>
                                                    <td>{{ $movie->maturity_rating ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        <span class="badge badge-{{ $movie->status == 'active' ? 'success' : 'danger' }}">
                                                            {{ ucfirst($movie->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <h5>Description</h5>
                                        <div class="p-3 bg-light rounded">
                                            {!! nl2br(e($movie->description)) ?? 'No description available' !!}
                                        </div>
                                    </div>

                                    @if($movie->trailer_url)
                                    <div class="mt-4">
                                        <h5>Trailer</h5>
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"
                                                src="{{ str_contains($movie->trailer_url, 'youtube.com')
                                                    ? str_replace('watch?v=', 'embed/', $movie->trailer_url)
                                                    : $movie->trailer_url }}"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    @endif

                                    @if($movie->video_url)
                                    <div class="mt-4">
                                        <h5>Full Video</h5>
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"
                                                src="{{ str_contains($movie->video_url, 'youtube.com')
                                                    ? str_replace('watch?v=', 'embed/', $movie->video_url)
                                                    : $movie->video_url }}"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Actors Section -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5>Cast</h5>
                                    @if($movie->actors->count() > 0)
                                        <div class="row">
                                            @foreach($movie->actors as $actor)
                                                <div class="col-md-2 col-sm-4 mb-3">
                                                    <div class="card h-100">
                                                        <div class="position-relative">
                                                            @if($actor->profile_photo)
                                                                <img src="{{ $actor->profile_photo }}" class="card-img-top" alt="{{ $actor->name }}" style="height: 180px; object-fit: cover;">
                                                            @else
                                                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 180px;">
                                                                    <i class="fas fa-user fa-3x text-white"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="card-body p-2 text-center">
                                                            <h6 class="card-title mb-0">{{ $actor->name }}</h6>
                                                            @if($actor->pivot->character)
                                                                <small class="text-muted">as {{ $actor->pivot->character }}</small>
                                                            @endif
                                                            <div class="mt-2">
                                                                <a href="{{ route('actor.show', $actor->id) }}" class="btn btn-sm btn-info">
                                                                    <i class="fas fa-eye"></i> View
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle mr-2"></i> No actors have been added to this movie yet.
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Directors Section -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5>Directors & Crew</h5>
                                    @if($movie->directors->count() > 0)
                                        <div class="row">
                                            @foreach($movie->directors as $director)
                                                <div class="col-md-2 col-sm-4 mb-3">
                                                    <div class="card h-100">
                                                        <div class="position-relative">
                                                            @if($director->profile_photo)
                                                                <img src="{{ $director->profile_photo }}" class="card-img-top" alt="{{ $director->name }}" style="height: 180px; object-fit: cover;">
                                                            @else
                                                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 180px;">
                                                                    <i class="fas fa-user-tie fa-3x text-white"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="card-body p-2 text-center">
                                                            <h6 class="card-title mb-0">{{ $director->name }}</h6>
                                                            @if($director->pivot->job)
                                                                <small class="text-muted">{{ $director->pivot->job }}</small>
                                                            @else
                                                                <small class="text-muted">Director</small>
                                                            @endif
                                                            <div class="mt-2">
                                                                <a href="{{ route('director.show', $director->id) }}" class="btn btn-sm btn-info">
                                                                    <i class="fas fa-eye"></i> View
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle mr-2"></i> No directors have been added to this movie yet.
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Genres Section -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5>Genres</h5>
                                    @if($movie->genres->count() > 0)
                                        <div class="d-flex flex-wrap">
                                            @foreach($movie->genres as $genre)
                                                <span class="badge badge-primary p-2 m-1">{{ $genre->name }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle mr-2"></i> No genres have been added to this movie yet.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Created: {{ $movie->created_at->format('M d, Y H:i') }} | Last Updated: {{ $movie->updated_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
