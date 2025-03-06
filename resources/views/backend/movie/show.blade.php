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
