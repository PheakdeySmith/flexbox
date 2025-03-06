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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Actors</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Flash Message Display -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
                                <i class="fas fa-plus"></i> Add New Actor
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Actor Management</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Biography</th>
                                            <th>Profile Photo</th>
                                            <th>Date of Birth</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($actors ?? [] as $actor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $actor->name }}</td>
                                                <td>{{ $actor->biography }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/actors/' . $actor->profile_photo) }}"
                                                        width="50" height="50" class="rounded-circle">
                                                </td>
                                                <td>{{ $actor->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#editModal" data-id="{{ $actor->id }}"
                                                        data-name="{{ $actor->name }}"
                                                        data-biography="{{ $actor->biography }}"
                                                        data-profile-photo="{{ $actor->profile_photo }}"
                                                        data-dob="{{ $actor->birth_date }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <!-- Delete Button -->
                                                    <a href="#" class="btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $actor->id }}"
                                                        data-url="{{ route('actor.destroy', $actor->id) }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No actors found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Edit Modal -->
    @include('backend.actor.edit')
    @include('backend.actor.create')




    <!-- Delete Button Script -->
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
