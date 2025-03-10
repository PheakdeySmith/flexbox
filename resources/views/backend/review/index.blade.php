@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reviews</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Reviews</li>
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
                            <h3 class="card-title">Review Management</h3>
                            <div class="card-tools">
                                <a href="{{ route('review.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New Review
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Movie</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reviews as $review)
                                        <tr>
                                            <td>{{ $review->id }}</td>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ $review->movie->title }}</td>
                                            <td>
                                                <div class="text-warning">
                                                    @for($i = 1; $i <= 10; $i++)
                                                        @if($i <= $review->rating)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                    ({{ $review->rating }}/10)
                                                </div>
                                            </td>
                                            <td>
                                                @if($review->is_approved)
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                                @if($review->contains_spoilers)
                                                    <span class="badge badge-danger">Spoilers</span>
                                                @endif
                                            </td>
                                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('review.show', $review->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('review.edit', $review->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('review.toggle-approval', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-{{ $review->is_approved ? 'secondary' : 'success' }} btn-sm">
                                                        <i class="fas fa-{{ $review->is_approved ? 'times' : 'check' }}"></i>
                                                        {{ $review->is_approved ? 'Unapprove' : 'Approve' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No reviews found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $reviews->links() }}
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
