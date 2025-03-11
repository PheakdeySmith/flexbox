@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Genre Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('genre.index') }}">Genres</a></li>
                        <li class="breadcrumb-item active">View Genre</li>
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
                            <h3 class="card-title">{{ $genre->name }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('genre.edit', $genre->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('genre.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 20%">Name</th>
                                            <td>{{ $genre->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Slug</th>
                                            <td>{{ $genre->slug }}</td>
                                        </tr>
                                        <tr>
                                            <th>TMDB ID</th>
                                            <td>{{ $genre->tmdb_id ?? 'N/A' }}</td>
                                        </tr>
                                    </table>

                                    <h4 class="mt-4">Movies in this Genre</h4>
                                    @if($genre->movies->count() > 0)
                                        <div class="row">
                                            @foreach($genre->movies as $movie)
                                                <div class="col-md-2 col-sm-4 mb-3">
                                                    <div class="card h-100">
                                                        <div class="position-relative">
                                                            @if($movie->poster_url)
                                                                <img src="{{ $movie->poster_url }}" class="card-img-top" alt="{{ $movie->title }}" style="height: 180px; object-fit: cover;">
                                                            @else
                                                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 180px;">
                                                                    <i class="fas fa-film fa-3x text-white"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="card-body p-2 text-center">
                                                            <h6 class="card-title mb-0">{{ $movie->title }}</h6>
                                                            <div class="mt-2">
                                                                <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-sm btn-info">
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
                                            <i class="fas fa-info-circle mr-2"></i> No movies have been added to this genre yet.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Created: {{ $genre->created_at->format('M d, Y H:i') }} | Last Updated: {{ $genre->updated_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
