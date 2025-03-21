@extends('backend.layouts.app')

@section('content')
    <<<<<<< HEAD <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                <i class="fas fa-plus"></i> Add New User
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User Management</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (isset($search) && $search)
                                    <div class="alert alert-info">
                                        Found {{ $users->total() }} result(s) for: <strong>{{ $search }}</strong>
                                    </div>
                                @endif
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Profile Image</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users ?? [] as $key => $user)
                                            <tr>
                                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->getRoleNames()->first() ?? 'No Role Assigned' }}</td>
                                                <td>
                                                    @if ($user->user_profile)
                                                        <img src="{{ asset($user->user_profile) }}" width="50"
                                                            alt="Profile Photo">
                                                    @else
                                                        <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg"
                                                            width="50" class="img-circle elevation-2" alt="User Image">
                                                    @endif
                                                </td>
                                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-profile-photo="{{ $user->user_profile }}"
                                                        data-role="{{ optional($user->roles->first())->id ?? '' }}"
                                                        data-action="{{ route('user.update', $user->id) }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $user->id }}"
                                                        data-url="{{ route('user.destroy', $user->id) }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No users found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Profile Image</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <!-- Add pagination footer -->
                            <div class="card-footer clearfix">
                                @if (isset($search) && $search)
                                    <div class="float-left">
                                        <a href="{{ route('user.index') }}" class="btn btn-default">
                                            <i class="fas fa-list"></i> Show All
                                        </a>
                                    </div>
                                @endif
                                <div class="pagination pagination-sm m-0 float-right">
                                    {{ $users->links() }}
                                </div>
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


        @include('backend.user.create')
        @include('backend.user.edit')

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var deleteButtons = document.querySelectorAll('.delete-btn');

                // Add click event listener to each button
                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const userId = this.getAttribute('data-id');
                        const deleteUrl = this.getAttribute('data-url');

                        // Show SweetAlert2 confirmation
                        Swal.fire({
                            title: 'Delete User',
                            text: 'Are you sure you want to delete this user?',
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
