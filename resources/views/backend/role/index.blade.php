@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
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

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Role Management</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ordersTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm view-btn"
                                                        data-toggle="modal" data-target="#viewModal"
                                                        data-role="{{ $role->name }}">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>

                                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $role->id }}"
                                                        data-name="{{ $role->name }}"
                                                        data-action="{{ route('role.update', $role->id) }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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

    <!-- Create Order Modal -->
    @include('backend.order.create')
@endsection

@section('scripts')
    <script>
        $(function() {
            $("#ordersTable").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
@endsection
