@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-tie mr-2"></i>Add New Actor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('actor.index') }}"><i class="fas fa-users"></i> Actors</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Flash Message Display -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Check for flash messages
        @if(session('success'))
          showSuccessToast("{{ session('success') }}");
        @endif

        @if(session('error'))
          showErrorToast("{{ session('error') }}");
        @endif
      });
    </script>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Actor Information</h3>
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

                            <div class="modal fade" id="createActorModal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title text-white"><i class="fas fa-plus-circle mr-2"></i>Create Actor</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="createActorForm" action="{{ route('actor.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="name"><i class="fas fa-user mr-1"></i>Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter actor's name" required>
                                                            <small class="form-text text-muted">Enter the full name of the actor</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="biography"><i class="fas fa-book mr-1"></i>Biography</label>
                                                            <textarea class="form-control" id="biography" name="biography" rows="5" placeholder="Enter actor's biography"></textarea>
                                                            <small class="form-text text-muted">Provide a detailed biography of the actor</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="birth_date"><i class="fas fa-calendar-alt mr-1"></i>Birth Date</label>
                                                            <input type="date" class="form-control" id="birth_date" name="birth_date">
                                                            <small class="form-text text-muted">Enter the actor's date of birth</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="profile_photo"><i class="fas fa-image mr-1"></i>Profile Photo URL</label>
                                                            <input type="text" class="form-control" id="profile_photo" name="profile_photo" placeholder="https://example.com/photo.jpg">
                                                            <small class="form-text text-muted">Enter a URL for the actor's profile photo</small>
                                                        </div>

                                                        <div class="text-center mt-3">
                                                            <div class="img-preview">
                                                                <img id="preview_image" src="https://via.placeholder.com/200x200?text=No+Image"
                                                                     class="img-fluid rounded border" alt="Profile Preview">
                                                            </div>
                                                            <small id="image_name" class="d-block mt-2 text-muted"></small>
                                                        </div>

                                                        <div class="form-group mt-3">
                                                            <label><i class="fas fa-film mr-1"></i>Search Actor</label>
                                                            <button type="button" class="btn btn-outline-primary btn-block" id="search-tmdb-btn">
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
                                                    <i class="fas fa-save mr-1"></i>Save Actor
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- TMDB Search Modal -->
                            <div class="modal fade" id="tmdbSearchModal">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <h4 class="modal-title text-white"><i class="fas fa-search mr-2"></i>Search Actor from TMDB</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="movie-search-input"><i class="fas fa-film mr-1"></i>Search for a Movie</label>
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
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                <i class="fas fa-times mr-1"></i>Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            const previewImg = document.getElementById('preview_image');
            const imageName = document.getElementById('image_name');

            if (photoUrl) {
                previewImg.src = photoUrl;
                imageName.textContent = 'External URL';
            } else {
                previewImg.src = 'https://via.placeholder.com/200x200?text=No+Image';
                imageName.textContent = '';
            }
        });

        // Open TMDB search modal
        document.getElementById('search-tmdb-btn').addEventListener('click', function() {
            $('#tmdbSearchModal').modal('show');
        });

        // Search movies when clicking the search button
        $('#movie-search-button').on('click', function() {
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
                    $('#movie-search-loading').addClass('d-none');

                    if (data.results && data.results.length > 0) {
                        // Display results
                        displayMovieResults(data.results);
                    } else {
                        $('#movie-no-results').removeClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
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
                    : 'https://via.placeholder.com/342x513?text=No+Poster';

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
                    $('#actor-results').empty();

                    if (data.cast && data.cast.length > 0) {
                        displayActors(data.cast);
                    } else {
                        $('#no-actors-message').removeClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
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
                    : 'https://via.placeholder.com/185x278?text=No+Profile';

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

                // Fill the form with actor data
                $('#name').val(actorName);
                $('#profile_photo').val(profileUrl);

                // Show profile photo preview
                document.getElementById('preview_image').src = profileUrl;
                document.getElementById('image_name').textContent = 'TMDB Image';

                // Fetch additional actor details
                fetchActorDetails(actorId);

                // Close the TMDB search modal
                $('#tmdbSearchModal').modal('hide');
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

        // Reset form when modal is closed
        $('#createActorModal').on('hidden.bs.modal', function() {
            $('#createActorForm').trigger('reset');
            document.getElementById('preview_image').src = 'https://via.placeholder.com/200x200?text=No+Image';
            document.getElementById('image_name').textContent = '';
        });
    });
</script>
@endsection
