@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Movies</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Movies</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Flash Message Display -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Check for flash messages
                @if (session('success'))
                    showSuccessToast("{{ session('success') }}");
                @endif

                @if (session('error'))
                    showErrorToast("{{ session('error') }}");
                @endif
            });
        </script>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('movie.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Movie
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Movie Management</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Poster</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Release Date</th>
                                            <th>Price</th>
                                            <th>IMDb</th>
                                            <th>Slide</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($movies ?? [] as $movie)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    @if ($movie->poster_url)
                                                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}"
                                                            width="50" class="img-thumbnail">
                                                    @else
                                                        <span class="badge badge-secondary">No Image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $movie->title }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $movie->type == 'movie' ? 'primary' : 'info' }}">
                                                        {{ ucfirst(str_replace('_', ' ', $movie->type)) }}
                                                    </span>
                                                </td>
                                                <td>{{ $movie->release_date ? $movie->release_date->format('M d, Y') : 'N/A' }}
                                                </td>
                                                <td>
                                                    @if ($movie->is_free)
                                                        <span class="badge badge-success">Free</span>
                                                    @else
                                                        ${{ number_format($movie->price, 2) }}
                                                    @endif
                                                </td>
                                                <td>{{ $movie->imdb_rating ?? 'N/A' }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $movie->status == 'active' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($movie->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('movie.show', $movie->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    <a href="{{ route('movie.edit', $movie->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $movie->id }}"
                                                        data-url="{{ route('movie.destroy', $movie->id) }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No movies found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Poster</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Release Date</th>
                                            <th>Price</th>
                                            <th>IMDb</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.delete-btn');

            // Add click event listener to each button
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const movieId = this.getAttribute('data-id');
                    const deleteUrl = this.getAttribute('data-url');

                    // Show SweetAlert2 confirmation
                    Swal.fire({
                        title: 'Delete Movie',
                        text: 'Are you sure you want to delete this movie?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
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
            });
        });
    </script>
@endsection
