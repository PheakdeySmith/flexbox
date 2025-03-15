@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Favorite Entry Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('favorite.index') }}">Favorites</a></li>
                        <li class="breadcrumb-item active">View Favorite Entry</li>
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
                            <h3 class="card-title">Favorite Entry #{{ $favorite->id }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('favorite.edit', $favorite->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('favorite.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">User Information</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 30%">User ID</th>
                                                    <td>{{ $favorite->user->id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Name</th>
                                                    <td>{{ $favorite->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $favorite->user->email }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Movie Information</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 30%">Movie ID</th>
                                                    <td>{{ $favorite->movie->id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Title</th>
                                                    <td>{{ $favorite->movie->title }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Release Date</th>
                                                    <td>{{ $favorite->movie->release_date ? $favorite->movie->release_date->format('F d, Y') : 'N/A' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Favorite Details</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 30%">Added At</th>
                                                    <td>{{ $favorite->created_at->format('F d, Y H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Created At</th>
                                                    <td>{{ $favorite->created_at->format('F d, Y H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Updated At</th>
                                                    <td>{{ $favorite->updated_at->format('F d, Y H:i:s') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger delete-btn" data-id="{{ $favorite->id }}"
                                data-url="{{ route('favorite.destroy', $favorite->id) }}">
                                <i class="fas fa-trash"></i> Delete Favorite
                            </button>
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
                const favoriteId = this.getAttribute('data-id');
                const deleteUrl = this.getAttribute('data-url');

                // Show SweetAlert2 confirmation
                Swal.fire({
                    title: 'Delete Favorite',
                    text: 'Are you sure you want to delete this favorite?',
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