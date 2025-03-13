@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showSuccessToast("{{ session('success') }}");
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showErrorToast("{{ session('error') }}");
                });
            </script>
        @endif

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

                            <div class="card-body">
                                <table id="usersTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Profile Image</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ Str::limit($user->password, 20) }}</td>
                                                <td>{{ $user->getRoleNames()->first() ?? 'No Role Assigned' }}</td>

                                                <td>
                                                    @if ($user->user_profile)
                                                        <img src="{{ asset('storage/' . $user->user_profile) }}"
                                                            width="50" alt="Profile Photo">
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>
                                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
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
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('backend.user.create')
    @include('backend.user.edit')
    <!-- Include the create modal form -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            // Add click event listener to each button
            deleteButtons.forEach(button => {
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
