@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-tie mr-2"></i>Actor Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('actor.index') }}">Actors</a></li>
                        <li class="breadcrumb-item active">{{ $actor->name }}</li>
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
                    <!-- Actor Info Card -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle mr-1"></i>
                                Actor Information
                            </h3>
                            <div class="card-tools">
                                <a href="{{ route('actor.edit', $actor->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <a href="{{ route('actor.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list mr-1"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        @if($actor->profile_photo)
                                            <img src="{{ $actor->profile_photo }}"
                                                alt="{{ $actor->name }}"
                                                class="img-fluid rounded shadow mb-3"
                                                style="max-height: 300px;">
                                        @else
                                            <div class="bg-light rounded p-5 mb-3 shadow-sm">
                                                <i class="fas fa-user-tie fa-5x text-secondary mb-3"></i>
                                                <p class="text-muted">No profile photo available</p>
                                            </div>
                                        @endif

                                        <div class="mt-3">
                                            <h3 class="text-primary">{{ $actor->name }}</h3>
                                            @if($actor->birth_date)
                                                <p class="text-muted">
                                                    <i class="fas fa-birthday-cake mr-1"></i>
                                                    {{ $actor->birth_date->format('M d, Y') }}
                                                    ({{ $actor->birth_date->age }} years old)
                                                </p>
                                            @endif
                                            <p class="text-muted">
                                                <i class="fas fa-film mr-1"></i>
                                                {{ $actor->movies->count() }} {{ Str::plural('movie', $actor->movies->count()) }}
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
                                            @if($actor->biography)
                                                <div class="p-3 bg-white rounded">
                                                    {!! nl2br(e($actor->biography)) !!}
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
                                Movies
                            </h3>
                        </div>
                        <div class="card-body">
                            @if($actor->movies->count() > 0)
                                <div class="row">
                                    @foreach($actor->movies as $movie)
                                        <div class="col-md-3 col-sm-6 mb-4">
                                            <div class="card h-100 shadow-sm">
                                                <div class="position-relative">
                                                    @if($movie->poster_url)
                                                        <img src="{{ $movie->poster_url }}" class="card-img-top"
                                                            alt="{{ $movie->title }}"
                                                            style="height: 200px; object-fit: cover;">
                                                    @else
                                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                                            style="height: 200px;">
                                                            <i class="fas fa-film fa-3x text-secondary"></i>
                                                        </div>
                                                    @endif
                                                    @if($movie->pivot->character)
                                                        <div class="position-absolute badge badge-pill badge-primary"
                                                            style="top: 10px; right: 10px;">
                                                            {{ $movie->pivot->character }}
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
                                    <i class="fas fa-info-circle mr-2"></i> This actor has no associated movies.
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
                                    <p><strong>Created:</strong> {{ $actor->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Last Updated:</strong> {{ $actor->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButton = document.querySelector('.delete-btn');

        // Add click event listener to the button
        if (deleteButton) {
            deleteButton.addEventListener('click', function(e) {
                e.preventDefault();
                const actorId = this.getAttribute('data-id');
                const deleteUrl = this.getAttribute('data-url');

                // Show SweetAlert2 confirmation
                Swal.fire({
                    title: 'Delete Actor',
                    text: 'Are you sure you want to delete this actor?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create a form element
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = deleteUrl;
                        form.style.display = 'none';

                        // Add CSRF token
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        form.appendChild(csrfToken);

                        // Add method spoofing for DELETE
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        form.appendChild(methodField);

                        // Append form to body, submit it, then remove it
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        }
    });
</script>
@endsection
