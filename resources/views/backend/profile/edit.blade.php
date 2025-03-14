@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-edit mr-2"></i>Edit Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if(Auth::user()->profile_photo)
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ Auth::user()->profile_photo }}"
                                        alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg"
                                        alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                            <p class="text-muted text-center">
                                @if(Auth::user()->isAdmin())
                                    Administrator
                                @elseif(Auth::user()->isModerator())
                                    Moderator
                                @else
                                    Member
                                @endif
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Member Since</b> <a class="float-right">{{ Auth::user()->created_at->format('M d, Y') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Last Updated</b> <a class="float-right">{{ Auth::user()->updated_at->format('M d, Y') }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Account Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                            <hr>

                            <strong><i class="fas fa-user-shield mr-1"></i> Role</strong>
                            <p class="text-muted">
                                @if(Auth::user()->isAdmin())
                                    Administrator
                                @else
                                    Member
                                @endif
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile Information</a></li>
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Change Password</a></li>
                                <li class="nav-item"><a class="nav-link" href="#photo" data-toggle="tab">Profile Photo</a></li>
                                <li class="nav-item"><a class="nav-link text-danger" href="#delete" data-toggle="tab">Delete Account</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Profile Information Tab -->
                                <div class="active tab-pane" id="profile">
                                    @if(session('status') === 'profile-updated')
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                                            Your profile information has been updated.
                                        </div>
                                    @endif

                                    <form action="{{ route('profile.update') }}" method="POST" class="form-horizontal">
                                        @csrf
                                        @method('patch')

                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save mr-1"></i> Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- Change Password Tab -->
                                <div class="tab-pane" id="password">
                                    @if(session('status') === 'password-updated')
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                                            Your password has been updated.
                                        </div>
                                    @endif

                                    <form action="{{ route('password.update') }}" method="POST" class="form-horizontal">
                                        @csrf
                                        @method('put')

                                        <div class="form-group row">
                                            <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                                @error('current_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">New Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-key mr-1"></i> Update Password
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- Profile Photo Tab -->
                                <div class="tab-pane" id="photo">
                                    @if(session('status') === 'photo-updated')
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                                            Your profile photo has been updated.
                                        </div>
                                    @endif

                                    <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        @method('patch')

                                        <div class="form-group row">
                                            <label for="profile_photo" class="col-sm-3 col-form-label">Profile Photo</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input @error('user_profile') is-invalid @enderror" id="profile_photo" name="user_profile" accept="image/*">
                                                    <label class="custom-file-label" for="profile_photo">Choose file</label>
                                                    @error('user_profile')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <small class="form-text text-muted">Recommended size: 200x200 pixels. Maximum file size: 2MB.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <div class="mt-2 mb-3">
                                                    <div id="preview-container" class="d-none">
                                                        <img id="preview-image" src="#" alt="Preview" class="img-fluid img-thumbnail" style="max-height: 200px;">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-upload mr-1"></i> Upload Photo
                                                </button>
                                                @if(Auth::user()->profile_photo)
                                                    <button type="button" class="btn btn-danger ml-2" id="remove-photo-btn">
                                                        <i class="fas fa-trash mr-1"></i> Remove Photo
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- Delete Account Tab -->
                                <div class="tab-pane" id="delete">
                                    <div class="alert alert-danger">
                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Warning!</h5>
                                        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                                    </div>

                                    <form action="{{ route('profile.destroy') }}" method="POST" class="form-horizontal">
                                        @csrf
                                        @method('delete')

                                        <div class="form-group row">
                                            <label for="delete_password" class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="delete_password" name="password" placeholder="Enter your password to confirm" required>
                                                @error('password', 'userDeletion')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                                    <i class="fas fa-user-slash mr-1"></i> Delete Account
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('footer_scripts')
<script>
    $(function () {
        // Preview image before upload
        $('#profile_photo').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-image').attr('src', e.target.result);
                    $('#preview-container').removeClass('d-none');
                }
                reader.readAsDataURL(file);
                $(this).next('.custom-file-label').text(file.name);
            }
        });

        // Remove photo button
        $('#remove-photo-btn').on('click', function() {
            if (confirm('Are you sure you want to remove your profile photo?')) {
                window.location.href = "{{ route('profile.photo.remove') }}";
            }
        });

        // Show active tab based on hash in URL
        if (window.location.hash) {
            $('.nav-pills a[href="' + window.location.hash + '"]').tab('show');
        }

        // Update hash in URL when tab changes
        $('.nav-pills a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        });
    });
</script>
@endsection
