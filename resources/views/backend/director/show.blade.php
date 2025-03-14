@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-tie mr-2"></i>Director Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('director.index') }}">Directors</a></li>
                        <li class="breadcrumb-item active">{{ $director->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Director Info Card -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle mr-1"></i>
                                Director Information
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm edit-btn"
                                    data-toggle="modal" data-target="#editDirectorModal"
                                    data-id="{{ $director->id }}"
                                    data-name="{{ $director->name }}"
                                    data-biography="{{ $director->biography }}"
                                    data-profile-photo="{{ $director->profile_photo }}">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </button>
                                <a href="{{ route('director.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list mr-1"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        @if($director->profile_photo)
                                            @php
                                                $isExternalUrl = Str::startsWith($director->profile_photo, ['http://', 'https://']);
                                                $imageUrl = $isExternalUrl ? $director->profile_photo : Storage::url($director->profile_photo);
                                            @endphp
                                            <img src="{{ $imageUrl }}"
                                                alt="{{ $director->name }}"
                                                class="img-fluid rounded shadow mb-3"
                                                style="max-height: 300px;">
                                        @else
                                            <div class="bg-light rounded p-5 mb-3 shadow-sm">
                                                <i class="fas fa-user-tie fa-5x text-secondary mb-3"></i>
                                                <p class="text-muted">No profile photo available</p>
                                            </div>
                                        @endif

                                        <div class="mt-3">
                                            <h3 class="text-primary">{{ $director->name }}</h3>
                                            <p class="text-muted">
                                                <i class="fas fa-film mr-1"></i>
                                                {{ $director->movies->count() }} {{ Str::plural('movie', $director->movies->count()) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-book mr-1"></i> Biography</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($director->biography)
                                                <div class="p-3 bg-white rounded">
                                                    {!! nl2br(e($director->biography)) !!}
                                                </div>
                                            @else
                                                <div class="alert alert-light">
                                                    <i class="fas fa-info-circle mr-2"></i> No biography available
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Movies Card -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-film mr-1"></i>
                                Movies Directed
                            </h3>
                        </div>
                        <div class="card-body">
                            @if($director->movies->count() > 0)
                                <div class="row">
                                    @foreach($director->movies as $movie)
                                        <div class="col-md-3 col-sm-6 mb-4">
                                            <div class="card h-100 shadow-sm">
                                                <div class="position-relative">
                                                    @if($movie->poster_url)
                                                        @php
                                                            $isPosterExternal = Str::startsWith($movie->poster_url, ['http://', 'https://']);
                                                            $posterUrl = $isPosterExternal ? $movie->poster_url : Storage::url($movie->poster_url);
                                                        @endphp
                                                        <img src="{{ $posterUrl }}" class="card-img-top"
                                                            alt="{{ $movie->title }}"
                                                            style="height: 200px; object-fit: cover;">
                                                    @else
                                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                                            style="height: 200px;">
                                                            <i class="fas fa-film fa-3x text-secondary"></i>
                                                        </div>
                                                    @endif
                                                    @if($movie->pivot->job)
                                                        <div class="position-absolute badge badge-pill badge-primary"
                                                            style="top: 10px; right: 10px;">
                                                            {{ $movie->pivot->job }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="card-body p-3">
                                                    <h6 class="card-title mb-1 text-primary">{{ $movie->title }}</h6>
                                                    <div class="small text-muted mb-2">
                                                        @if(isset($movie->release_date))
                                                            <i class="far fa-calendar-alt mr-1"></i> {{ $movie->release_date->format('Y') }}
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-sm btn-outline-primary btn-block mt-2">
                                                        <i class="fas fa-eye mr-1"></i> View Details
                                                    </a>
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

                    <!-- Metadata Card -->
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-clock mr-1"></i>
                                Metadata
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Created:</strong> {{ $director->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Last Updated:</strong> {{ $director->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Include Edit Modal -->
@include('backend.director.edit')
@endsection
