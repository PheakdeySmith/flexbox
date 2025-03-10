@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Review Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('review.index') }}">Reviews</a></li>
                        <li class="breadcrumb-item active">View Review</li>
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
                            <h3 class="card-title">Review #{{ $review->id }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('review.edit', $review->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('review.index') }}" class="btn btn-secondary btn-sm">
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
                                                    <td>{{ $review->user->id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Name</th>
                                                    <td>{{ $review->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $review->user->email }}</td>
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
                                                    <td>{{ $review->movie->id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Title</th>
                                                    <td>{{ $review->movie->title }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Release Date</th>
                                                    <td>{{ $review->movie->release_date ? $review->movie->release_date->format('F d, Y') : 'N/A' }}</td>
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
                                            <h3 class="card-title">Review Details</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <h5>Rating</h5>
                                                <div class="text-warning">
                                                    @for($i = 1; $i <= 10; $i++)
                                                        @if($i <= $review->rating)
                                                            <i class="fas fa-star fa-lg"></i>
                                                        @else
                                                            <i class="far fa-star fa-lg"></i>
                                                        @endif
                                                    @endfor
                                                    <span class="ml-2">{{ $review->rating }}/10</span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <h5>Comment</h5>
                                                <div class="p-3 bg-light rounded">
                                                    @if($review->comment)
                                                        {!! nl2br(e($review->comment)) !!}
                                                    @else
                                                        <em>No comment provided.</em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <h5>Status</h5>
                                                <div>
                                                    @if($review->is_approved)
                                                        <span class="badge badge-success">Approved</span>
                                                    @else
                                                        <span class="badge badge-warning">Pending Approval</span>
                                                    @endif

                                                    @if($review->contains_spoilers)
                                                        <span class="badge badge-danger">Contains Spoilers</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <h5>Timestamps</h5>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width: 30%">Created At</th>
                                                        <td>{{ $review->created_at->format('F d, Y H:i:s') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Updated At</th>
                                                        <td>{{ $review->updated_at->format('F d, Y H:i:s') }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <form action="{{ route('review.toggle-approval', $review->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-{{ $review->is_approved ? 'secondary' : 'success' }}">
                                    <i class="fas fa-{{ $review->is_approved ? 'times' : 'check' }}"></i>
                                    {{ $review->is_approved ? 'Unapprove' : 'Approve' }}
                                </button>
                            </form>
                            <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this review?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
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
