@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Playlist Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('playlist.index') }}">Playlists</a></li>
                            <li class="breadcrumb-item active">View Playlist</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <h3 class="card-title">Playlist #{{ $playlist->id }}</h3>
                                    <div class="card-tools">
                                        <a href="{{ route('playlist.edit', $playlist->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('playlist.index') }}" class="btn btn-secondary btn-sm ml-2">
                                            <i class="fas fa-list"></i> Back to List
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <!-- Playlist Information -->
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="card-header">
                                                <h3 class="card-title">Playlist Information</h3>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width: 30%">Name</th>
                                                        <td>{{ $playlist->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Description</th>
                                                        <td>{{ $playlist->description ?? 'No description' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Created At</th>
                                                        <td>{{ $playlist->created_at ? \Carbon\Carbon::parse($playlist->created_at)->format('F d, Y H:i:s') : 'N/A' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Updated At</th>
                                                        <td>{{ $playlist->updated_at ? \Carbon\Carbon::parse($playlist->updated_at)->format('F d, Y H:i:s') : 'N/A' }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- User Information -->
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="card-header">
                                                <h3 class="card-title">User Information</h3>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width: 30%">User ID</th>
                                                        <td>{{ $playlist->user->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Name</th>
                                                        <td>{{ $playlist->user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td>{{ $playlist->user->email }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Movies List -->
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Movies in Playlist</h3>
                                            </div>
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Title</th>
                                                            <th class="d-none d-md-table-cell">Release Date</th>
                                                            <th class="d-none d-lg-table-cell">Added to Playlist</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($playlist->movies as $movie)
                                                            <tr>
                                                                <td>{{ $movie->id }}</td>
                                                                <td>{{ $movie->title }}</td>
                                                                <td class="d-none d-md-table-cell">
                                                                    {{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('F d, Y') : 'N/A' }}
                                                                </td>
                                                                <td class="d-none d-lg-table-cell">
                                                                    {{ $movie->pivot->added_at ? \Carbon\Carbon::parse($movie->pivot->added_at)->format('F d, Y H:i:s') : 'N/A' }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">No movies in this
                                                                    playlist</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="button" class="btn btn-danger delete-btn" data-id="{{ $playlist->id }}"
                                    data-url="{{ route('playlist.destroy', $playlist->id) }}">
                                    <i class="fas fa-trash"></i> Delete Playlist
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('styles')
        <style>
            @media (max-width: 768px) {
                .card-tools {
                    margin-top: 0.5rem;
                }

                .table td {
                    max-width: 200px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                }
            }
        </style>
    @endpush


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        // Add click event listener to each button
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const playlistId = this.getAttribute('data-id');
                const deleteUrl = this.getAttribute('data-url');

                // Show SweetAlert2 confirmation
                Swal.fire({
                    title: 'Delete Playlist',
                    text: 'Are you sure you want to delete this playlist?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (result.isConfirmed) {
                        // Create a form element
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = deleteUrl;
                        form.style.display = 'none';

                        // Add CSRF token and method spoofing
                        form.appendChild(createInput('_token', '{{ csrf_token() }}'));
                        form.appendChild(createInput('_method', 'DELETE'));

                        // Append form to body and submit
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
@endsection
