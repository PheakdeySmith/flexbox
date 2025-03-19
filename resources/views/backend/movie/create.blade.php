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
                                            <li class="nav-item">
                                                <a class="nav-link" id="actors-tab" data-toggle="tab" href="#actors" role="tab" aria-controls="actors" aria-selected="false">
                                                    <i class="fas fa-users mr-1"></i> Actors
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="genres-tab" data-toggle="tab" href="#genres" role="tab" aria-controls="genres" aria-selected="false">
                                                    <i class="fas fa-tags mr-1"></i> Genres
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="directors-tab" data-toggle="tab" href="#directors" role="tab" aria-controls="directors" aria-selected="false">
                                                    <i class="fas fa-user-tie mr-1"></i> Directors
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
                                                    {{-- <div id="trailer-preview-container" class="mt-3 d-none">
                                                        <div class="card">
                                                            <div class="card-body p-0">
                                                                <div class="embed-responsive embed-responsive-16by9">
                                                                    <iframe id="trailer-preview-iframe" class="embed-responsive-item" src="" allowfullscreen></iframe>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer p-2">
                                                                <button type="button" class="btn btn-sm btn-secondary" id="close-trailer-preview">
                                                                    <i class="fas fa-times"></i> Close Preview
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                        <div class="form-group">
                                                    <label for="video_url">
                                                        <i class="fas fa-play-circle mr-1"></i> Video URL (for streaming)
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                                        </div>
                                            <input type="url" class="form-control" id="video_url" name="video_url"
                                                value="{{ old('video_url') }}" placeholder="Enter YouTube video URL for streaming">
                                                    </div>
                                                    <small class="form-text text-muted">Enter the full YouTube URL for streaming the movie</small>
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

                                    <!-- Actors Tab -->
                                    <div class="tab-pane fade" id="actors" role="tabpanel" aria-labelledby="actors-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle mr-1"></i> Actors from the selected movie will be displayed here. Select the ones you want to include.
                                                </div>

                                                <div id="no-movie-selected" class="alert alert-warning">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i> No movie selected yet. Please go to the <a href="#" onclick="$('#tmdb-search-tab').tab('show'); return false;" class="alert-link">TMDB Search tab</a> to select a movie first.
                                                </div>

                                                <!-- Movie Actors Section -->
                                                <div id="movie-actors-container" class="mt-4 d-none">
                                                    <h4 class="mb-3">Actors in <span id="selected-movie-title"></span></h4>
                                                    <div id="movie-actors" class="row">
                                                        <!-- Actor results will be displayed here -->
                                                    </div>
                                                    <div id="no-movie-actors-message" class="alert alert-info d-none">
                                                        <i class="fas fa-info-circle mr-1"></i> No actors found for this movie.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Selected Actors Section -->
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Selected Actors</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id="selected-actors-container">
                                                            <div id="no-selected-actors" class="alert alert-info">
                                                                <i class="fas fa-info-circle mr-1"></i> No actors selected yet. Select actors from above.
                                                            </div>
                                                            <div id="selected-actors-list" class="row">
                                                                <!-- Selected actors will be displayed here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Genres Tab -->
                                    <div class="tab-pane fade" id="genres" role="tabpanel" aria-labelledby="genres-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle mr-1"></i> Genres from the selected movie will be displayed here. Select the ones you want to include.
                                                </div>

                                                <div id="no-movie-selected-genres" class="alert alert-warning">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i> No movie selected yet. Please go to the <a href="#" onclick="$('#tmdb-search-tab').tab('show'); return false;" class="alert-link">TMDB Search tab</a> to select a movie first.
                                                </div>

                                                <!-- Movie Genres Section -->
                                                <div id="movie-genres-container" class="mt-4 d-none">
                                                    <h4 class="mb-3">Genres for <span id="selected-movie-title-genres"></span></h4>
                                                    <div id="movie-genres" class="row">
                                                        <!-- Genre results will be displayed here -->
                                                    </div>
                                                    <div id="no-movie-genres-message" class="alert alert-info d-none">
                                                        <i class="fas fa-info-circle mr-1"></i> No genres found for this movie.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Selected Genres Section -->
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Selected Genres</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id="selected-genres-container">
                                                            <div id="no-selected-genres" class="alert alert-info">
                                                                <i class="fas fa-info-circle mr-1"></i> No genres selected yet. Select genres from above.
                                                            </div>
                                                            <div id="selected-genres-list" class="row">
                                                                <!-- Selected genres will be displayed here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Directors Tab -->
                                    <div class="tab-pane fade" id="directors" role="tabpanel" aria-labelledby="directors-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle mr-1"></i> Directors and crew from the selected movie will be displayed here. Select the ones you want to include.
                                                </div>

                                                <div id="no-movie-selected-directors" class="alert alert-warning">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i> No movie selected yet. Please go to the <a href="#" onclick="$('#tmdb-search-tab').tab('show'); return false;" class="alert-link">TMDB Search tab</a> to select a movie first.
                                                </div>

                                                <!-- Movie Directors Section -->
                                                <div id="movie-directors-container" class="mt-4 d-none">
                                                    <h4 class="mb-3">Directors & Crew for <span id="selected-movie-title-directors"></span></h4>
                                                    <div id="movie-directors" class="row">
                                                        <!-- Director results will be displayed here -->
                                                    </div>
                                                    <div id="no-movie-directors-message" class="alert alert-info d-none">
                                                        <i class="fas fa-info-circle mr-1"></i> No directors found for this movie.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Selected Directors Section -->
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Selected Directors & Crew</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id="selected-directors-container">
                                                            <div id="no-selected-directors" class="alert alert-info">
                                                                <i class="fas fa-info-circle mr-1"></i> No directors selected yet. Select directors from above.
                                                            </div>
                                                            <div id="selected-directors-list" class="row">
                                                                <!-- Selected directors will be displayed here -->
                                                            </div>
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
            selectMovie(movieId);
        });
    }

    // Update the fetchMovie function to include country and language data
    function selectMovie(movieId) {
        // Show loading state
        $('#tmdb-search-results').html('<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2">Loading movie details...</p></div>');

        // Clear any previous notifications
        $('.tmdb-notification').remove();

        // Fetch movie details from TMDB
        $.ajax({
            url: 'https://api.themoviedb.org/3/movie/' + movieId + '?append_to_response=credits,release_dates,videos',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4Yzc1NjUxNzIxMTE4YzJiMWExYTIxMjJmNWZmZWU3YSIsIm5iZiI6MTc0MTE0MDM5MS41NjQsInN1YiI6IjY3YzdiMWE3MGEwMDU3NjE0M2MyOGIwYyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.k1w1YejJkhyptQRCP2NmVAQSNACbTHSBN_PMI0z8BPA',
                'Content-Type': 'application/json'
            },
            success: function(movie) {
                console.log('Movie details:', movie);

                // Fill in the form fields with movie data
                $('#tmdb_id').val(movie.id);
                $('#title').val(movie.title);
                $('#description').val(movie.overview);
                if ($.fn.summernote) {
                    $('#description').summernote('code', movie.overview);
                }
                $('#release_date').val(movie.release_date);
                $('#duration').val(movie.runtime);
                $('#imdb_rating').val(movie.vote_average);
                $('#poster_url').val(movie.poster_path ? 'https://image.tmdb.org/t/p/w500' + movie.poster_path : '');
                $('#backdrop_url').val(movie.backdrop_path ? 'https://image.tmdb.org/t/p/original' + movie.backdrop_path : '');

                // Set country and language if available
                if (movie.production_countries && movie.production_countries.length > 0) {
                    $('#country').val(movie.production_countries[0].name);
                }

                if (movie.spoken_languages && movie.spoken_languages.length > 0) {
                    $('#language').val(movie.spoken_languages[0].english_name || movie.spoken_languages[0].name);
                }

                // Set maturity rating if available
                if (movie.release_dates && movie.release_dates.results) {
                    // Try to find US rating first
                    const usRating = movie.release_dates.results.find(country => country.iso_3166_1 === 'US');
                    if (usRating && usRating.release_dates && usRating.release_dates.length > 0) {
                        const certification = usRating.release_dates[0].certification;
                        if (certification) {
                            $('#maturity_rating').val(certification);
                        }
                    }
                }

                // Set trailer URL if available
                let trailerFound = false;
                if (movie.videos && movie.videos.results && movie.videos.results.length > 0) {
                    console.log('Videos found:', movie.videos.results);

                    // Look for official trailers first
                    let trailer = movie.videos.results.find(video =>
                        video.type === 'Trailer' &&
                        video.site === 'YouTube' &&
                        video.official === true
                    );

                    // If no official trailer, look for any trailer
                    if (!trailer) {
                        trailer = movie.videos.results.find(video =>
                            video.type === 'Trailer' &&
                            video.site === 'YouTube'
                        );
                    }

                    // If still no trailer, use any YouTube video
                    if (!trailer) {
                        trailer = movie.videos.results.find(video => video.site === 'YouTube');
                    }

                    if (trailer) {
                        console.log('Trailer found:', trailer);
                        $('#trailer_url').val('https://www.youtube.com/watch?v=' + trailer.key);
                        trailerFound = true;
                    }
                }

                // Set default values for other fields
                $('#type').val('movie');
                $('#status').val('active');

                // Trigger the input event to update the image previews
                $('#poster_url').trigger('input');
                $('#backdrop_url').trigger('input');

                // Show success message
                $('#tmdb-search-results').html('<div class="alert alert-success"><i class="fas fa-check-circle mr-1"></i> Movie details loaded successfully!</div>');

                // Add notification about trailer
                if (trailerFound) {
                    const trailerNotification = `<div class="alert alert-success mt-3 tmdb-notification">
                        <i class="fas fa-film mr-1"></i> Trailer found and added to the movie.
                        <a href="#" onclick="$('#media-tab').tab('show'); return false;" class="alert-link">
                            Go to Media & Links tab to see it.
                        </a>
                    </div>`;
                    $('#tmdb-search-results').after(trailerNotification);
                } else {
                    const trailerNotification = `<div class="alert alert-warning mt-3 tmdb-notification">
                        <i class="fas fa-exclamation-triangle mr-1"></i> No trailer found for this movie.
                    </div>`;
                    $('#tmdb-search-results').after(trailerNotification);
                }

                // Handle actors
                if (movie.credits && movie.credits.cast && movie.credits.cast.length > 0) {
                    // Store the cast for use in the Actors tab
                    window.movieCast = movie.credits.cast;

                    // Update the Actors tab with the cast
                    updateActorsTab(movie.credits.cast, movie.title);

                    // Automatically select all actors
                    selectAllActors(movie.credits.cast);

                    // Show a notification that actors are available
                    const actorCount = movie.credits.cast.length;
                    const actorNotification = `<div class="alert alert-success mt-3 tmdb-notification">
                        <i class="fas fa-info-circle mr-1"></i> ${actorCount} actors found and automatically selected for this movie.
                        <a href="#" onclick="$('#actors-tab').tab('show'); return false;" class="alert-link">
                            Go to Actors tab to review them.
                        </a>
                    </div>`;
                    $('#tmdb-search-results').after(actorNotification);
                }

                // Handle directors and crew
                if (movie.credits && movie.credits.crew && movie.credits.crew.length > 0) {
                    // Store the crew for use in the Directors tab
                    window.movieCrew = movie.credits.crew;

                    // Update the Directors tab with the crew
                    updateDirectorsTab(movie.credits.crew, movie.title);

                    // Automatically select directors and important crew
                    selectImportantCrew(movie.credits.crew);

                    // Show a notification that directors are available
                    const directorCount = movie.credits.crew.filter(person =>
                        person.job === 'Director' || person.job === 'Producer' || person.job === 'Executive Producer'
                    ).length;

                    if (directorCount > 0) {
                        const directorNotification = `<div class="alert alert-success mt-3 tmdb-notification">
                            <i class="fas fa-info-circle mr-1"></i> ${directorCount} directors and crew members found and automatically selected for this movie.
                            <a href="#" onclick="$('#directors-tab').tab('show'); return false;" class="alert-link">
                                Go to Directors tab to review them.
                            </a>
                        </div>`;
                        $('#tmdb-search-results').after(directorNotification);
                    }
                }

                // Handle genres
                if (movie.genres && movie.genres.length > 0) {
                    // Store the genres for use in the Genres tab
                    window.movieGenres = movie.genres;

                    // Update the Genres tab with the genres
                    updateGenresTab(movie.genres, movie.title);

                    // Automatically select all genres
                    selectAllGenres(movie.genres);

                    // Show a notification that genres are available
                    const genreCount = movie.genres.length;
                    const genreNotification = `<div class="alert alert-success mt-3 tmdb-notification">
                        <i class="fas fa-info-circle mr-1"></i> ${genreCount} genres found and automatically selected for this movie.
                        <a href="#" onclick="$('#genres-tab').tab('show'); return false;" class="alert-link">
                            Go to Genres tab to review them.
                        </a>
                    </div>`;
                    $('#tmdb-search-results').after(genreNotification);
                }

                // Switch to basic tab to show the movie information
                $('#basic-tab').tab('show');
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch movie details:', error);
                $('#tmdb-search-results').html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-1"></i> Failed to fetch movie details: ' + error + '</div>');
            }
        });
    }

    // Update the selectAllActors function to include birth date and biography data
    function selectAllActors(cast) {
        // Clear any previously selected actors
        window.selectedActors = [];

        // Add all actors from the cast to the selected actors
        cast.slice(0, 12).forEach(function(actor) {
            // Fetch additional actor details to get biography and birth date
            fetchActorDetails(actor.id, function(actorDetails) {
                addSelectedActor({
                    id: actor.id,
                    name: actor.name,
                    profile_photo: actor.profile_path ? 'https://image.tmdb.org/t/p/w185' + actor.profile_path : '',
                    character: actor.character || '',
                    birth_date: actorDetails.birthday || '',
                    biography: actorDetails.biography || ''
                });

                // Update the UI to reflect the selected state
                var selectButton = $('.select-actor[data-id="' + actor.id + '"]');
                if (selectButton.length) {
                    selectButton.removeClass('btn-primary').addClass('btn-secondary')
                        .html('<i class="fas fa-check"></i> Selected')
                        .prop('disabled', true);
                }
            });
        });
    }

    // Add a function to fetch actor details from TMDB
    function fetchActorDetails(actorId, callback) {
        $.ajax({
            url: 'https://api.themoviedb.org/3/person/' + actorId,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4Yzc1NjUxNzIxMTE4YzJiMWExYTIxMjJmNWZmZWU3YSIsIm5iZiI6MTc0MTE0MDM5MS41NjQsInN1YiI6IjY3YzdiMWE3MGEwMDU3NjE0M2MyOGIwYyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.k1w1YejJkhyptQRCP2NmVAQSNACbTHSBN_PMI0z8BPA',
                'Content-Type': 'application/json'
            },
            success: function(data) {
                callback(data);
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch actor details:', error);
                // Call the callback with empty data
                callback({});
            }
        });
    }

    // Update the updateActorsTab function to show all actors as selected by default
    function updateActorsTab(cast, movieTitle) {
        // Hide the no movie selected message
        $('#no-movie-selected').addClass('d-none');

        // Show the movie actors container
        $('#movie-actors-container').removeClass('d-none');

        // Set the movie title
        $('#selected-movie-title').text(movieTitle);

        // Clear the movie actors container
        $('#movie-actors').empty();

        // If no cast, show the no actors message
        if (!cast || cast.length === 0) {
            $('#no-movie-actors-message').removeClass('d-none');
            return;
        }

        // Hide the no actors message
        $('#no-movie-actors-message').addClass('d-none');

        // Limit to top 12 actors
        const topCast = cast.slice(0, 12);

        // Add each actor to the container
        $.each(topCast, function(index, actor) {
            var profileUrl = actor.profile_path
                ? 'https://image.tmdb.org/t/p/w185' + actor.profile_path
                : '{{ asset('backend/assets/image/no-profile.png') }}';

            // Check if this actor is already in the selected actors list
            var isSelected = window.selectedActors.some(function(selectedActor) {
                return selectedActor.id === actor.id;
            });

            var buttonClass = isSelected ? 'btn-secondary' : 'btn-primary';
            var buttonText = isSelected ? '<i class="fas fa-check"></i> Selected' : '<i class="fas fa-plus"></i> Select';
            var buttonDisabled = isSelected ? 'disabled' : '';

            var html = '<div class="col-md-3 mb-4">' +
                '<div class="card h-100">' +
                '<img src="' + profileUrl + '" class="card-img-top" alt="' + actor.name + '" style="height: 250px; object-fit: cover;">' +
                '<div class="card-body">' +
                '<h5 class="card-title">' + actor.name + '</h5>' +
                '<p class="card-text text-muted">' + (actor.character ? 'as ' + actor.character : '') + '</p>' +
                '<button type="button" class="btn btn-sm ' + buttonClass + ' w-100 select-actor" ' + buttonDisabled + ' ' +
                'data-id="' + actor.id + '" ' +
                'data-name="' + actor.name + '" ' +
                'data-profile="' + (actor.profile_path ? 'https://image.tmdb.org/t/p/w185' + actor.profile_path : '') + '" ' +
                'data-character="' + (actor.character || '') + '">' +
                buttonText +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>';

            $('#movie-actors').append(html);
        });
    }

    // Initialize the selectedActors array at the beginning of the document ready function
    $(document).ready(function() {
        // Store selected actors
        window.selectedActors = [];
        // Store selected directors
        window.selectedDirectors = [];
        // Store selected genres
        window.selectedGenres = [];

        // Image preview for poster
        $('#poster_url').on('input', function() {
            const url = $(this).val();
            if (url) {
                $('#poster_preview').attr('src', url);
                $('.poster-preview').removeClass('d-none');
            } else {
                $('.poster-preview').addClass('d-none');
            }
        });

        // Image preview for backdrop
        $('#backdrop_url').on('input', function() {
            const url = $(this).val();
            if (url) {
                $('#backdrop_preview').attr('src', url);
                $('.backdrop-preview').removeClass('d-none');
            } else {
                $('.backdrop-preview').addClass('d-none');
            }
        });

        // Trailer preview functionality
        $('#preview-trailer-btn').on('click', function() {
            const trailerUrl = $('#trailer_url').val();
            if (!trailerUrl) {
                window.showWarningToast('Please enter a trailer URL first');
                return;
            }

            // Extract YouTube video ID
            let videoId = '';

            // Match YouTube URLs
            const youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
            const youtubeMatch = trailerUrl.match(youtubeRegex);

            if (youtubeMatch && youtubeMatch[1]) {
                videoId = youtubeMatch[1];
                const embedUrl = 'https://www.youtube.com/embed/' + videoId;
                $('#trailer-preview-iframe').attr('src', embedUrl);
                $('#trailer-preview-container').removeClass('d-none');
            } else {
                window.showErrorToast('Invalid YouTube URL. Please enter a valid YouTube URL.');
            }
        });

        // Close trailer preview
        $('#close-trailer-preview').on('click', function() {
            $('#trailer-preview-container').addClass('d-none');
            $('#trailer-preview-iframe').attr('src', '');
        });

        // Event delegation for actor selection
        $(document).on('click', '.select-actor:not([disabled])', function() {
            var actorId = $(this).data('id');
            var actorName = $(this).data('name');
            var actorProfile = $(this).data('profile');
            var actorCharacter = $(this).data('character');

            // Disable the button and change its appearance
            $(this).removeClass('btn-primary').addClass('btn-secondary')
                .html('<i class="fas fa-check"></i> Selected')
                .prop('disabled', true);

            // Fetch additional actor details and add to selected actors
            fetchActorDetails(actorId, function(actorDetails) {
                addSelectedActor({
                    id: actorId,
                    name: actorName,
                    profile_photo: actorProfile,
                    character: actorCharacter,
                    birth_date: actorDetails.birthday || '',
                    biography: actorDetails.biography || ''
                });
            });
        });

        // Event delegation for director selection
        $(document).on('click', '.select-director:not([disabled])', function() {
            var directorId = $(this).data('id');
            var directorName = $(this).data('name');
            var directorProfile = $(this).data('profile');
            var directorJob = $(this).data('job');

            // Disable the button and change its appearance
            $(this).removeClass('btn-primary').addClass('btn-secondary')
                .html('<i class="fas fa-check"></i> Selected')
                .prop('disabled', true);

            // Fetch additional director details and add to selected directors
            fetchPersonDetails(directorId, function(personDetails) {
                addSelectedDirector({
                    id: directorId,
                    name: directorName,
                    profile_photo: directorProfile,
                    job: directorJob,
                    biography: personDetails.biography || ''
                });
            });
        });

        // Event delegation for genre selection
        $(document).on('click', '.select-genre:not([disabled])', function() {
            var genreId = $(this).data('id');
            var genreName = $(this).data('name');

            // Disable the button and change its appearance
            $(this).removeClass('btn-primary').addClass('btn-secondary')
                .html('<i class="fas fa-check"></i> Selected')
                .prop('disabled', true);

            // Add to selected genres
            addSelectedGenre({
                id: genreId,
                name: genreName
            });
        });

        // Event delegation for actor removal
        $(document).on('click', '.remove-actor', function() {
            var actorId = $(this).data('id');
            removeSelectedActor(actorId);
        });

        // Event delegation for director removal
        $(document).on('click', '.remove-director', function() {
            var directorId = $(this).data('id');
            var job = $(this).data('job');
            removeSelectedDirector(directorId, job);
        });

        // Event delegation for genre removal
        $(document).on('click', '.remove-genre', function() {
            var genreId = $(this).data('id');
            removeSelectedGenre(genreId);
        });
    });

    // Add these functions for actor management
    function addSelectedActor(actor) {
        // Check if actor is already selected
        var existingIndex = window.selectedActors.findIndex(function(selectedActor) {
            return selectedActor.id === actor.id;
        });

        if (existingIndex === -1) {
            window.selectedActors.push(actor);
            updateSelectedActorsList();
        }
    }

    function removeSelectedActor(actorId) {
        window.selectedActors = window.selectedActors.filter(function(actor) {
            return actor.id !== actorId;
        });

        updateSelectedActorsList();

        // Re-enable the select button in the movie actors list if it exists
        var selectButton = $('.select-actor[data-id="' + actorId + '"]');
        if (selectButton.length) {
            selectButton.removeClass('btn-secondary').addClass('btn-primary')
            .html('<i class="fas fa-plus"></i> Select')
            .prop('disabled', false);
        }
    }

    function updateSelectedActorsList() {
        var container = $('#selected-actors-list');
        container.empty();

        if (window.selectedActors.length === 0) {
            $('#no-selected-actors').removeClass('d-none');
            return;
        }

        $('#no-selected-actors').addClass('d-none');

        $.each(window.selectedActors, function(index, actor) {
            var profileUrl = actor.profile_photo || '{{ asset('backend/assets/image/no-profile.png') }}';

            var html = '<div class="col-md-3 mb-4">' +
                '<div class="card h-100">' +
                '<img src="' + profileUrl + '" class="card-img-top" alt="' + actor.name + '" style="height: 200px; object-fit: cover;">' +
                '<div class="card-body">' +
                '<h5 class="card-title">' + actor.name + '</h5>' +
                '<p class="card-text text-muted">' + (actor.character ? 'as ' + actor.character : '') + '</p>' +
                '<button type="button" class="btn btn-sm btn-danger w-100 remove-actor" data-id="' + actor.id + '">' +
                '<i class="fas fa-trash"></i> Remove' +
                '</button>' +
                // Hidden inputs to include actor data in form submission
                '<input type="hidden" name="actors[' + index + '][id]" value="' + actor.id + '">' +
                '<input type="hidden" name="actors[' + index + '][name]" value="' + actor.name + '">' +
                '<input type="hidden" name="actors[' + index + '][profile_photo]" value="' + (actor.profile_photo || '') + '">' +
                '<input type="hidden" name="actors[' + index + '][character]" value="' + (actor.character || '') + '">' +
                '<input type="hidden" name="actors[' + index + '][birth_date]" value="' + (actor.birth_date || '') + '">' +
                '<input type="hidden" name="actors[' + index + '][biography]" value="' + (actor.biography || '') + '">' +
                '</div>' +
                '</div>' +
                '</div>';

            container.append(html);
        });
    }

    // Add these functions for director management
    function updateDirectorsTab(crew, movieTitle) {
        // Hide the no movie selected message
        $('#no-movie-selected-directors').addClass('d-none');

        // Show the movie directors container
        $('#movie-directors-container').removeClass('d-none');

        // Set the movie title
        $('#selected-movie-title-directors').text(movieTitle);

        // Clear the movie directors container
        $('#movie-directors').empty();

        // Filter for directors, producers, and other important crew
        const importantCrew = crew.filter(person =>
            person.job === 'Director' ||
            person.job === 'Producer' ||
            person.job === 'Executive Producer' ||
            person.job === 'Screenplay' ||
            person.job === 'Writer'
        );

        // If no important crew, show the no directors message
        if (importantCrew.length === 0) {
            $('#no-movie-directors-message').removeClass('d-none');
            return;
        }

        // Hide the no directors message
        $('#no-movie-directors-message').addClass('d-none');

        // Add each crew member to the container
        $.each(importantCrew, function(index, person) {
            var profileUrl = person.profile_path
                ? 'https://image.tmdb.org/t/p/w185' + person.profile_path
                : '{{ asset('backend/assets/image/no-profile.png') }}';

            // Check if this director is already in the selected directors list
            var isSelected = window.selectedDirectors.some(function(selectedDirector) {
                return selectedDirector.id === person.id && selectedDirector.job === person.job;
            });

            var buttonClass = isSelected ? 'btn-secondary' : 'btn-primary';
            var buttonText = isSelected ? '<i class="fas fa-check"></i> Selected' : '<i class="fas fa-plus"></i> Select';
            var buttonDisabled = isSelected ? 'disabled' : '';

            var html = '<div class="col-md-3 mb-4">' +
                '<div class="card h-100">' +
                '<img src="' + profileUrl + '" class="card-img-top" alt="' + person.name + '" style="height: 250px; object-fit: cover;">' +
                '<div class="card-body">' +
                '<h5 class="card-title">' + person.name + '</h5>' +
                '<p class="card-text text-muted">' + person.job + '</p>' +
                '<button type="button" class="btn btn-sm ' + buttonClass + ' w-100 select-director" ' + buttonDisabled + ' ' +
                'data-id="' + person.id + '" ' +
                'data-name="' + person.name + '" ' +
                'data-profile="' + (person.profile_path ? 'https://image.tmdb.org/t/p/w185' + person.profile_path : '') + '" ' +
                'data-job="' + person.job + '">' +
                buttonText +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>';

            $('#movie-directors').append(html);
        });
    }

    function selectImportantCrew(crew) {
        // Clear any previously selected directors
        window.selectedDirectors = [];

        // Filter for directors, producers, and other important crew
        const importantCrew = crew.filter(person =>
            person.job === 'Director' ||
            person.job === 'Producer' ||
            person.job === 'Executive Producer' ||
            person.job === 'Screenplay' ||
            person.job === 'Writer'
        );

        // Add important crew members to the selected directors
        importantCrew.forEach(function(person) {
            // Fetch additional director details
            fetchPersonDetails(person.id, function(personDetails) {
                addSelectedDirector({
                    id: person.id,
                    name: person.name,
                    profile_photo: person.profile_path ? 'https://image.tmdb.org/t/p/w185' + person.profile_path : '',
                    job: person.job,
                    biography: personDetails.biography || ''
                });

                // Update the UI to reflect the selected state
                var selectButton = $('.select-director[data-id="' + person.id + '"][data-job="' + person.job + '"]');
                if (selectButton.length) {
                    selectButton.removeClass('btn-primary').addClass('btn-secondary')
                        .html('<i class="fas fa-check"></i> Selected')
                        .prop('disabled', true);
                }
            });
        });
    }

    function fetchPersonDetails(personId, callback) {
        $.ajax({
            url: 'https://api.themoviedb.org/3/person/' + personId,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4Yzc1NjUxNzIxMTE4YzJiMWExYTIxMjJmNWZmZWU3YSIsIm5iZiI6MTc0MTE0MDM5MS41NjQsInN1YiI6IjY3YzdiMWE3MGEwMDU3NjE0M2MyOGIwYyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.k1w1YejJkhyptQRCP2NmVAQSNACbTHSBN_PMI0z8BPA',
                'Content-Type': 'application/json'
            },
            success: function(data) {
                callback(data);
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch person details:', error);
                // Call the callback with empty data
                callback({});
            }
        });
    }

    function addSelectedDirector(director) {
        // Check if director is already selected
        var existingIndex = window.selectedDirectors.findIndex(function(selectedDirector) {
            return selectedDirector.id === director.id && selectedDirector.job === director.job;
        });

        if (existingIndex === -1) {
            window.selectedDirectors.push(director);
            updateSelectedDirectorsList();
        }
    }

    function removeSelectedDirector(directorId, job) {
        window.selectedDirectors = window.selectedDirectors.filter(function(director) {
            return !(director.id === directorId && director.job === job);
        });

        updateSelectedDirectorsList();

        // Re-enable the select button in the movie directors list if it exists
        var selectButton = $('.select-director[data-id="' + directorId + '"][data-job="' + job + '"]');
        if (selectButton.length) {
            selectButton.removeClass('btn-secondary').addClass('btn-primary')
            .html('<i class="fas fa-plus"></i> Select')
            .prop('disabled', false);
        }
    }

    function updateSelectedDirectorsList() {
        var container = $('#selected-directors-list');
        container.empty();

        if (window.selectedDirectors.length === 0) {
            $('#no-selected-directors').removeClass('d-none');
            return;
        }

        $('#no-selected-directors').addClass('d-none');

        $.each(window.selectedDirectors, function(index, director) {
            var profileUrl = director.profile_photo || '{{ asset('backend/assets/image/no-profile.png') }}';

            var html = '<div class="col-md-3 mb-4">' +
                '<div class="card h-100">' +
                '<img src="' + profileUrl + '" class="card-img-top" alt="' + director.name + '" style="height: 200px; object-fit: cover;">' +
                '<div class="card-body">' +
                '<h5 class="card-title">' + director.name + '</h5>' +
                '<p class="card-text text-muted">' + director.job + '</p>' +
                '<button type="button" class="btn btn-sm btn-danger w-100 remove-director" data-id="' + director.id + '" data-job="' + director.job + '">' +
                '<i class="fas fa-trash"></i> Remove' +
                '</button>' +
                // Hidden inputs to include director data in form submission
                '<input type="hidden" name="directors[' + index + '][id]" value="' + director.id + '">' +
                '<input type="hidden" name="directors[' + index + '][name]" value="' + director.name + '">' +
                '<input type="hidden" name="directors[' + index + '][profile_photo]" value="' + (director.profile_photo || '') + '">' +
                '<input type="hidden" name="directors[' + index + '][job]" value="' + director.job + '">' +
                '<input type="hidden" name="directors[' + index + '][biography]" value="' + (director.biography || '') + '">' +
                '</div>' +
                '</div>' +
                '</div>';

            container.append(html);
        });
    }

    // Add these functions for genre management
    function updateGenresTab(genres, movieTitle) {
        // Hide the no movie selected message
        $('#no-movie-selected-genres').addClass('d-none');

        // Show the movie genres container
        $('#movie-genres-container').removeClass('d-none');

        // Set the movie title
        $('#selected-movie-title-genres').text(movieTitle);

        // Clear the movie genres container
        $('#movie-genres').empty();

        // If no genres, show the no genres message
        if (!genres || genres.length === 0) {
            $('#no-movie-genres-message').removeClass('d-none');
            return;
        }

        // Hide the no genres message
        $('#no-movie-genres-message').addClass('d-none');

        // Add each genre to the container
        $.each(genres, function(index, genre) {
            // Check if this genre is already in the selected genres list
            var isSelected = window.selectedGenres.some(function(selectedGenre) {
                return selectedGenre.id === genre.id;
            });

            var buttonClass = isSelected ? 'btn-secondary' : 'btn-primary';
            var buttonText = isSelected ? '<i class="fas fa-check"></i> Selected' : '<i class="fas fa-plus"></i> Select';
            var buttonDisabled = isSelected ? 'disabled' : '';

            var html = '<div class="col-md-3 mb-4">' +
                '<div class="card h-100">' +
                '<div class="card-body">' +
                '<h5 class="card-title">' + genre.name + '</h5>' +
                '<button type="button" class="btn btn-sm ' + buttonClass + ' w-100 select-genre" ' + buttonDisabled + ' ' +
                'data-id="' + genre.id + '" ' +
                'data-name="' + genre.name + '">' +
                buttonText +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>';

            $('#movie-genres').append(html);
        });
    }

    function selectAllGenres(genres) {
        // Clear any previously selected genres
        window.selectedGenres = [];

        // Add all genres to the selected genres
        genres.forEach(function(genre) {
            addSelectedGenre({
                id: genre.id,
                name: genre.name
            });

            // Update the UI to reflect the selected state
            var selectButton = $('.select-genre[data-id="' + genre.id + '"]');
            if (selectButton.length) {
                selectButton.removeClass('btn-primary').addClass('btn-secondary')
                    .html('<i class="fas fa-check"></i> Selected')
                    .prop('disabled', true);
            }
        });
    }

    function addSelectedGenre(genre) {
        // Check if genre is already selected
        var existingIndex = window.selectedGenres.findIndex(function(selectedGenre) {
            return selectedGenre.id === genre.id;
        });

        if (existingIndex === -1) {
            window.selectedGenres.push(genre);
            updateSelectedGenresList();
        }
    }

    function removeSelectedGenre(genreId) {
        window.selectedGenres = window.selectedGenres.filter(function(genre) {
            return genre.id !== genreId;
        });

        updateSelectedGenresList();

        // Re-enable the select button in the movie genres list if it exists
        var selectButton = $('.select-genre[data-id="' + genreId + '"]');
        if (selectButton.length) {
            selectButton.removeClass('btn-secondary').addClass('btn-primary')
            .html('<i class="fas fa-plus"></i> Select')
            .prop('disabled', false);
        }
    }

    function updateSelectedGenresList() {
        var container = $('#selected-genres-list');
        container.empty();

        if (window.selectedGenres.length === 0) {
            $('#no-selected-genres').removeClass('d-none');
            return;
        }

        $('#no-selected-genres').addClass('d-none');

        $.each(window.selectedGenres, function(index, genre) {
            var html = '<div class="col-md-3 mb-4">' +
                '<div class="card h-100">' +
                '<div class="card-body">' +
                '<h5 class="card-title">' + genre.name + '</h5>' +
                '<button type="button" class="btn btn-sm btn-danger w-100 remove-genre" data-id="' + genre.id + '">' +
                '<i class="fas fa-trash"></i> Remove' +
                '</button>' +
                // Hidden inputs to include genre data in form submission
                '<input type="hidden" name="genres[' + index + '][id]" value="' + genre.id + '">' +
                '<input type="hidden" name="genres[' + index + '][name]" value="' + genre.name + '">' +
                '</div>' +
                '</div>' +
                '</div>';

            container.append(html);
        });
    }
</script>
@endsection
