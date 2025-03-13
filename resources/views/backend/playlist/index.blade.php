@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">PlayList Management</h3>
                            <div class="card-tools">
                                <a href="{{ route('playlist.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New Playlist
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Name</th>
                                        <th>Movie</th>
                                        <th>Added At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($playlists as $playlist)
                                        <tr>
                                            <td>{{ $playlist->id }}</td>
                                            <td>{{ $playlist->user->name }}</td>
                                            <td>{{ $playlist->name }}</td>
                                            <td>
                                                @foreach($playlist->movies as $movie)
                                                    <span class="badge badge-info">{{ $movie->title }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $playlist->created_at }}</td>
                                            <td>{{ $playlist->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('playlist.show', $playlist->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('playlist.edit', $playlist->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $playlist->id }}"
                                                        data-url="{{ route('playlist.destroy', $playlist->id) }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
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
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{-- {{ $playlists->links() }} --}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
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
