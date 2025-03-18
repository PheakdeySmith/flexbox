@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Actors</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Actors</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Flash Message Display -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check for flash messages
            @if(session('success'))
                showSuccessToast("{{ session('success') }}");
            @endif

            @if(session('error'))
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
                        <a href="{{ route('actor.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Actor
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Actor Management</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(request('search'))
                                <div class="alert alert-info">
                                    Found {{ count($actors) }} result(s) for: <strong>{{ request('search') }}</strong>
                                </div>
                            @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Profile Photo</th>
                                        <th>Birth Date</th>
                                        <th>Movies</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($actors ?? [] as $key => $actor)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $actor->name }}</td>
                                            <td class="text-center">
                                                @if($actor->profile_photo)
                                                    <img src="{{ $actor->profile_photo }}" alt="{{ $actor->name }}" width="50" class="img-thumbnail">
                                                @else
                                                    <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg" width="50" class="img-circle elevation-2" alt="Actor Image">
                                                @endif
                                            </td>
                                            <td>{{ $actor->birth_date ? $actor->birth_date->format('M d, Y') : 'N/A' }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-info">{{ $actor->movies->count() }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('actor.show', $actor->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('actor.edit', $actor->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                    data-id="{{ $actor->id }}"
                                                    data-url="{{ route('actor.destroy', $actor->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No actors found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Profile Photo</th>
                                        <th>Birth Date</th>
                                        <th>Movies</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        @if(method_exists($actors, 'links'))
                            <!-- Add pagination footer -->
                            <div class="card-footer clearfix">
                                @if(request('search'))
                                    <div class="float-left">
                                        <a href="{{ route('actor.index') }}" class="btn btn-default">
                                            <i class="fas fa-list"></i> Show All
                                        </a>
                                    </div>
                                @endif
                                <div class="pagination pagination-sm m-0 float-right">
                                    {{ $actors->links() }}
                                </div>
                            </div>
                        @endif
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
                const actorId = this.getAttribute('data-id');
                const deleteUrl = this.getAttribute('data-url');

                // Show SweetAlert2 confirmation
                Swal.fire({
                    title: 'Delete Actor',
                    text: 'Are you sure you want to delete this actor?',
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
