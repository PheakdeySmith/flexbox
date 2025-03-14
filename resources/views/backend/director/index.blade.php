@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-film mr-2"></i>Directors</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
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
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Director Management</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createDirectorModal">
                                <i class="fas fa-plus mr-1"></i> Add New Director
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="directorsTable" class="table table-bordered table-striped table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Name</th>
                                    <th width="35%">Biography</th>
                                    <th width="15%">Profile Image</th>
                                    <th width="10%">Movies</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($directors as $director)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $director->name }}</strong>
                                        </td>
                                        <td>{{ Str::limit($director->biography, 100) }}</td>
                                        <td class="text-center">
                                            @if($director->profile_photo)
                                              <img src="{{ $director->profile_photo }}" alt="{{ $director->name }}" width="50" class="img-thumbnail">
                                            @else
                                              <span class="badge badge-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info">{{ $director->movies->count() }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('director.show', $director->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                    data-toggle="modal" data-target="#editDirectorModal"
                                                    data-id="{{ $director->id }}"
                                                    data-name="{{ $director->name }}"
                                                    data-biography="{{ $director->biography }}"
                                                    data-profile-photo="{{ $director->profile_photo }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                    data-id="{{ $director->id }}"
                                                    data-url="{{ route('director.destroy', $director->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Create Director Modal -->
    @include('backend.director.create')

    <!-- Edit Director Modal -->
    @include('backend.director.edit')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            $('#directorsTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [
                    { "orderable": false, "targets": [3, 5] }
                ]
            });

            // Delete Director Functionality
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const directorId = this.getAttribute('data-id');
                    const deleteUrl = this.getAttribute('data-url');

                    Swal.fire({
                        title: 'Delete Director',
                        text: 'Are you sure you want to delete this director?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then(result => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = deleteUrl;
                            form.style.display = 'none';

                            form.appendChild(createInput('_token', '{{ csrf_token() }}'));
                            form.appendChild(createInput('_method', 'DELETE'));

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });

            // Helper function to create input elements
            function createInput(name, value) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                return input;
            }
        });
    </script>
@endsection
