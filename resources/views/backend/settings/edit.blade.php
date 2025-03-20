@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Business Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Business Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Business Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="site_name">Site Name</label>
                                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name) }}">
                                            <small class="form-text text-muted">This name will appear in the footer and other places if no logo is uploaded</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="site_title">Site Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="site_title" name="site_title" value="{{ old('site_title', $settings->site_title) }}" required>
                                            <small class="form-text text-muted">This title will appear in the browser tab</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="copyright_text">Copyright Text</label>
                                    <textarea class="form-control" id="copyright_text" name="copyright_text" rows="3">{{ old('copyright_text', $settings->copyright_text) }}</textarea>
                                    <small class="form-text text-muted">This text will appear in the footer</small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="favicon">Favicon</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="favicon" name="favicon" accept=".ico,.png,.jpg,.jpeg,.gif,.svg,.webp">
                                                    <label class="custom-file-label" for="favicon">Choose file</label>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">Supported formats: ICO, PNG, JPG, GIF, SVG, WEBP</small>
                                            @if($settings->favicon)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Current Favicon" class="img-thumbnail" style="max-width: 50px;">
                                                </div>
                                            @endif
                                            @error('favicon')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logo">Logo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="logo" name="logo" accept=".png,.jpg,.jpeg,.gif,.svg,.webp">
                                                    <label class="custom-file-label" for="logo">Choose file</label>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">Supported formats: PNG, JPG, GIF, SVG, WEBP</small>
                                            @if($settings->logo)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Current Logo" class="img-thumbnail" style="max-width: 200px;">
                                                </div>
                                            @endif
                                            @error('logo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apple_store_link">Apple App Store Link</label>
                                            <input type="url" class="form-control" id="apple_store_link" name="apple_store_link" value="{{ old('apple_store_link', $settings->apple_store_link) }}">
                                            <small class="form-text text-muted">Link to your app on the Apple App Store</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="google_play_link">Google Play Store Link</label>
                                            <input type="url" class="form-control" id="google_play_link" name="google_play_link" value="{{ old('google_play_link', $settings->google_play_link) }}">
                                            <small class="form-text text-muted">Link to your app on the Google Play Store</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Social Media Links</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebook_link">
                                                        <i class="fab fa-facebook"></i> Facebook Link
                                                    </label>
                                                    <input type="url" class="form-control" id="facebook_link" name="facebook_link" value="{{ old('facebook_link', $settings->facebook_link) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="twitter_link">
                                                        <i class="fab fa-twitter"></i> Twitter Link
                                                    </label>
                                                    <input type="url" class="form-control" id="twitter_link" name="twitter_link" value="{{ old('twitter_link', $settings->twitter_link) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="instagram_link">
                                                        <i class="fab fa-instagram"></i> Instagram Link
                                                    </label>
                                                    <input type="url" class="form-control" id="instagram_link" name="instagram_link" value="{{ old('instagram_link', $settings->instagram_link) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="whatsapp_link">
                                                        <i class="fab fa-whatsapp"></i> WhatsApp Link
                                                    </label>
                                                    <input type="url" class="form-control" id="whatsapp_link" name="whatsapp_link" value="{{ old('whatsapp_link', $settings->whatsapp_link) }}">
                                                    <small class="form-text text-muted">Format: https://wa.me/1234567890</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Save Settings</button>
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

@push('scripts')
<script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endpush
@endsection
