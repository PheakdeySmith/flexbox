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

                                                <div class="form-group">
                                                    <label for="video_url">
                                                        <i class="fas fa-film mr-1"></i> Video URL
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                                        </div>
                                                            <input type="url" class="form-control" id="video_url" name="video_url"
                                                            value="{{ old('video_url', $movie->video_url) }}" placeholder="Enter full movie/episode URL (YouTube)">
                                                    </div>
                                                    <small class="form-text text-muted">Enter the full YouTube URL for streaming the movie</small>
                                                    @if($movie->video_url)
                                                    <div class="mt-2">
                                                        <button type="button" class="btn btn-sm btn-outline-info" id="previewVideoBtn">
                                                            <i class="fas fa-play-circle mr-1"></i> Preview Video
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
                                                                                class="custom-control-input featured-toggle"
                                                                                id="is_featured" name="is_featured"
                                                                                value="1"
                                                                                data-type="is_featured"
                                                                                data-id="{{ $movie->id }}"
                                                                                {{ old('is_featured', $movie->is_featured) ? 'checked' : '' }}
                                                                                {{ $featuredCount >= $featuredLimit && !$movie->is_featured ? 'disabled' : '' }}>
                                                                            <label class="custom-control-label"
                                                                                for="is_featured">
                                                                                <i class="fas fa-star mr-1"></i> Featured
                                                                            </label>
                                                                        </div>
                                                                        <small class="form-text text-muted mt-2">
                                                                            Featured movies: {{ $featuredCount }}/{{ $featuredLimit }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input featured-toggle"
                                                                                id="is_featured_vertical"
                                                                                name="is_featured_vertical"
                                                                                value="1"
                                                                                data-type="is_featured_vertical"
                                                                                data-id="{{ $movie->id }}"
                                                                                {{ old('is_featured_vertical', $movie->is_featured_vertical) ? 'checked' : '' }}
                                                                                {{ $featuredVerticalCount >= $featuredVerticalLimit && !$movie->is_featured_vertical ? 'disabled' : '' }}>
                                                                            <label class="custom-control-label"
                                                                                for="is_featured_vertical">
                                                                                <i class="fas fa-arrows-alt-v mr-1"></i> Featured Vertical
                                                                            </label>
                                                                        </div>
                                                                        <small class="form-text text-muted mt-2">
                                                                            Featured vertical: {{ $featuredVerticalCount }}/{{ $featuredVerticalLimit }}
                                                                        </small>
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
                                        </div>

                                        <!-- Actors Tab -->
                                        <div class="tab-pane fade" id="actors" role="tabpanel"
                                            aria-labelledby="actors-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-1"></i> Actors associated with this movie are displayed below. To modify actors, please create a new movie.
                                                    </div>

                                                    <!-- Selected Actors Section -->
                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Movie Actors</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="selected-actors-container">
                                                                        <div id="no-selected-actors"
                                                                            class="alert alert-info {{ $movie->actors->count() > 0 ? 'd-none' : '' }}">
                                                                            <i class="fas fa-info-circle mr-1"></i> No actors
                                                                            associated with this movie.
                                                                        </div>
                                                                        <div id="selected-actors-list" class="row">
                                                                            @foreach ($movie->actors as $index => $actor)
                                                                                <div class="col-md-3 mb-4 actor-item" data-id="{{ $actor->id }}">
                                                                                    <div class="card h-100">
                                                                                        <img src="{{ $actor->profile_photo ?: asset('backend/assets/image/no-profile.png') }}"
                                                                                            class="card-img-top" alt="{{ $actor->name }}"
                                                                                            style="height: 200px; object-fit: cover;">
                                                                                        <div class="card-body">
                                                                                            <h5 class="card-title">{{ $actor->name }}</h5>
                                                                                            <p class="card-text text-muted">
                                                                                                {{ $actor->pivot->character ?: 'No character specified' }}
                                                                                            </p>
                                                                                            <input type="hidden" name="actors[{{ $index }}][id]" value="{{ $actor->id }}">
                                                                                            <input type="hidden" name="actors[{{ $index }}][name]" value="{{ $actor->name }}">
                                                                                            <input type="hidden" name="actors[{{ $index }}][profile_photo]" value="{{ $actor->profile_photo ?: '' }}">
                                                                                            <input type="hidden" name="actors[{{ $index }}][character]" value="{{ $actor->pivot->character ?: '' }}">
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
                                            </div>
                                        </div>

                                        <!-- Add the Genres Tab -->
                                        <div class="tab-pane fade" id="genres" role="tabpanel"
                                            aria-labelledby="genres-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-1"></i> Genres associated with this movie are displayed below. To modify genres, please create a new movie.
                                                    </div>

                                                    <!-- Selected Genres Section -->
                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Movie Genres</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="selected-genres-container">
                                                                        <div id="no-selected-genres"
                                                                            class="alert alert-info {{ $movie->genres->count() > 0 ? 'd-none' : '' }}">
                                                                            <i class="fas fa-info-circle mr-1"></i> No
                                                                            genres associated with this movie.
                                                                        </div>
                                                                        <div id="selected-genres-list" class="row">
                                                                            @foreach ($movie->genres as $index => $genre)
                                                                                <div class="col-md-3 mb-4 genre-item" data-id="{{ $genre->id }}">
                                                                                    <div class="card h-100">
                                                                                        <div class="card-body">
                                                                                            <h5 class="card-title">{{ $genre->name }}</h5>
                                                                                            <input type="hidden" name="genres[{{ $index }}][id]" value="{{ $genre->id }}">
                                                                                            <input type="hidden" name="genres[{{ $index }}][name]" value="{{ $genre->name }}">
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
                                            </div>
                                        </div>

                                        <!-- Add the Directors Tab -->
                                        <div class="tab-pane fade" id="directors" role="tabpanel"
                                            aria-labelledby="directors-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-1"></i> Directors and crew associated with this movie are displayed below. To modify directors, please create a new movie.
                                                    </div>

                                                    <!-- Selected Directors Section -->
                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Directors & Crew</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="selected-directors-container">
                                                                        <div id="no-selected-directors"
                                                                            class="alert alert-info {{ $movie->directors->count() > 0 ? 'd-none' : '' }}">
                                                                            <i class="fas fa-info-circle mr-1"></i> No
                                                                            directors associated with this movie.
                                                                        </div>
                                                                        <div id="selected-directors-list" class="row">
                                                                            @foreach ($movie->directors as $index => $director)
                                                                                <div class="col-md-3 mb-4 director-item" data-id="{{ $director->id }}" data-job="{{ $director->pivot->job }}">
                                                                                    <div class="card h-100">
                                                                                        <img src="{{ $director->profile_photo ?: asset('backend/assets/image/no-profile.png') }}"
                                                                                            class="card-img-top" alt="{{ $director->name }}"
                                                                                            style="height: 200px; object-fit: cover;">
                                                                                        <div class="card-body">
                                                                                            <h5 class="card-title">{{ $director->name }}</h5>
                                                                                            <p class="card-text text-muted">
                                                                                                {{ $director->pivot->job }}
                                                                                            </p>
                                                                                            <input type="hidden" name="directors[{{ $index }}][id]" value="{{ $director->id }}">
                                                                                            <input type="hidden" name="directors[{{ $index }}][name]" value="{{ $director->name }}">
                                                                                            <input type="hidden" name="directors[{{ $index }}][profile_photo]" value="{{ $director->profile_photo }}">
                                                                                            <input type="hidden" name="directors[{{ $index }}][job]" value="{{ $director->pivot->job }}">
                                                                                            <input type="hidden" name="directors[{{ $index }}][biography]" value="{{ $director->biography }}">
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
                const url = $(this).val();
                if (url) {
                    $('#poster_preview').attr('src', url).removeClass('d-none');
                    $('#no-poster-preview').addClass('d-none');
                } else {
                    $('#poster_preview').addClass('d-none');
                    $('#no-poster-preview').removeClass('d-none');
                }
            });

            // Image preview for backdrop
            $('#backdrop_url').on('input', function() {
                const url = $(this).val();
                if (url) {
                    $('#backdrop_preview').attr('src', url).removeClass('d-none');
                    $('#no-backdrop-preview').addClass('d-none');
                } else {
                    $('#backdrop_preview').addClass('d-none');
                    $('#no-backdrop-preview').removeClass('d-none');
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
                const tmdbId = $('#tmdb_id').val();
                if (!tmdbId) {
                    alert('Please enter a TMDB ID');
                    return;
                }

                // Show loading state
                $(this).html('<i class="fas fa-spinner fa-spin"></i> Fetching...').attr('disabled', true);

                // Simulate API call (replace with actual AJAX call)
                setTimeout(() => {
                    // Reset button state
                    $(this).html('<i class="fas fa-cloud-download-alt"></i> Fetch from TMDB').attr('disabled', false);

                    // Show success message
                    alert('Movie data fetched successfully!');
                }, 1500);
            });

            // Trailer preview button
            $('#previewTrailerBtn').click(function() {
                const trailerUrl = $('#trailer_url').val();
                if (!trailerUrl) {
                    alert('Please enter a trailer URL');
                    return;
                }

                // Check if it's a YouTube URL
                const youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
                const match = trailerUrl.match(youtubeRegex);

                if (match && match[1]) {
                    // It's a YouTube video, show in modal
                    const videoId = match[1];
                    $('#trailer-iframe').attr('src', `https://www.youtube.com/embed/${videoId}`);
                    $('#trailer-modal').modal('show');
                } else {
                    // Not a YouTube URL, open in new tab
                    window.open(trailerUrl, '_blank');
                }
            });

            // Close trailer modal and stop video
            $('#trailer-modal').on('hidden.bs.modal', function() {
                $('#trailer-iframe').attr('src', '');
            });

            // Form validation
            $('#movieForm').submit(function(e) {
                const requiredFields = ['title', 'type', 'status'];
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!$(`#${field}`).val()) {
                        isValid = false;
                        $(`#${field}`).addClass('is-invalid');
                    } else {
                        $(`#${field}`).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill out all required fields');
                    return false;
                }
            });
        });
    </script>
@endpush
