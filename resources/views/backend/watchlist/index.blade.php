@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Watchlists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Watchlists</li>
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
                        <a href="{{ route('watchlist.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Watchlist Entry
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Watchlist Management</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="watchlistTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Movie</th>
                                        <th>Added At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($watchlists as $watchlist)
                                        <tr>
                                            <td>{{ $watchlist->id }}</td>
                                            <td>{{ $watchlist->user->name }}</td>
                                            <td>{{ $watchlist->movie->title }}</td>
                                            <td>{{ $watchlist->added_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('watchlist.show', $watchlist->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('watchlist.edit', $watchlist->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm delete-btn"
                                                   data-id="{{ $watchlist->id }}"
                                                   data-url="{{ route('watchlist.destroy', $watchlist->id) }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No watchlist entries Mu playlist
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Movie</th>
                                        <th>Added At</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <!-- Removed Laravel pagination links -->
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        $("#watchlistTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "pageLength": 15,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#watchlistTable_wrapper .col-md-6:eq(0)');

        // Delete button functionality
        var deleteButtons = document.querySelectorAll('.delete-btn');

        // Add click event listener to each button
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const watchlistId = this.getAttribute('data-id');
                const deleteUrl = this.getAttribute('data-url');

                // Show SweetAlert2 confirmation
                Swal.fire({
                    title: 'Delete Watchlist Entry',
                    text: 'Are you sure you want to delete this watchlist entry?',
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
