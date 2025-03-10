@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">View User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $user->name }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($user->user_profile)
                                        <img src="{{ Storage::url($user->user_profile) }}" alt="{{ $user->name }}" class="img-fluid mb-3 rounded">
                                    @else
                                        <div class="alert alert-secondary text-center py-5">
                                            <i class="fas fa-user fa-5x mb-3"></i>
                                            <p>No profile photo available</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 30%">Name</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td>
                                                <span class="badge badge-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'moderator' ? 'warning' : 'info') }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email Verified</th>
                                            <td>
                                                @if($user->email_verified_at)
                                                    <span class="badge badge-success">Verified on {{ $user->email_verified_at->format('M d, Y H:i') }}</span>
                                                @else
                                                    <span class="badge badge-warning">Not Verified</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Created: {{ $user->created_at->format('M d, Y H:i') }} | Last Updated: {{ $user->updated_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
