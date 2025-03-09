@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-film mr-2"></i>Add New Movie</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('movie.index') }}"><i class="fas fa-video"></i> Movies</a></li>
                        <li class="breadcrumb-item active">Add New Movie</li>
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Movie Information</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
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

                            <form action="{{ route('movie.store') }}" method="POST" id="movieForm">
                                @csrf

                                <!-- Form content organized with tabs -->
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <ul class="nav nav-tabs" id="movieTabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" id="tmdb-search-tab" data-toggle="tab" href="#tmdb-search" role="tab" aria-controls="tmdb-search" aria-selected="false">
                                                    <i class="fas fa-search mr-1"></i> TMDB Search
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">
                                                    <i class="fas fa-info-circle mr-1"></i> Basic Information
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="media-tab" data-toggle="tab" href="#media" role="tab" aria-controls="media" aria-selected="false">
                                                    <i class="fas fa-photo-video mr-1"></i> Media & Links
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" role="tab" aria-controls="additional" aria-selected="false">
                                                    <i class="fas fa-cogs mr-1"></i> Additional Details
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content" id="movieTabContent">
                                    <!-- TMDB Search Tab -->
                                    <div class="tab-pane fade" id="tmdb-search" role="tabpanel" aria-labelledby="tmdb-search-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle mr-1"></i> Search for movies on TMDB.
                                                    <button type="button" id="test-tmdb-connection" class="btn btn-sm btn-outline-warning float-right">
                                                        <i class="fas fa-plug"></i> Test Connection
                                                    </button>
                                                </div>

                                        <div class="form-group">
                                                    <label for="tmdb-search-input">
                                                        <i class="fas fa-search mr-1"></i> Search for a Movie
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="tmdb-search-input" placeholder="Enter movie title...">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-primary" id="tmdb-search-button">
                                                                <i class="fas fa-search"></i> Search
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="tmdb-search-loading" class="text-center p-3 d-none">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                    <p class="mt-2">Searching TMDB...</p>
                                                </div>

                                                <div id="tmdb-search-results" class="row mt-3">
                                                    <!-- Search results will be displayed here -->
                                                </div>

                                                <div id="tmdb-no-results" class="alert alert-warning d-none">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i> No results found. Please try a different search term.
                                                </div>

                                                <div id="tmdb-error" class="alert alert-danger d-none">
                                                    <i class="fas fa-times-circle mr-1"></i> An error occurred while searching. Please try again.
                                                    <div id="tmdb-error-details" class="mt-2 small d-none">
                                                        <hr>
                                                        <p class="mb-1"><strong>Error Details:</strong></p>
                                                        <pre id="tmdb-error-message" class="p-2 bg-light text-danger"></pre>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Basic Information Tab -->
                                    <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                        <div class="form-group">
                                                    <label for="title">
                                                        <i class="fas fa-heading mr-1"></i> Title
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-film"></i></span>
                                                        </div>
                                            <input type="text" class="form-control" id="title" name="title"
                                                value="{{ old('title') }}" placeholder="Enter movie title" required>
                                        </div>
                                                </div>

                                        <div class="form-group">
                                                    <label for="type">
                                                        <i class="fas fa-photo-video mr-1"></i> Type
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                        </div>
                                            <select class="form-control" id="type" name="type" required>
                                                            <option value="">-- Select Type --</option>
                                                <option value="movie" {{ old('type') == 'movie' ? 'selected' : '' }}>Movie</option>
                                                <option value="tv_series" {{ old('type') == 'tv_series' ? 'selected' : '' }}>TV Series</option>
                                            </select>
                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">
                                                        <i class="fas fa-align-left mr-1"></i> Description
                                                    </label>
                                                    <textarea class="form-control" id="description" name="description" rows="5"
                                                        placeholder="Enter movie description">{{ old('description') }}</textarea>
                                                    <small class="form-text text-muted">Provide a compelling description for this title</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                        <div class="form-group">
                                                    <label for="release_date">
                                                        <i class="fas fa-calendar-alt mr-1"></i> Release Date
                                                    </label>
                                                    <div class="input-group date" id="releaseDatePicker" data-target-input="nearest">
                                                        <div class="input-group-prepend" data-target="#releaseDatePicker" data-toggle="datetimepicker">
                                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                        </div>
                                            <input type="date" class="form-control" id="release_date" name="release_date"
                                                value="{{ old('release_date') }}">
                                        </div>
                                                </div>

                                        <div class="form-group">
                                                    <label for="duration">
                                                        <i class="fas fa-clock mr-1"></i> Duration (minutes)
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                                                        </div>
                                            <input type="number" class="form-control" id="duration" name="duration"
                                                value="{{ old('duration') }}" placeholder="Enter duration in minutes">
                                        </div>
                                                </div>

                                        <div class="form-group">
                                                    <label for="tmdb_id">
                                                        <i class="fas fa-database mr-1"></i> TMDB ID
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="tmdb_id" name="tmdb_id"
                                                            value="{{ old('tmdb_id') }}" placeholder="Enter TMDB ID (optional)">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-info" id="fetchTmdbBtn" title="Fetch data from TMDB">
                                                                <i class="fas fa-sync-alt"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <small class="form-text text-muted">Enter TMDB ID to auto-fill movie information</small>
                                        </div>

                                        <div class="form-group">
                                                    <label for="imdb_rating">
                                                        <i class="fas fa-star mr-1"></i> IMDb Rating
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-star-half-alt"></i></span>
                                                        </div>
                                            <input type="number" step="0.1" min="0" max="10" class="form-control" id="imdb_rating"
                                                name="imdb_rating" value="{{ old('imdb_rating') }}" placeholder="Enter IMDb rating">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Media & Links Tab -->
                                    <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                                        <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                                    <label for="poster_url">
                                                        <i class="fas fa-image mr-1"></i> Poster URL
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                                        </div>
                                            <input type="url" class="form-control" id="poster_url" name="poster_url"
                                                value="{{ old('poster_url') }}" placeholder="Enter poster URL">
                                        </div>
                                                    <div class="mt-2 poster-preview d-none">
                                                        <div class="card">
                                                            <div class="card-body text-center p-2">
                                                                <img src="" id="poster_preview" alt="Poster Preview" class="img-fluid img-thumbnail" style="max-height: 200px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                        <div class="form-group">
                                                    <label for="backdrop_url">
                                                        <i class="fas fa-image mr-1"></i> Backdrop URL
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                                        </div>
                                            <input type="url" class="form-control" id="backdrop_url" name="backdrop_url"
                                                value="{{ old('backdrop_url') }}" placeholder="Enter backdrop URL">
                                        </div>
                                                    <div class="mt-2 backdrop-preview d-none">
                                                        <div class="card">
                                                            <div class="card-body text-center p-2">
                                                                <img src="" id="backdrop_preview" alt="Backdrop Preview" class="img-fluid img-thumbnail" style="max-height: 150px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                        <div class="form-group">
                                                    <label for="trailer_url">
                                                        <i class="fas fa-video mr-1"></i> Trailer URL
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                                        </div>
                                            <input type="url" class="form-control" id="trailer_url" name="trailer_url"
                                                            value="{{ old('trailer_url') }}" placeholder="Enter trailer URL (YouTube, Vimeo, etc.)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Details Tab -->
                                    <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price">
                                                        <i class="fas fa-money-bill mr-1"></i> Price
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                        </div>
                                                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                                                            value="{{ old('price') }}" placeholder="Enter price">
                                                    </div>
                                                </div>

                                        <div class="form-group">
                                                    <label for="country">
                                                        <i class="fas fa-globe mr-1"></i> Country
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                                        </div>
                                            <input type="text" class="form-control" id="country" name="country"
                                                value="{{ old('country') }}" placeholder="Enter country">
                                        </div>
                                                </div>

                                        <div class="form-group">
                                                    <label for="language">
                                                        <i class="fas fa-language mr-1"></i> Language
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                                        </div>
                                            <input type="text" class="form-control" id="language" name="language"
                                                value="{{ old('language') }}" placeholder="Enter language">
                                        </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                        <div class="form-group">
                                                    <label for="maturity_rating">
                                                        <i class="fas fa-user-shield mr-1"></i> Maturity Rating
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-exclamation-triangle"></i></span>
                                                        </div>
                                            <select class="form-control" id="maturity_rating" name="maturity_rating">
                                                            <option value="">-- Select Rating --</option>
                                                            <option value="G" {{ old('maturity_rating') == 'G' ? 'selected' : '' }}>G (General Audiences)</option>
                                                            <option value="PG" {{ old('maturity_rating') == 'PG' ? 'selected' : '' }}>PG (Parental Guidance Suggested)</option>
                                                            <option value="PG-13" {{ old('maturity_rating') == 'PG-13' ? 'selected' : '' }}>PG-13 (Parents Strongly Cautioned)</option>
                                                            <option value="R" {{ old('maturity_rating') == 'R' ? 'selected' : '' }}>R (Restricted)</option>
                                                            <option value="NC-17" {{ old('maturity_rating') == 'NC-17' ? 'selected' : '' }}>NC-17 (Adults Only)</option>
                                            </select>
                                        </div>
                                                </div>

                                        <div class="form-group">
                                                    <label for="status">
                                                        <i class="fas fa-toggle-on mr-1"></i> Status
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                                        </div>
                                            <select class="form-control" id="status" name="status" required>
                                                            <option value="">-- Select Status --</option>
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                                </div>

                                        <div class="form-group">
                                                    <div class="card">
                                                        <div class="card-body">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="is_free" name="is_free" value="1"
                                                    {{ old('is_free') ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="is_free">
                                                                    <i class="fas fa-gift mr-1"></i> Free to Watch
                                                                </label>
                                                            </div>
                                                            <small class="form-text text-muted mt-2">Enable this option to make this movie available for free.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="card card-footer">
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('movie.index') }}" class="btn btn-secondary">
                                                    <i class="fas fa-arrow-left mr-1"></i> Cancel
                                                </a>
                                                <div>
                                                    <button type="reset" class="btn btn-warning">
                                                        <i class="fas fa-undo mr-1"></i> Reset
                                                    </button>
                                                    <button type="submit" class="btn btn-primary ml-2">
                                                        <i class="fas fa-save mr-1"></i> Save Movie
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
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
@endsection

{{-- Move script from @push to directly in the template --}}
@section('footer_scripts')
<script>

    // Test TMDB connection when clicking the test button
    $('#test-tmdb-connection').on('click', function() {
        console.log('Test button clicked');

        $.ajax({
            url: 'https://api.themoviedb.org/3/configuration',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4Yzc1NjUxNzIxMTE4YzJiMWExYTIxMjJmNWZmZWU3YSIsIm5iZiI6MTc0MTE0MDM5MS41NjQsInN1YiI6IjY3YzdiMWE3MGEwMDU3NjE0M2MyOGIwYyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.k1w1YejJkhyptQRCP2NmVAQSNACbTHSBN_PMI0z8BPA',
                'Content-Type': 'application/json'
            },
            success: function(response) {
                console.log('API connection successful', response);
                window.showSuccessToast('TMDB API connection successful!');
            },
            error: function(xhr, status, error) {
                console.error('API connection failed', error);
                window.showErrorToast('Connection failed: ' + error);
            }
        });
    });

    // Search TMDB when clicking the search button
    $('#tmdb-search-button').on('click', function() {
        console.log('Search button clicked');
        var query = $('#tmdb-search-input').val().trim();

        if (query.length === 0) {
            window.showWarningToast('Please enter a search term');
            return;
        }

        // Show loading, hide previous results
        $('#tmdb-search-results').empty();
        $('#tmdb-no-results').addClass('d-none');
        $('#tmdb-error').addClass('d-none');
        $('#tmdb-search-loading').removeClass('d-none');

        $.ajax({
            url: 'https://api.themoviedb.org/3/search/movie',
            type: 'GET',
            data: {
                query: query,
                include_adult: false,
                language: 'en-US',
                page: 1
            },
            headers: {
                'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4Yzc1NjUxNzIxMTE4YzJiMWExYTIxMjJmNWZmZWU3YSIsIm5iZiI6MTc0MTE0MDM5MS41NjQsInN1YiI6IjY3YzdiMWE3MGEwMDU3NjE0M2MyOGIwYyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.k1w1YejJkhyptQRCP2NmVAQSNACbTHSBN_PMI0z8BPA',
                'Content-Type': 'application/json'
            },
            success: function(data) {
                console.log('Search results', data);
                $('#tmdb-search-loading').addClass('d-none');

                if (data.results && data.results.length > 0) {
                    // Display results
                    displayResults(data.results);
                } else {
                    $('#tmdb-no-results').removeClass('d-none');
                }
            },
            error: function(xhr, status, error) {
                console.error('Search failed', error);
                $('#tmdb-search-loading').addClass('d-none');
                $('#tmdb-error').removeClass('d-none');
                $('#tmdb-error-message').text(error);
                $('#tmdb-error-details').removeClass('d-none');
                window.showErrorToast('Search failed: ' + error);
            }
        });
    });

    // Function to display search results
    function displayResults(results) {
        var container = $('#tmdb-search-results');

        // Limit to 8 results
        results = results.slice(0, 8);

        $.each(results, function(index, movie) {
            var posterUrl = movie.poster_path
                ? 'https://image.tmdb.org/t/p/w342' + movie.poster_path
                : '{{ asset('backend/assets/image/no-poster.png') }}';

            var releaseYear = movie.release_date ? movie.release_date.substring(0, 4) : 'Unknown';

            var html = '<div class="col-md-3 mb-4">' +
                '<div class="card h-100">' +
                '<img src="' + posterUrl + '" class="card-img-top" alt="' + movie.title + '" style="height: 300px; object-fit: cover;">' +
                '<div class="card-body">' +
                '<h5 class="card-title">' + movie.title + '</h5>' +
                '<p class="card-text text-muted">' + releaseYear + '</p>' +
                '<button type="button" class="btn btn-sm btn-success w-100 select-movie" data-id="' + movie.id + '">' +
                '<i class="fas fa-check"></i> Select' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>';

            container.append(html);
        });

        // Add click event for select buttons
        $('.select-movie').on('click', function() {
            var movieId = $(this).data('id');
            console.log('Selected movie ID:', movieId);
            fetchMovie(movieId);
        });
    }

    // Function to fetch and populate movie details
    function fetchMovie(id) {
        $.ajax({
            url: 'https://api.themoviedb.org/3/movie/' + id,
            type: 'GET',
            data: {
                append_to_response: 'videos,credits',
                language: 'en-US'
            },
            headers: {
                'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4Yzc1NjUxNzIxMTE4YzJiMWExYTIxMjJmNWZmZWU3YSIsIm5iZiI6MTc0MTE0MDM5MS41NjQsInN1YiI6IjY3YzdiMWE3MGEwMDU3NjE0M2MyOGIwYyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.k1w1YejJkhyptQRCP2NmVAQSNACbTHSBN_PMI0z8BPA',
                'Content-Type': 'application/json'
            },
            success: function(movie) {
                console.log('Movie details', movie);

                // Fill in the form fields
                $('#tmdb_id').val(movie.id);
                $('#title').val(movie.title);
                $('#release_date').val(movie.release_date || '');
                $('#duration').val(movie.runtime || '');

                // Format IMDb rating to one decimal place with proper rounding
                if (movie.vote_average) {
                    // Convert to number, round to 1 decimal place
                    var rating = parseFloat(movie.vote_average).toFixed(1);
                    $('#imdb_rating').val(rating);
                }

                // Set type based on what we're fetching (this is from the movie endpoint, so it's a movie)
                $('#type').val('movie');

                // Set status to active by default
                $('#status').val('active');

                // Handle poster
                if (movie.poster_path) {
                    var posterUrl = 'https://image.tmdb.org/t/p/original' + movie.poster_path;
                    $('#poster_url').val(posterUrl);
                    $('#poster_preview').attr('src', posterUrl);
                    $('.poster-preview').removeClass('d-none');
                }

                // Handle backdrop
                if (movie.backdrop_path) {
                    var backdropUrl = 'https://image.tmdb.org/t/p/original' + movie.backdrop_path;
                    $('#backdrop_url').val(backdropUrl);
                    $('#backdrop_preview').attr('src', backdropUrl);
                    $('.backdrop-preview').removeClass('d-none');
                }

                // Description
                $('#description').val(movie.overview || '');

                // Find trailer if available
                if (movie.videos && movie.videos.results && movie.videos.results.length > 0) {
                    var trailer = movie.videos.results.find(function(video) {
                        return video.type === 'Trailer' && video.site === 'YouTube';
                    });

                    if (trailer) {
                        $('#trailer_url').val('https://www.youtube.com/watch?v=' + trailer.key);
                    }
                }

                // Additional info
                if (movie.production_countries && movie.production_countries.length > 0) {
                    $('#country').val(movie.production_countries[0].name);
                }

                if (movie.spoken_languages && movie.spoken_languages.length > 0) {
                    $('#language').val(movie.spoken_languages[0].english_name || movie.spoken_languages[0].name);
                }

                // Switch to basic tab
                $('#basic-tab').tab('show');

                // Show success message using the SweetAlert toast
                window.showSuccessToast('Movie data loaded successfully!');
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch movie details', error);
                window.showErrorToast('Failed to fetch movie details: ' + error);
            }
        });
    }
</script>
@endsection
