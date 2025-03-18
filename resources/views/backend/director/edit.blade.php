@extends('backend.layouts.app')

@section('content')
<style>
    /* Improve card styling */
    .director-card {
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
    }

    .director-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    /* Improve image containers */
    .profile-container {
        height: 250px;
        overflow: hidden;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Director: {{ $director->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('director.index') }}">Directors</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Director Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{ route('director.update', $director->id) }}" method="POST" id="directorForm">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">
                                                <i class="fas fa-user mr-1"></i> Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $director->name) }}" placeholder="Enter director name" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="birth_date">
                                                <i class="fas fa-calendar-alt mr-1"></i> Birth Date
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                                    value="{{ old('birth_date', $director->birth_date ? $director->birth_date->format('Y-m-d') : '') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile_photo">
                                                <i class="fas fa-image mr-1"></i> Profile Photo URL
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="profile_photo" name="profile_photo"
                                                    value="{{ old('profile_photo', $director->profile_photo) }}" placeholder="https://example.com/photo.jpg">
                                            </div>
                                            <div id="profile-photo-preview" class="mt-2 text-center" style="{{ $director->profile_photo ? '' : 'display: none;' }}">
                                                <img src="{{ $director->profile_photo }}" alt="{{ $director->name }}" class="img-thumbnail" style="max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="biography">
                                                <i class="fas fa-align-left mr-1"></i> Biography
                                            </label>
                                            <textarea class="form-control" id="biography" name="biography" rows="5"
                                                placeholder="Enter director biography">{{ old('biography', $director->biography) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save mr-1"></i> Update Director
                                        </button>
                                        <a href="{{ route('director.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times mr-1"></i> Cancel
                                        </a>
                                    </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview profile photo when URL changes
        document.getElementById('profile_photo').addEventListener('input', function() {
            const photoUrl = this.value.trim();
            const previewContainer = document.getElementById('profile-photo-preview');
            const previewImg = previewContainer.querySelector('img');

            if (photoUrl) {
                previewImg.src = photoUrl;
                previewContainer.style.display = 'block';
            } else {
                previewImg.src = '';
                previewContainer.style.display = 'none';
            }
        });
    });
</script>
@endsection
