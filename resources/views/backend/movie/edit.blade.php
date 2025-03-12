@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-film mr-2"></i>Edit Movie: {{ $movie->title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('movie.index') }}"><i class="fas fa-video"></i>
                                    Movies</a></li>
                            <li class="breadcrumb-item active">Edit Movie</li>
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
                                <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Movie Information</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('movie.update', $movie->id) }}" method="POST" id="movieForm">
                                    @csrf
                                    @method('PUT')

                                    <!-- Form content organized with tabs -->
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <ul class="nav nav-tabs" id="movieTabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="basic-tab" data-toggle="tab"
                                                        href="#basic" role="tab" aria-controls="basic"
                                                        aria-selected="true">
                                                        <i class="fas fa-info-circle mr-1"></i> Basic Information
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="media-tab" data-toggle="tab" href="#media"
                                                        role="tab" aria-controls="media" aria-selected="false">
                                                        <i class="fas fa-photo-video mr-1"></i> Media & Links
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="additional-tab" data-toggle="tab"
                                                        href="#additional" role="tab" aria-controls="additional"
                                                        aria-selected="false">
                                                        <i class="fas fa-cogs mr-1"></i> Additional Details
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="actors-tab" data-toggle="tab" href="#actors"
                                                        role="tab" aria-controls="actors" aria-selected="false">
                                                        <i class="fas fa-users mr-1"></i> Actors
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="genres-tab" data-toggle="tab" href="#genres"
                                                        role="tab" aria-controls="genres" aria-selected="false">
                                                        <i class="fas fa-tags mr-1"></i> Genres
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="directors-tab" data-toggle="tab"
                                                        href="#directors" role="tab" aria-controls="directors"
                                                        aria-selected="false">
                                                        <i class="fas fa-user-tie mr-1"></i> Directors
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tab-content" id="movieTabContent">
                                        <!-- Basic Information Tab -->
                                        <div class="tab-pane fade show active" id="basic" role="tabpanel"
                                            aria-labelledby="basic-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title">
                                                            <i class="fas fa-heading mr-1"></i> Title
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-film"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" id="title"
                                                                name="title" value="{{ old('title', $movie->title) }}"
                                                                placeholder="Enter movie title" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="type">
                                                            <i class="fas fa-photo-video mr-1"></i> Type
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-tag"></i></span>
                                                            </div>
                                                            <select class="form-control" id="type" name="type"
                                                                required>
                                                                <option value="">-- Select Type --</option>
                                                                <option value="movie"
                                                                    {{ old('type', $movie->type) == 'movie' ? 'selected' : '' }}>
                                                                    Movie</option>
                                                                <option value="tv_series"
                                                                    {{ old('type', $movie->type) == 'tv_series' ? 'selected' : '' }}>
                                                                    TV Series</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description">
                                                            <i class="fas fa-align-left mr-1"></i> Description
                                                        </label>
                                                        <textarea class="form-control" id="description" name="description" rows="5"
                                                            placeholder="Enter movie description">{{ old('description', $movie->description) }}</textarea>
                                                        <small class="form-text text-muted">Provide a compelling
                                                            description for this title</small>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="release_date">
                                                            <i class="fas fa-calendar-alt mr-1"></i> Release Date
                                                        </label>
                                                        <div class="input-group date" id="releaseDatePicker"
                                                            data-target-input="nearest">
                                                            <div class="input-group-prepend"
                                                                data-target="#releaseDatePicker"
                                                                data-toggle="datetimepicker">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" class="form-control" id="release_date"
                                                                name="release_date"
                                                                value="{{ old('release_date', $movie->release_date ? $movie->release_date->format('Y-m-d') : '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="duration">
                                                            <i class="fas fa-clock mr-1"></i> Duration (minutes)
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-hourglass-half"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="duration"
                                                                name="duration"
                                                                value="{{ old('duration', $movie->duration) }}"
                                                                placeholder="Enter duration in minutes">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="tmdb_id">
                                                            <i class="fas fa-database mr-1"></i> TMDB ID
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-hashtag"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="tmdb_id"
                                                                name="tmdb_id"
                                                                value="{{ old('tmdb_id', $movie->tmdb_id) }}"
                                                                placeholder="Enter TMDB ID (optional)">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-info"
                                                                    id="fetchTmdbBtn" title="Fetch data from TMDB">
                                                                    <i class="fas fa-sync-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <small class="form-text text-muted">Enter TMDB ID to auto-fill
                                                            movie information</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="imdb_rating">
                                                            <i class="fas fa-star mr-1"></i> IMDb Rating
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-star-half-alt"></i></span>
                                                            </div>
                                                            <input type="number" step="0.1" min="0"
                                                                max="10" class="form-control" id="imdb_rating"
                                                                name="imdb_rating"
                                                                value="{{ old('imdb_rating', $movie->imdb_rating) }}"
                                                                placeholder="Enter IMDb rating">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Media & Links Tab -->
                                        <div class="tab-pane fade" id="media" role="tabpanel"
                                            aria-labelledby="media-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="poster_url">
                                                            <i class="fas fa-image mr-1"></i> Poster URL
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-link"></i></span>
                                                            </div>
                                                            <input type="url" class="form-control" id="poster_url"
                                                                name="poster_url"
                                                                value="{{ old('poster_url', $movie->poster_url) }}"
                                                                placeholder="Enter poster URL">
                                                        </div>
                                                        <div
                                                            class="mt-2 poster-preview {{ $movie->poster_url ? '' : 'd-none' }}">
                                                            <div class="card">
                                                                <div class="card-body text-center p-2">
                                                                    <img src="{{ $movie->poster_url }}"
                                                                        id="poster_preview" alt="{{ $movie->title }}"
                                                                        class="img-fluid img-thumbnail"
                                                                        style="max-height: 200px;">
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
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-link"></i></span>
                                                            </div>
                                                            <input type="url" class="form-control" id="backdrop_url"
                                                                name="backdrop_url"
                                                                value="{{ old('backdrop_url', $movie->backdrop_url) }}"
                                                                placeholder="Enter backdrop URL">
                                                        </div>
                                                        <div
                                                            class="mt-2 backdrop-preview {{ $movie->backdrop_url ? '' : 'd-none' }}">
                                                            <div class="card">
                                                                <div class="card-body text-center p-2">
                                                                    <img src="{{ $movie->backdrop_url }}"
                                                                        id="backdrop_preview"
                                                                        alt="{{ $movie->title }} backdrop"
                                                                        class="img-fluid img-thumbnail"
                                                                        style="max-height: 150px;">
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
                                                                <span class="input-group-text"><i
                                                                        class="fab fa-youtube"></i></span>
                                                            </div>
                                                            <input type="url" class="form-control" id="trailer_url"
                                                                name="trailer_url"
                                                                value="{{ old('trailer_url', $movie->trailer_url) }}"
                                                                placeholder="Enter trailer URL (YouTube, Vimeo, etc.)">
                                                        </div>
                                                        @if ($movie->trailer_url)
                                                            <div class="mt-2">
                                                                <button type="button" class="btn btn-sm btn-outline-info"
                                                                    id="previewTrailerBtn">
                                                                    <i class="fas fa-play-circle mr-1"></i> Preview Trailer
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Additional Details Tab -->
                                        <div class="tab-pane fade" id="additional" role="tabpanel"
                                            aria-labelledby="additional-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="price">
                                                            <i class="fas fa-money-bill mr-1"></i> Price
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control"
                                                                id="price" name="price"
                                                                value="{{ old('price', $movie->price) }}"
                                                                placeholder="Enter price">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="country">
                                                            <i class="fas fa-globe mr-1"></i> Country
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-flag"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" id="country"
                                                                name="country"
                                                                value="{{ old('country', $movie->country) }}"
                                                                placeholder="Enter country">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="language">
                                                            <i class="fas fa-language mr-1"></i> Language
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-comments"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" id="language"
                                                                name="language"
                                                                value="{{ old('language', $movie->language) }}"
                                                                placeholder="Enter language">
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
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-exclamation-triangle"></i></span>
                                                            </div>
                                                            <select class="form-control" id="maturity_rating"
                                                                name="maturity_rating">
                                                                <option value="">-- Select Rating --</option>
                                                                <option value="G"
                                                                    {{ old('maturity_rating', $movie->maturity_rating) == 'G' ? 'selected' : '' }}>
                                                                    G (General Audiences)</option>
                                                                <option value="PG"
                                                                    {{ old('maturity_rating', $movie->maturity_rating) == 'PG' ? 'selected' : '' }}>
                                                                    PG (Parental Guidance Suggested)</option>
                                                                <option value="PG-13"
                                                                    {{ old('maturity_rating', $movie->maturity_rating) == 'PG-13' ? 'selected' : '' }}>
                                                                    PG-13 (Parents Strongly Cautioned)</option>
                                                                <option value="R"
                                                                    {{ old('maturity_rating', $movie->maturity_rating) == 'R' ? 'selected' : '' }}>
                                                                    R (Restricted)</option>
                                                                <option value="NC-17"
                                                                    {{ old('maturity_rating', $movie->maturity_rating) == 'NC-17' ? 'selected' : '' }}>
                                                                    NC-17 (Adults Only)</option>
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
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-check-circle"></i></span>
                                                            </div>
                                                            <select class="form-control" id="status" name="status"
                                                                required>
                                                                <option value="">-- Select Status --</option>
                                                                <option value="active"
                                                                    {{ old('status', $movie->status) == 'active' ? 'selected' : '' }}>
                                                                    Active</option>
                                                                <option value="inactive"
                                                                    {{ old('status', $movie->status) == 'inactive' ? 'selected' : '' }}>
                                                                    Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="is_free" name="is_free"
                                                                                value="1"
                                                                                {{ old('is_free', $movie->is_free) ? 'checked' : '' }}>
                                                                            <label class="custom-control-label"
                                                                                for="is_free">
                                                                                <i class="fas fa-gift mr-1"></i> Visible on
                                                                                Slide
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="is_free" name="is_free"
                                                                                value="1"
                                                                                {{ old('is_free', $movie->is_free) ? 'checked' : '' }}>
                                                                            <label class="custom-control-label"
                                                                                for="is_free">
                                                                                <i class="fas fa-gift mr-1"></i> Verticall
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="is_free" name="is_free"
                                                                                value="1"
                                                                                {{ old('is_free', $movie->is_free) ? 'checked' : '' }}>
                                                                            <label class="custom-control-label"
                                                                                for="is_free">
                                                                                <i class="fas fa-gift mr-1"></i> Free to
                                                                                Watch
                                                                            </label>
                                                                        </div>
                                                                        <small class="form-text text-muted mt-2">Enable
                                                                            this option to make this movie available for
                                                                            free.</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Actors Tab -->
                                        <div class="tab-pane fade" id="actors" role="tabpanel"
                                            aria-labelledby="actors-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-1"></i> Actors from the selected
                                                        movie will be displayed here. Select the ones you want to include.
                                                    </div>

                                                    <div id="no-movie-selected"
                                                        class="alert alert-warning {{ $movie->actors->count() > 0 ? 'd-none' : '' }}">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i> No movie selected
                                                        yet from TMDB. You can either go to the <a href="#"
                                                            onclick="$('#tmdb-search-tab').tab('show'); return false;"
                                                            class="alert-link">TMDB Search tab</a> to select a movie or
                                                        manage the existing actors below.
                                                    </div>

                                                    <!-- Movie Actors Section -->
                                                    <div id="movie-actors-container" class="mt-4 d-none">
                                                        <h4 class="mb-3">Actors in <span
                                                                id="selected-movie-title"></span></h4>
                                                        <div id="movie-actors" class="row">
                                                            <!-- Actor results will be displayed here -->
                                                        </div>
                                                        <div id="no-movie-actors-message" class="alert alert-info d-none">
                                                            <i class="fas fa-info-circle mr-1"></i> No actors found for
                                                            this movie.
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
                                                                <div id="no-selected-actors"
                                                                    class="alert alert-info {{ $movie->actors->count() > 0 ? 'd-none' : '' }}">
                                                                    <i class="fas fa-info-circle mr-1"></i> No actors
                                                                    selected yet. Select actors from above or search for a
                                                                    movie.
                                                                </div>
                                                                <div id="selected-actors-list" class="row">
                                                                    <!-- Selected actors will be displayed here -->
                                                                    @foreach ($movie->actors as $index => $actor)
                                                                        <div class="col-md-3 mb-4">
                                                                            <div class="card h-100">
                                                                                <img src="{{ $actor->profile_photo ?: asset('backend/assets/image/no-profile.png') }}"
                                                                                    class="card-img-top"
                                                                                    alt="{{ $actor->name }}"
                                                                                    style="height: 200px; object-fit: cover;">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">
                                                                                        {{ $actor->name }}</h5>
                                                                                    <p class="card-text text-muted">
                                                                                        {{ $actor->pivot->character ? 'as ' . $actor->pivot->character : '' }}
                                                                                    </p>
                                                                                    <button type="button"
                                                                                        class="btn btn-sm btn-danger w-100 remove-actor"
                                                                                        data-id="{{ $actor->tmdb_id ?: $actor->id }}">
                                                                                        <i class="fas fa-trash"></i> Remove
                                                                                    </button>
                                                                                    <input type="hidden"
                                                                                        name="actors[{{ $index }}][id]"
                                                                                        value="{{ $actor->tmdb_id ?: $actor->id }}">
                                                                                    <input type="hidden"
                                                                                        name="actors[{{ $index }}][name]"
                                                                                        value="{{ $actor->name }}">
                                                                                    <input type="hidden"
                                                                                        name="actors[{{ $index }}][profile_photo]"
                                                                                        value="{{ $actor->profile_photo ?: '' }}">
                                                                                    <input type="hidden"
                                                                                        name="actors[{{ $index }}][character]"
                                                                                        value="{{ $actor->pivot->character ?: '' }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Add the Genres Tab -->
                                        <div class="tab-pane fade" id="genres" role="tabpanel"
                                            aria-labelledby="genres-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-1"></i> Select the genres for this
                                                        movie.
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
                                                                        <div id="no-selected-genres"
                                                                            class="alert alert-info {{ $movie->genres->count() > 0 ? 'd-none' : '' }}">
                                                                            <i class="fas fa-info-circle mr-1"></i> No
                                                                            genres selected yet. Add genres below.
                                                                        </div>
                                                                        <div id="selected-genres-list" class="row">
                                                                            @foreach ($movie->genres as $index => $genre)
                                                                                <div class="col-md-3 mb-4 genre-item"
                                                                                    data-id="{{ $genre->id }}">
                                                                                    <div class="card h-100">
                                                                                        <div class="card-body">
                                                                                            <h5 class="card-title">
                                                                                                {{ $genre->name }}</h5>
                                                                                            <button type="button"
                                                                                                class="btn btn-sm btn-danger w-100 remove-genre"
                                                                                                data-id="{{ $genre->id }}">
                                                                                                <i
                                                                                                    class="fas fa-trash"></i>
                                                                                                Remove
                                                                                            </button>
                                                                                            <input type="hidden"
                                                                                                name="genres[{{ $index }}][id]"
                                                                                                value="{{ $genre->id }}">
                                                                                            <input type="hidden"
                                                                                                name="genres[{{ $index }}][name]"
                                                                                                value="{{ $genre->name }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Add New Genre Section -->
                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Add New Genre</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="new-genre-name">Genre Name</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control"
                                                                                id="new-genre-name"
                                                                                placeholder="Enter genre name">
                                                                            <div class="input-group-append">
                                                                                <button type="button"
                                                                                    class="btn btn-primary"
                                                                                    id="add-new-genre">
                                                                                    <i class="fas fa-plus"></i> Add Genre
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Add the Directors Tab -->
                                        <div class="tab-pane fade" id="directors" role="tabpanel"
                                            aria-labelledby="directors-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-1"></i> Select the directors and
                                                        crew for this movie.
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
                                                                        <div id="no-selected-directors"
                                                                            class="alert alert-info {{ $movie->directors->count() > 0 ? 'd-none' : '' }}">
                                                                            <i class="fas fa-info-circle mr-1"></i> No
                                                                            directors selected yet. Add directors below.
                                                                        </div>
                                                                        <div id="selected-directors-list" class="row">
                                                                            @foreach ($movie->directors as $index => $director)
                                                                                <div class="col-md-3 mb-4 director-item"
                                                                                    data-id="{{ $director->id }}"
                                                                                    data-job="{{ $director->pivot->job }}">
                                                                                    <div class="card h-100">
                                                                                        <img src="{{ $director->profile_photo ?: asset('backend/assets/image/no-profile.png') }}"
                                                                                            class="card-img-top"
                                                                                            alt="{{ $director->name }}"
                                                                                            style="height: 200px; object-fit: cover;">
                                                                                        <div class="card-body">
                                                                                            <h5 class="card-title">
                                                                                                {{ $director->name }}</h5>
                                                                                            <p
                                                                                                class="card-text text-muted">
                                                                                                {{ $director->pivot->job }}
                                                                                            </p>
                                                                                            <button type="button"
                                                                                                class="btn btn-sm btn-danger w-100 remove-director"
                                                                                                data-id="{{ $director->id }}"
                                                                                                data-job="{{ $director->pivot->job }}">
                                                                                                <i
                                                                                                    class="fas fa-trash"></i>
                                                                                                Remove
                                                                                            </button>
                                                                                            <input type="hidden"
                                                                                                name="directors[{{ $index }}][id]"
                                                                                                value="{{ $director->id }}">
                                                                                            <input type="hidden"
                                                                                                name="directors[{{ $index }}][name]"
                                                                                                value="{{ $director->name }}">
                                                                                            <input type="hidden"
                                                                                                name="directors[{{ $index }}][profile_photo]"
                                                                                                value="{{ $director->profile_photo }}">
                                                                                            <input type="hidden"
                                                                                                name="directors[{{ $index }}][job]"
                                                                                                value="{{ $director->pivot->job }}">
                                                                                            <input type="hidden"
                                                                                                name="directors[{{ $index }}][biography]"
                                                                                                value="{{ $director->biography }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Add New Director Section -->
                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Add New Director</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="new-director-name">Director
                                                                                    Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="new-director-name"
                                                                                    placeholder="Enter director name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="new-director-job">Job</label>
                                                                                <select class="form-control"
                                                                                    id="new-director-job">
                                                                                    <option value="Director">Director
                                                                                    </option>
                                                                                    <option value="Producer">Producer
                                                                                    </option>
                                                                                    <option value="Executive Producer">
                                                                                        Executive Producer</option>
                                                                                    <option value="Screenplay">Screenplay
                                                                                    </option>
                                                                                    <option value="Writer">Writer</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="new-director-profile">Profile
                                                                                    Photo URL</label>
                                                                                <input type="url" class="form-control"
                                                                                    id="new-director-profile"
                                                                                    placeholder="Enter profile photo URL (optional)">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <button type="button" class="btn btn-primary"
                                                                                id="add-new-director">
                                                                                <i class="fas fa-plus"></i> Add Director
                                                                            </button>
                                                                        </div>
                                                                    </div>
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
                                                            <i class="fas fa-save mr-1"></i> Update Movie
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

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize tabs
            $('#movieTabs a').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // Image preview for poster
            $('#poster_url').on('input', function() {
                var url = $(this).val();
                if (url) {
                    $('#poster_preview').attr('src', url);
                    $('.poster-preview').removeClass('d-none');
                } else {
                    $('.poster-preview').addClass('d-none');
                }
            });

            // Image preview for backdrop
            $('#backdrop_url').on('input', function() {
                var url = $(this).val();
                if (url) {
                    $('#backdrop_preview').attr('src', url);
                    $('.backdrop-preview').removeClass('d-none');
                } else {
                    $('.backdrop-preview').addClass('d-none');
                }
            });

            // Initialize Summernote for description if available
            if ($.fn.summernote) {
                $('#description').summernote({
                    placeholder: 'Enter movie description here...',
                    height: 150,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough']],
                        ['para', ['ul', 'ol', 'paragraph']],
                    ]
                });
            }

            // TMDB API fetch button (placeholder - would need API implementation)
            $('#fetchTmdbBtn').click(function() {
                var tmdbId = $('#tmdb_id').val();
                if (tmdbId) {
                    // Example function - would need actual implementation
                    Swal.fire({
                        title: 'Fetching Data',
                        text: 'Retrieving information from TMDB...',
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Simulate API call with timeout
                    setTimeout(function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Data retrieved successfully.',
                            icon: 'success',
                            timer: 1500
                        });
                        // This would be where you populate form fields with the API response
                    }, 1500);
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please enter a valid TMDB ID first.',
                        icon: 'error'
                    });
                }
            });

            // Trailer preview button
            $('#previewTrailerBtn').click(function() {
                var trailerUrl = $('#trailer_url').val();
                if (trailerUrl) {
                    // Extract video ID from YouTube URL
                    var videoId = '';
                    if (trailerUrl.includes('youtube.com') || trailerUrl.includes('youtu.be')) {
                        // Extract YouTube video ID
                        var regExp =
                            /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
                        var match = trailerUrl.match(regExp);
                        videoId = (match && match[7].length == 11) ? match[7] : false;

                        if (videoId) {
                            // Create YouTube embed
                            var embedHtml = '<div class="embed-responsive embed-responsive-16by9">' +
                                '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/' +
                                videoId + '?autoplay=1" allowfullscreen></iframe></div>';

                            Swal.fire({
                                title: 'Trailer Preview',
                                html: embedHtml,
                                width: 800,
                                showCloseButton: true,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Could not extract video ID from the provided URL.',
                                icon: 'error'
                            });
                        }
                    } else {
                        // For other video services, just open in new tab
                        window.open(trailerUrl, '_blank');
                    }
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'No trailer URL provided.',
                        icon: 'error'
                    });
                }
            });

            // Form validation
            $('#movieForm').submit(function(e) {
                var requiredFields = ['title', 'type', 'status'];
                var isValid = true;

                requiredFields.forEach(function(field) {
                    if (!$('#' + field).val()) {
                        isValid = false;
                        $('#' + field).addClass('is-invalid');
                    } else {
                        $('#' + field).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Validation Error!',
                        text: 'Please fill in all required fields.',
                        icon: 'error'
                    });
                }
            });

            // Store selected actors
            window.selectedActors = [];
            // Store selected directors
            window.selectedDirectors = [];
            // Store selected genres
            window.selectedGenres = [];

            // Initialize selectedActors with existing actors
            @foreach ($movie->actors as $actor)
                selectedActors.push({
                    id: {{ $actor->tmdb_id ?: $actor->id }},
                    name: "{{ $actor->name }}",
                    profile_photo: "{{ $actor->profile_photo ?: '' }}",
                    character: "{{ $actor->pivot->character ?: '' }}"
                });
            @endforeach

            // Initialize existing genres
            $('.genre-item').each(function() {
                var genreId = $(this).data('id');
                var genreName = $(this).find('.card-title').text();

                window.selectedGenres.push({
                    id: genreId,
                    name: genreName
                });
            });

            // Initialize existing directors
            $('.director-item').each(function() {
                var directorId = $(this).data('id');
                var directorName = $(this).find('.card-title').text();
                var directorJob = $(this).data('job');
                var directorProfile = $(this).find('img').attr('src');
                var directorBiography = '';

                window.selectedDirectors.push({
                    id: directorId,
                    name: directorName,
                    job: directorJob,
                    profile_photo: directorProfile !==
                        '{{ asset('backend/assets/image/no-profile.png') }}' ? directorProfile :
                        '',
                    biography: directorBiography
                });
            });

            // Handle remove genre button clicks
            $(document).on('click', '.remove-genre', function() {
                var genreId = $(this).data('id');
                removeSelectedGenre(genreId);
            });

            // Handle remove director button clicks
            $(document).on('click', '.remove-director', function() {
                var directorId = $(this).data('id');
                var job = $(this).data('job');
                removeSelectedDirector(directorId, job);
            });

            // Handle add new genre button click
            $('#add-new-genre').on('click', function() {
                var genreName = $('#new-genre-name').val().trim();

                if (genreName.length === 0) {
                    window.showWarningToast('Please enter a genre name');
                    return;
                }

                // Generate a temporary ID (negative to avoid conflicts with real IDs)
                var tempId = -Math.floor(Math.random() * 1000000);

                addSelectedGenre({
                    id: tempId,
                    name: genreName
                });

                // Clear the input field
                $('#new-genre-name').val('');
            });

            // Handle add new director button click
            $('#add-new-director').on('click', function() {
                var directorName = $('#new-director-name').val().trim();
                var directorJob = $('#new-director-job').val();
                var directorProfile = $('#new-director-profile').val().trim();

                if (directorName.length === 0) {
                    window.showWarningToast('Please enter a director name');
                    return;
                }

                // Generate a temporary ID (negative to avoid conflicts with real IDs)
                var tempId = -Math.floor(Math.random() * 1000000);

                addSelectedDirector({
                    id: tempId,
                    name: directorName,
                    job: directorJob,
                    profile_photo: directorProfile,
                    biography: ''
                });

                // Clear the input fields
                $('#new-director-name').val('');
                $('#new-director-profile').val('');
            });

            // Update the fetchMovie function to include country and language data
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
                        console.log('Movie details:', movie);

                        // Fill form fields with movie data
                        $('#tmdb_id').val(movie.id);
                        $('#title').val(movie.title);
                        $('#description').val(movie.overview);

                        // Set type to 'movie' by default (required field)
                        $('#type').val('movie');

                        // Set status to 'active' by default (required field)
                        $('#status').val('active');

                        if (movie.release_date) {
                            $('#release_date').val(movie.release_date);
                        }

                        if (movie.poster_path) {
                            $('#poster_url').val('https://image.tmdb.org/t/p/w500' + movie.poster_path);
                        }

                        if (movie.backdrop_path) {
                            $('#backdrop_url').val('https://image.tmdb.org/t/p/original' + movie
                                .backdrop_path);
                        }

                        if (movie.runtime) {
                            $('#duration').val(movie.runtime);
                        }

                        if (movie.vote_average) {
                            // Format to one decimal place
                            const rating = parseFloat(movie.vote_average).toFixed(1);
                            $('#imdb_rating').val(rating);
                        } else {
                            // Set a default value for imdb_rating to avoid validation error
                            $('#imdb_rating').val('0.0');
                        }

                        // Set country from production_countries
                        if (movie.production_countries && movie.production_countries.length > 0) {
                            $('#country').val(movie.production_countries[0].name);
                        }

                        // Set language from spoken_languages
                        if (movie.spoken_languages && movie.spoken_languages.length > 0) {
                            // Try to get English name first, fall back to name if not available
                            const language = movie.spoken_languages[0].english_name || movie
                                .spoken_languages[0].name;
                            $('#language').val(language);
                        }

                        // Handle trailer
                        if (movie.videos && movie.videos.results && movie.videos.results.length > 0) {
                            const trailer = movie.videos.results.find(video => video.type ===
                                'Trailer' && video.site === 'YouTube');
                            if (trailer) {
                                $('#trailer_url').val('https://www.youtube.com/watch?v=' + trailer.key);
                            }
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
                            const actorNotification = `<div class="alert alert-success mt-3">
                            <i class="fas fa-info-circle mr-1"></i> ${actorCount} actors found and automatically selected for this movie.
                            <a href="#" onclick="$('#actors-tab').tab('show'); return false;" class="alert-link">
                                Go to Actors tab to review them.
                            </a>
                        </div>`;
                            $('#tmdb-search-results').after(actorNotification);
                        }

                        // Switch to basic tab
                        $('#basic-tab').tab('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch movie details:', error);
                        window.showErrorToast('Failed to fetch movie details: ' + error);
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
                            profile_photo: actor.profile_path ?
                                'https://image.tmdb.org/t/p/w185' + actor.profile_path : '',
                            character: actor.character || '',
                            birth_date: actorDetails.birthday || '',
                            biography: actorDetails.biography || ''
                        });
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

            // Update the updateSelectedActorsList function to include birth date and biography fields
            function updateSelectedActorsList() {
                var container = $('#selected-actors-list');
                container.empty();

                if (window.selectedActors.length === 0) {
                    $('#no-selected-actors').removeClass('d-none');
                    return;
                }

                $('#no-selected-actors').addClass('d-none');

                $.each(window.selectedActors, function(index, actor) {
                    var profileUrl = actor.profile_photo ||
                        '{{ asset('backend/assets/image/no-profile.png') }}';

                    var html = '<div class="col-md-3 mb-4">' +
                        '<div class="card h-100">' +
                        '<img src="' + profileUrl + '" class="card-img-top" alt="' + actor.name +
                        '" style="height: 200px; object-fit: cover;">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' + actor.name + '</h5>' +
                        '<p class="card-text text-muted">' + (actor.character ? 'as ' + actor.character :
                            '') + '</p>' +
                        '<button type="button" class="btn btn-sm btn-danger w-100 remove-actor" data-id="' +
                        actor.id + '">' +
                        '<i class="fas fa-trash"></i> Remove' +
                        '</button>' +
                        // Hidden inputs to include actor data in form submission
                        '<input type="hidden" name="actors[' + index + '][id]" value="' + actor.id + '">' +
                        '<input type="hidden" name="actors[' + index + '][name]" value="' + actor.name +
                        '">' +
                        '<input type="hidden" name="actors[' + index + '][profile_photo]" value="' + (actor
                            .profile_photo || '') + '">' +
                        '<input type="hidden" name="actors[' + index + '][character]" value="' + (actor
                            .character || '') + '">' +
                        '<input type="hidden" name="actors[' + index + '][birth_date]" value="' + (actor
                            .birth_date || '') + '">' +
                        '<input type="hidden" name="actors[' + index + '][biography]" value="' + (actor
                            .biography || '') + '">' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    container.append(html);
                });

                // Add click event for remove actor buttons
                $('.remove-actor').on('click', function() {
                    var actorId = $(this).data('id');
                    removeSelectedActor(actorId);
                });
            }

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
                $('.select-actor[data-id="' + actorId + '"]').removeClass('btn-secondary').addClass('btn-primary')
                    .html('<i class="fas fa-plus"></i> Select')
                    .prop('disabled', false);
            }

            // Initialize remove buttons for existing actors
            $(document).ready(function() {
                $('.remove-actor').on('click', function() {
                    var actorId = $(this).data('id');
                    removeSelectedActor(actorId);
                });
            });

            // Add back the updateActorsTab function
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
                    var profileUrl = actor.profile_path ?
                        'https://image.tmdb.org/t/p/w185' + actor.profile_path :
                        '{{ asset('backend/assets/image/no-profile.png') }}';

                    // All actors are selected by default
                    var buttonClass = 'btn-secondary';
                    var buttonText = '<i class="fas fa-check"></i> Selected';
                    var buttonDisabled = 'disabled';

                    var html = '<div class="col-md-3 mb-4">' +
                        '<div class="card h-100">' +
                        '<img src="' + profileUrl + '" class="card-img-top" alt="' + actor.name +
                        '" style="height: 250px; object-fit: cover;">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' + actor.name + '</h5>' +
                        '<p class="card-text text-muted">' + (actor.character ? 'as ' + actor.character :
                            '') + '</p>' +
                        '<button type="button" class="btn btn-sm ' + buttonClass + ' w-100 select-actor" ' +
                        buttonDisabled + ' ' +
                        'data-id="' + actor.id + '" ' +
                        'data-name="' + actor.name + '" ' +
                        'data-profile="' + (actor.profile_path ? 'https://image.tmdb.org/t/p/w185' + actor
                            .profile_path : '') + '" ' +
                        'data-character="' + (actor.character || '') + '">' +
                        buttonText +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    $('#movie-actors').append(html);
                });
            }

            // Functions for genre management
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
                    var html = '<div class="col-md-3 mb-4 genre-item" data-id="' + genre.id + '">' +
                        '<div class="card h-100">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' + genre.name + '</h5>' +
                        '<button type="button" class="btn btn-sm btn-danger w-100 remove-genre" data-id="' +
                        genre.id + '">' +
                        '<i class="fas fa-trash"></i> Remove' +
                        '</button>' +
                        // Hidden inputs to include genre data in form submission
                        '<input type="hidden" name="genres[' + index + '][id]" value="' + genre.id + '">' +
                        '<input type="hidden" name="genres[' + index + '][name]" value="' + genre.name +
                        '">' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    container.append(html);
                });
            }

            // Functions for director management
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
                    var profileUrl = director.profile_photo ||
                        '{{ asset('backend/assets/image/no-profile.png') }}';

                    var html = '<div class="col-md-3 mb-4 director-item" data-id="' + director.id +
                        '" data-job="' + director.job + '">' +
                        '<div class="card h-100">' +
                        '<img src="' + profileUrl + '" class="card-img-top" alt="' + director.name +
                        '" style="height: 200px; object-fit: cover;">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' + director.name + '</h5>' +
                        '<p class="card-text text-muted">' + director.job + '</p>' +
                        '<button type="button" class="btn btn-sm btn-danger w-100 remove-director" data-id="' +
                        director.id + '" data-job="' + director.job + '">' +
                        '<i class="fas fa-trash"></i> Remove' +
                        '</button>' +
                        // Hidden inputs to include director data in form submission
                        '<input type="hidden" name="directors[' + index + '][id]" value="' + director.id +
                        '">' +
                        '<input type="hidden" name="directors[' + index + '][name]" value="' + director
                        .name + '">' +
                        '<input type="hidden" name="directors[' + index + '][profile_photo]" value="' + (
                            director.profile_photo || '') + '">' +
                        '<input type="hidden" name="directors[' + index + '][job]" value="' + director.job +
                        '">' +
                        '<input type="hidden" name="directors[' + index + '][biography]" value="' + (
                            director.biography || '') + '">' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    container.append(html);
                });
            }
        });
    </script>
@endpush
