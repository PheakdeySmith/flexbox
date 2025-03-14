@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-tie mr-2"></i>Edit Actor: {{ $actor->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('actor.index') }}"><i class="fas fa-users"></i> Actors</a></li>
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Actor Information</h3>
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

                            <div class="modal fade" id="editActorModal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title text-white"><i class="fas fa-edit mr-2"></i>Edit Actor</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="editActorForm" action="{{ route('actor.update', ':id') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="edit_id" name="actor_id">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="edit_name"><i class="fas fa-user mr-1"></i>Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter actor's name" required>
                                                            <small class="form-text text-muted">Enter the full name of the actor</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="edit_biography"><i class="fas fa-book mr-1"></i>Biography</label>
                                                            <textarea class="form-control" id="edit_biography" name="biography" rows="5" placeholder="Enter actor's biography"></textarea>
                                                            <small class="form-text text-muted">Provide a detailed biography of the actor</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="edit_birth_date"><i class="fas fa-calendar-alt mr-1"></i>Birth Date</label>
                                                            <input type="date" class="form-control" id="edit_birth_date" name="birth_date">
                                                            <small class="form-text text-muted">Enter the actor's date of birth</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="edit_profile_photo"><i class="fas fa-image mr-1"></i>Profile Photo URL</label>
                                                            <input type="text" class="form-control" id="edit_profile_photo" name="profile_photo" placeholder="https://example.com/photo.jpg">
                                                            <small class="form-text text-muted">Enter a URL for the actor's profile photo</small>
                                                        </div>

                                                        <div class="text-center mt-3">
                                                            <div class="img-preview">
                                                                <img id="edit_preview_image" src="" class="img-fluid rounded border" alt="Actor Profile">
                                                            </div>
                                                            <small class="d-block mt-2 text-muted">Current profile photo</small>
                                                        </div>

                                                        <div class="form-group mt-3">
                                                            <label><i class="fas fa-film mr-1"></i>Search Actor</label>
                                                            <button type="button" class="btn btn-outline-primary btn-block" id="edit-search-tmdb-btn">
                                                                <i class="fas fa-search mr-1"></i> Search TMDB
                                                            </button>
                                                            <small class="form-text text-muted">Search for actor information from TMDB</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between bg-light">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    <i class="fas fa-times mr-1"></i>Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save mr-1"></i>Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('actor.update', $actor->id) }}" method="POST" id="actorForm">
                                @csrf
                                @method('PUT')

                                <!-- Form content organized with tabs -->
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <ul class="nav nav-tabs" id="actorTabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" id="movie-search-tab" data-toggle="tab" href="#movie-search" role="tab" aria-controls="movie-search" aria-selected="false">
                                                    <i class="fas fa-search mr-1"></i> Movie Search
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">
                                                    <i class="fas fa-info-circle mr-1"></i> Basic Information
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content" id="actorTabContent">
                                    <!-- Movie Search Tab -->
                                    <div class="tab-pane fade" id="movie-search" role="tabpanel" aria-labelledby="movie-search-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle mr-1"></i> Search for movies to find actors.
                                                </div>

                                                <div class="form-group">
                                                    <label for="movie-search-input">
                                                        <i class="fas fa-search mr-1"></i> Search for a Movie
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="movie-search-input" placeholder="Enter movie title...">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-primary" id="movie-search-button">
                                                                <i class="fas fa-search"></i> Search
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="movie-search-loading" class="text-center p-3 d-none">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                    <p class="mt-2">Searching movies...</p>
                                                </div>

                                                <div id="movie-search-results" class="row mt-3">
                                                    <!-- Search results will be displayed here -->
                                                </div>

                                                <div id="movie-no-results" class="alert alert-warning d-none">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i> No movies found. Please try a different search term.
                                                </div>

                                                <div id="movie-error" class="alert alert-danger d-none">
                                                    <i class="fas fa-times-circle mr-1"></i> An error occurred while searching. Please try again.
                                                </div>

                                                <!-- Actor Results Section -->
                                                <div id="actor-results-container" class="mt-4 d-none">
                                                    <h4 class="mb-3">Actors in <span id="selected-movie-title"></span></h4>
                                                    <div id="actor-results" class="row">
                                                        <!-- Actor results will be displayed here -->
                                                    </div>
                                                    <div id="no-actors-message" class="alert alert-info d-none">
                                                        <i class="fas fa-info-circle mr-1"></i> No actors found for this movie.
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
                                                    <label for="name">
                                                        <i class="fas fa-user mr-1"></i> Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="name" name="name"
                                                            value="{{ old('name', $actor->name) }}" placeholder="Enter actor name" required>
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
                                                            value="{{ old('birth_date', $actor->birth_date ? $actor->birth_date->format('Y-m-d') : '') }}">
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
                                                            value="{{ old('profile_photo', $actor->profile_photo) }}" placeholder="https://example.com/photo.jpg">
                                                    </div>
                                                    <div id="profile-photo-preview" class="mt-2 text-center" style="{{ $actor->profile_photo ? '' : 'display: none;' }}">
                                                        <img src="{{ $actor->profile_photo }}" alt="{{ $actor->name }}" class="img-thumbnail" style="max-height: 200px;">
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
                                                        placeholder="Enter actor biography">{{ old('biography', $actor->biography) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save mr-1"></i> Update Actor
                                        </button>
                                        <a href="{{ route('actor.index') }}" class="btn btn-secondary">
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
        // Handle modal show event
        $('#editActorModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const { id, name, biography, birthDate, profilePhoto } = button.data();

            const modal = $(this);

            // Update the form action URL
            modal.find('#editActorForm').attr('action', `/backend/actor/${id}`);
            modal.find('#edit_id').val(id);
            modal.find('#edit_name').val(name);
            modal.find('#edit_biography').val(biography);
            modal.find('#edit_birth_date').val(birthDate);
            modal.find('#edit_profile_photo').val(profilePhoto);

            // Set profile photo preview
            const preview = modal.find('#edit_preview_image');

            if (profilePhoto) {
                preview.attr('src', profilePhoto);
            } else {
                preview.attr('src', 'https://via.placeholder.com/200x200?text=No+Image');
            }
        });

        // Preview profile photo when URL changes
        document.getElementById('edit_profile_photo').addEventListener('input', function() {
            const photoUrl = this.value.trim();
            const previewImg = document.getElementById('edit_preview_image');

            if (photoUrl) {
                previewImg.src = photoUrl;
            } else {
                previewImg.src = 'https://via.placeholder.com/200x200?text=No+Image';
            }
        });

        // Open TMDB search modal for edit
        document.getElementById('edit-search-tmdb-btn').addEventListener('click', function() {
            $('#tmdbSearchModal').modal('show');
            $('#editActorModal').modal('hide');

            // Add event to handle returning to edit modal after TMDB search
            $('#tmdbSearchModal').on('hidden.bs.modal', function() {
                $('#editActorModal').modal('show');
            });
        });

        // Search movies when clicking the search button
        $('#movie-search-button').on('click', function() {
            console.log('Search button clicked');
            var query = $('#movie-search-input').val().trim();

            if (query.length === 0) {
                window.showWarningToast('Please enter a search term');
                return;
            }

            // Show loading, hide previous results
            $('#movie-search-results').empty();
            $('#movie-no-results').addClass('d-none');
            $('#movie-error').addClass('d-none');
            $('#actor-results-container').addClass('d-none');
            $('#movie-search-loading').removeClass('d-none');

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
                    $('#movie-search-loading').addClass('d-none');

                    if (data.results && data.results.length > 0) {
                        // Display results
                        displayMovieResults(data.results);
                    } else {
                        $('#movie-no-results').removeClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Search failed', error);
                    $('#movie-search-loading').addClass('d-none');
                    $('#movie-error').removeClass('d-none');
                    window.showErrorToast('Search failed: ' + error);
                }
            });
        });

        // Function to display movie search results
        function displayMovieResults(results) {
            var container = $('#movie-search-results');

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
                    '<button type="button" class="btn btn-sm btn-success w-100 select-movie" data-id="' + movie.id + '" data-title="' + movie.title + '">' +
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
                var movieTitle = $(this).data('title');
                console.log('Selected movie ID:', movieId);
                $('#selected-movie-title').text(movieTitle);
                fetchMovieActors(movieId);
            });
        }

        // Function to fetch actors for a movie
        function fetchMovieActors(movieId) {
            $('#actor-results').empty();
            $('#no-actors-message').addClass('d-none');
            $('#actor-results-container').removeClass('d-none');

            // Show loading in actor results
            $('#actor-results').html('<div class="col-12 text-center p-3"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div><p class="mt-2">Loading actors...</p></div>');

            $.ajax({
                url: 'https://api.themoviedb.org/3/movie/' + movieId + '/credits',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4Yzc1NjUxNzIxMTE4YzJiMWExYTIxMjJmNWZmZWU3YSIsIm5iZiI6MTc0MTE0MDM5MS41NjQsInN1YiI6IjY3YzdiMWE3MGEwMDU3NjE0M2MyOGIwYyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.k1w1YejJkhyptQRCP2NmVAQSNACbTHSBN_PMI0z8BPA',
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    console.log('Movie credits:', data);
                    $('#actor-results').empty();

                    if (data.cast && data.cast.length > 0) {
                        displayActors(data.cast);
                    } else {
                        $('#no-actors-message').removeClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch movie credits:', error);
                    $('#actor-results').html('<div class="col-12"><div class="alert alert-danger">Failed to load actors. Please try again.</div></div>');
                }
            });
        }

        // Function to display actors
        function displayActors(actors) {
            var container = $('#actor-results');

            // Limit to top 12 actors
            actors = actors.slice(0, 12);

            $.each(actors, function(index, actor) {
                var profileUrl = actor.profile_path
                    ? 'https://image.tmdb.org/t/p/w185' + actor.profile_path
                    : '{{ asset('backend/assets/image/no-profile.png') }}';

                var html = '<div class="col-md-3 mb-4">' +
                    '<div class="card h-100">' +
                    '<img src="' + profileUrl + '" class="card-img-top" alt="' + actor.name + '" style="height: 250px; object-fit: cover;">' +
                    '<div class="card-body">' +
                    '<h5 class="card-title">' + actor.name + '</h5>' +
                    '<p class="card-text text-muted">' + (actor.character ? 'as ' + actor.character : '') + '</p>' +
                    '<button type="button" class="btn btn-sm btn-primary w-100 select-actor" ' +
                    'data-name="' + actor.name + '" ' +
                    'data-profile="' + profileUrl + '" ' +
                    'data-id="' + actor.id + '">' +
                    '<i class="fas fa-check"></i> Select' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                container.append(html);
            });

            // Add click event for select actor buttons
            $('.select-actor').on('click', function() {
                var actorId = $(this).data('id');
                var actorName = $(this).data('name');
                var profileUrl = $(this).data('profile');

                console.log('Selected actor:', actorName);

                // Fill the form with actor data
                $('#name').val(actorName);
                $('#profile_photo').val(profileUrl);

                // Show profile photo preview
                const previewContainer = document.getElementById('profile-photo-preview');
                const previewImg = previewContainer.querySelector('img');
                previewImg.src = profileUrl;
                previewContainer.style.display = 'block';

                // Fetch additional actor details
                fetchActorDetails(actorId);

                // Switch to basic tab
                $('#basic-tab').tab('show');
            });
        }

        // Function to fetch additional actor details
        function fetchActorDetails(actorId) {
            $.ajax({
                url: 'https://api.themoviedb.org/3/person/' + actorId,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4Yzc1NjUxNzIxMTE4YzJiMWExYTIxMjJmNWZmZWU3YSIsIm5iZiI6MTc0MTE0MDM5MS41NjQsInN1YiI6IjY3YzdiMWE3MGEwMDU3NjE0M2MyOGIwYyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.k1w1YejJkhyptQRCP2NmVAQSNACbTHSBN_PMI0z8BPA',
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    console.log('Actor details:', data);

                    // Fill biography
                    if (data.biography) {
                        $('#biography').val(data.biography);
                    }

                    // Fill birth date if available
                    if (data.birthday) {
                        $('#birth_date').val(data.birthday);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch actor details:', error);
                }
            });
        }
    });
</script>
@endsection
