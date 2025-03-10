@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Review</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('review.index') }}">Reviews</a></li>
                        <li class="breadcrumb-item active">Add Review</li>
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
                            <h3 class="card-title">Add New Review</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="movie_id">Movie</label>
                                    <select name="movie_id" id="movie_id" class="form-control @error('movie_id') is-invalid @enderror" required>
                                        <option value="">Select Movie</option>
                                        @foreach($movies as $movie)
                                            <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                                                {{ $movie->title }} ({{ $movie->release_date ? $movie->release_date->format('Y') : 'N/A' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('movie_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="rating">Rating (1-10)</label>
                                    <input type="number" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" min="1" max="10" value="{{ old('rating') }}" required>
                                    @error('rating')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror" rows="5">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="contains_spoilers" name="contains_spoilers" value="1" {{ old('contains_spoilers') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="contains_spoilers">Contains Spoilers</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="is_approved" name="is_approved" value="1" {{ old('is_approved', true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_approved">Approved</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('review.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
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
@endsection
