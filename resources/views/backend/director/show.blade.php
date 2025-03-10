@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Director Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('director.index') }}">Directors</a></li>
                        <li class="breadcrumb-item active">View Director</li>
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
                            <h3 class="card-title">{{ $director->name }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('director.edit', $director->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('director.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($director->profile_photo)
                                        <img src="{{ Storage::url($director->profile_photo) }}" alt="{{ $director->name }}" class="img-fluid mb-3">
                                    @else
                                        <div class="alert alert-secondary text-center py-5">
                                            <i class="fas fa-user-tie fa-5x mb-3"></i>
                                            <p>No profile photo available</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h4>Biography</h4>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($director->biography)) ?? 'No biography available' !!}
                                    </div>

                                    <h4 class="mt-4">Movies</h4>
                                    @if($director->movies->count() > 0)
                                        <div class="row">
                                            @foreach($director->movies as $movie)
                                                <div class="col-md-3 col-sm-6 mb-3">
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
                                                            @if($movie->pivot->job)
                                                                <small class="text-muted">{{ $movie->pivot->job }}</small>
                                                            @endif
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
                                            <i class="fas fa-info-circle mr-2"></i> This director has no associated movies.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Created: {{ $director->created_at->format('M d, Y H:i') }} | Last Updated: {{ $director->updated_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
