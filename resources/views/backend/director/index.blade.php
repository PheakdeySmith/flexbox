@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Directors</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Directors</li>
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
                                <i class="fas fa-plus"></i> Add New Director
                            </button>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Director Management</h3>
                            </div>

                            <div class="card-body">
                                <table id="directorsTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Biography</th>
                                            <th>Profile Image</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($directors as $director)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $director->name }}</td>
                                                <td>{{ Str::limit($director->biography, 50) }}</td>
                                                <td>
                                                    @if ($director->profile_photo)
                                                        <img src="{{ asset('storage/' . $director->profile_photo) }}"
                                                            width="50" alt="Profile Photo">
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>
                                                <td>{{ $director->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $director->id }}"
                                                        data-name="{{ $director->name }}"
                                                        data-biography="{{ $director->biography }}"
                                                        data-profile-photo="{{ $director->profile_photo }}">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $director->id }}"
                                                        data-url="{{ route('director.destroy', $director->id) }}">
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

    @include('backend.director.create')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            // Add click event listener to each button
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const actorId = this.getAttribute('data-id');
                    const deleteUrl = this.getAttribute('data-url');

                    // Show SweetAlert2 confirmation
                    Swal.fire({
                        title: 'Delete Director',
                        text: 'Are you sure you want to delete this director?',
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
    </script>
@endsection

<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Director</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editDirectorForm" action="{{ route('director.update', ':id') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="director_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name"
                            placeholder="Enter director's name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_biography">Biography</label>
                        <textarea class="form-control" id="edit_biography" name="biography" placeholder="Enter director's biography"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_profile_photo">Profile Photo</label>
                        <input type="file" class="form-control-file" id="edit_profile_photo" name="profile_photo">
                        <br>
                        <img id="current_photo" src="" width="100" class="rounded mt-2" alt="Director Profile">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#editModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const { id, name, biography, profilePhoto } = button.data();

            const modal = $(this);

            // Update the form action URL
            modal.find('#editDirectorForm').attr('action', `/backend/director/${id}`);
            modal.find('#edit_id').val(id);
            modal.find('#edit_name').val(name);
            modal.find('#edit_biography').val(biography);

            // Set profile photo preview
            const preview = modal.find('#current_photo');
            preview.attr('src', profilePhoto ? `/storage/${profilePhoto}` : 'https://via.placeholder.com/100');
        });

        // Preview selected profile photo
        document.getElementById('edit_profile_photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('current_photo').src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                document.getElementById('current_photo').src = 'https://via.placeholder.com/100';
            }
        });
    });
</script>
