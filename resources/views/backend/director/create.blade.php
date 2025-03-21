@extends('backend.layouts.app')

@section('content')
<style>
    /* Styling for the tabs and content */
    #movie-search {
        padding: 20px 0;
    }

    /* Improve the director results container styling */
    #director-results-container {
        margin-top: 30px;
        border-top: 1px solid #dee2e6;
        padding-top: 30px;
    }

    /* Improve card styling */
    .movie-card, .director-card {
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
    }

    .movie-card:hover, .director-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    /* Improve image containers */
    .poster-container {
        height: 300px;
        overflow: hidden;
    }

    .profile-container {
        height: 250px;
        overflow: hidden;
    }

    /* Loading indicator styling */
    .loading-container {
        padding: 40px;
        text-align: center;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-tie mr-2"></i>Add New director</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('director.index') }}"><i class="fas fa-users"></i> Directors</a></li>
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
                            <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Director Information</h3>
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

                            <!-- Form content organized with tabs -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <ul class="nav nav-tabs" id="directorTabs" role="tablist">
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

                            <form action="{{ route('director.store') }}" method="POST" id="directorForm" enctype="multipart/form-data">
                                @csrf

                                <div class="tab-content" id="directorTabContent">
                                    <!-- Movie Search Tab -->
                                    <div class="tab-pane fade" id="movie-search" role="tabpanel" aria-labelledby="movie-search-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle mr-1"></i> Search for movies to find directors.
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

                                                <div id="movie-search-loading" class="loading-container d-none">
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

                                                <!-- director Results Section -->
                                                <div id="director-results-container" class="mt-4 d-none">
                                                    <h4 class="mb-3">
                                                        <i class="fas fa-users mr-2"></i>
                                                        directors in <span id="selected-movie-title" class="text-primary"></span>
                                                    </h4>

                                                    <div id="director-loading" class="loading-container d-none">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                        <p class="mt-2">Loading directors...</p>
                                                    </div>

                                                    <div id="director-results" class="row">
                                                        <!-- director results will be displayed here -->
                                                    </div>

                                                    <div id="no-directors-message" class="alert alert-info d-none">
                                                        <i class="fas fa-info-circle mr-1"></i> No directors found for this movie.
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
                                                            value="{{ old('name') }}" placeholder="Enter director name" required>
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
                                                            value="{{ old('birth_date') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="profile_photo">
                                                        <i class="fas fa-image mr-1"></i> Profile Photo
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                                                        </div>
                                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*">
                                                    </div>
                                                    <div id="profile-photo-preview" class="mt-2 text-center" style="display: none;">
                                                        <img src="" alt="Profile Preview" class="img-thumbnail" style="max-height: 200px;">
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
                                                        placeholder="Enter director biography">{{ old('biography') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save mr-1"></i> Save director
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
        // Preview profile photo when a file is selected
        document.getElementById('profile_photo').addEventListener('change', function() {
            const file = this.files[0];
            const previewContainer = document.getElementById('profile-photo-preview');
            const previewImg = previewContainer.querySelector('img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewImg.src = '';
                previewContainer.style.display = 'none';
            }
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
            $('#director-results-container').addClass('d-none');
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
                    '<div class="card movie-card shadow-sm">' +
                    '<div class="poster-container">' +
                    '<img src="' + posterUrl + '" class="card-img-top" alt="' + movie.title + '" style="width: 100%; height: 100%; object-fit: cover;">' +
                    '</div>' +
                    '<div class="card-body">' +
                    '<h5 class="card-title text-primary">' + movie.title + '</h5>' +
                    '<p class="card-text text-muted"><i class="far fa-calendar-alt mr-1"></i>' + releaseYear + '</p>' +
                    '<button type="button" class="btn btn-sm btn-success w-100 select-movie" data-id="' + movie.id + '" data-title="' + movie.title + '">' +
                    '<i class="fas fa-check mr-1"></i> Select' +
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
                fetchMovieDirectors(movieId);
            });
        }

        // Function to fetch directors for a movie
        function fetchMovieDirectors(movieId) {
            $('#director-results').empty();
            $('#no-directors-message').addClass('d-none');
            $('#director-results-container').removeClass('d-none');
            $('#director-loading').removeClass('d-none');

            $.ajax({
                url: 'https://api.themoviedb.org/3/movie/' + movieId + '/credits',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4Yzc1NjUxNzIxMTE4YzJiMWExYTIxMjJmNWZmZWU3YSIsIm5iZiI6MTc0MTE0MDM5MS41NjQsInN1YiI6IjY3YzdiMWE3MGEwMDU3NjE0M2MyOGIwYyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.k1w1YejJkhyptQRCP2NmVAQSNACbTHSBN_PMI0z8BPA',
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    $('#director-loading').addClass('d-none');

                    if (data.cast && data.cast.length > 0) {
                        displayDirectors(data.cast);
                    } else {
                        $('#no-directors-message').removeClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
                    $('#director-loading').addClass('d-none');
                    $('#director-results').html('<div class="col-12"><div class="alert alert-danger">Failed to load directors. Please try again.</div></div>');
                }
            });
        }

        // Function to display directors
        function displayDirectors(directors) {
            var container = $('#director-results');

            // Limit to top 12 directors
            directors = directors.slice(0, 12);

            $.each(directors, function(index, director) {
                var profileUrl = director.profile_path
                    ? 'https://image.tmdb.org/t/p/w185' + director.profile_path
                    : 'https://via.placeholder.com/185x278?text=No+Profile';

                var html = '<div class="col-md-3 mb-4">' +
                    '<div class="card director-card shadow-sm">' +
                    '<div class="profile-container">' +
                    '<img src="' + profileUrl + '" class="card-img-top" alt="' + director.name + '" style="width: 100%; height: 100%; object-fit: cover;">' +
                    '</div>' +
                    '<div class="card-body">' +
                    '<h5 class="card-title text-primary">' + director.name + '</h5>' +
                    '<p class="card-text text-muted">' + (director.character ? '<i class="fas fa-theater-masks mr-1"></i>' + director.character : '') + '</p>' +
                    '<button type="button" class="btn btn-sm btn-primary w-100 select-director" ' +
                    'data-name="' + director.name + '" ' +
                    'data-profile="' + profileUrl + '" ' +
                    'data-id="' + director.id + '">' +
                    '<i class="fas fa-check mr-1"></i> Select' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                container.append(html);
            });

            // Add click event for select director buttons
            $('.select-director').on('click', function() {
                var directorId = $(this).data('id');
                var directorName = $(this).data('name');
                var profileUrl = $(this).data('profile');

                // Fill the form with director data
                $('#name').val(directorName);

                // Automatically fetch the profile photo if available
                if (profileUrl && profileUrl !== 'https://via.placeholder.com/185x278?text=No+Profile') {
                    // Add hidden field to store the photo URL
                    if (!$('#profile_photo_url').length) {
                        $('<input>').attr({
                            type: 'hidden',
                            id: 'profile_photo_url',
                            name: 'profile_photo_url',
                            value: profileUrl
                        }).appendTo('#directorForm');
                    } else {
                        $('#profile_photo_url').val(profileUrl);
                    }

                    // Show the preview of the profile photo
                    const previewContainer = document.getElementById('profile-photo-preview');
                    const previewImg = previewContainer.querySelector('img');
                    previewImg.src = profileUrl;
                    previewContainer.style.display = 'block';

                    // Add helpful message
                    if (!$('#photo-message').length) {
                        $('#profile-photo-preview').after('<div id="photo-message" class="alert alert-info mt-2">Profile photo will be automatically downloaded from TMDB.</div>');
                    }
                }

                // Fetch additional director details
                fetchDirectorDetails(directorId);

                // Switch to basic tab
                $('#basic-tab').tab('show');
            });
        }

        // Function to fetch additional director details
        function fetchDirectorDetails(directorId) {
            $.ajax({
                url: 'https://api.themoviedb.org/3/person/' + directorId,
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
                    console.error('Failed to fetch director details:', error);
                }
            });
        }
    });
</script>
@endsection
