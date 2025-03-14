@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Playlists</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Playlists</li>
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
                                    <h3 class="card-title mb-2 mb-sm-0">PlayList Management</h3>
                                    <div class="card-tools">
                                        <a href="{{ route('playlist.create') }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i> Add New Playlist
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible m-3">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="d-none d-md-table-cell">ID</th>
                                                <th>User</th>
                                                <th>Name</th>
                                                <th class="d-none d-lg-table-cell">Movie</th>
                                                <th class="d-none d-xl-table-cell">Added At</th>
                                                <th class="d-none d-xl-table-cell">Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($playlists as $playlist)
                                                <tr>
                                                    <td class="d-none d-md-table-cell">{{ $playlist->id }}</td>
                                                    <td>{{ $playlist->user->name }}</td>
                                                    <td>{{ $playlist->name }}</td>
                                                    <td class="d-none d-lg-table-cell">
                                                        <div class="movie-badges">
                                                            @foreach ($playlist->movies as $movie)
                                                                <span class="badge badge-info mb-1">{{ $movie->title }}</span>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="d-none d-xl-table-cell">{{ $playlist->created_at }}</td>
                                                    <td class="d-none d-xl-table-cell">{{ $playlist->updated_at }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('playlist.show', $playlist->id) }}"
                                                                class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                                <span class="d-none d-md-inline"> View</span>
                                                            </a>
                                                            <a href="{{ route('playlist.edit', $playlist->id) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                                <span class="d-none d-md-inline"> Edit</span>
                                                            </a>
                                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                                data-id="{{ $playlist->id }}"
                                                                data-url="{{ route('playlist.destroy', $playlist->id) }}">
                                                                <i class="fas fa-trash"></i>
                                                                <span class="d-none d-md-inline"> Delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No playlists found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('styles')
    <style>
        .movie-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.25rem;
        }

        .btn-group {
            display: flex;
            flex-wrap: nowrap;
            gap: 0.25rem;
        }

        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
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
@endsection

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
