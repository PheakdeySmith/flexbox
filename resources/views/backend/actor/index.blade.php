@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-tie mr-2"></i>Actors</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Actors</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessToast("{{ session('success') }}");
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showErrorToast("{{ session('error') }}");
            });
        </script>
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Actor Management</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createActorModal">
                            <i class="fas fa-plus mr-1"></i> Add New Actor
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="actorsTable" class="table table-bordered table-striped table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Name</th>
                                <th width="25%">Biography</th>
                                <th width="15%">Profile Image</th>
                                <th width="10%">Birth Date</th>
                                <th width="10%">Movies</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($actors ?? [] as $actor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $actor->name }}</strong>
                                    </td>
                                    <td>{{ Str::limit($actor->biography ?? 'No biography available', 100) }}</td>
                                    <td class="text-center">
                                        @if($actor->profile_photo)
                                            <img src="{{ $actor->profile_photo }}" alt="{{ $actor->name }}" width="50" class="img-thumbnail">
                                        @else
                                            <span class="badge badge-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $actor->birth_date ? $actor->birth_date->format('M d, Y') : 'N/A' }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-info">{{ $actor->movies->count() }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('actor.show', $actor->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                data-toggle="modal" data-target="#editActorModal"
                                                data-id="{{ $actor->id }}"
                                                data-name="{{ $actor->name }}"
                                                data-biography="{{ $actor->biography }}"
                                                data-birth-date="{{ $actor->birth_date ? $actor->birth_date->format('Y-m-d') : '' }}"
                                                data-profile-photo="{{ $actor->profile_photo }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $actor->id }}"
                                                data-url="{{ route('actor.destroy', $actor->id) }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No actors found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Create Actor Modal -->
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

<!-- Edit Actor Modal -->
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        $('#actorsTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [
                { "orderable": false, "targets": [3, 6] }
            ]
        });

        // Handle modal show event for edit
        $('.edit-btn').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const biography = $(this).data('biography');
            const birthDate = $(this).data('birth-date');
            const profilePhoto = $(this).data('profile-photo');

            // Update the form action URL
            const form = $('#editActorForm');
            form.attr('action', form.attr('action').replace(':id', id));

            // Populate form fields
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_biography').val(biography);
            $('#edit_birth_date').val(birthDate);
            $('#edit_profile_photo').val(profilePhoto);

            // Set profile photo preview
            const preview = $('#edit_preview_image');
            if (profilePhoto) {
                preview.attr('src', profilePhoto);
            } else {
                preview.attr('src', 'https://via.placeholder.com/200x200?text=No+Image');
            }
        });

        // Preview profile photo when URL changes (create form)
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

        // Preview profile photo when URL changes (edit form)
        document.getElementById('edit_profile_photo').addEventListener('input', function() {
            const photoUrl = this.value.trim();
            const previewImg = document.getElementById('edit_preview_image');

            if (photoUrl) {
                previewImg.src = photoUrl;
            } else {
                previewImg.src = 'https://via.placeholder.com/200x200?text=No+Image';
            }
        });

        // Delete Actor Functionality
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const actorId = this.getAttribute('data-id');
                const deleteUrl = this.getAttribute('data-url');

                Swal.fire({
                    title: 'Delete Actor',
                    text: 'Are you sure you want to delete this actor?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then(result => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = deleteUrl;
                        form.style.display = 'none';

                        form.appendChild(createInput('_token', '{{ csrf_token() }}'));
                        form.appendChild(createInput('_method', 'DELETE'));

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });

        // Helper function to create input elements
        function createInput(name, value) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = value;
            return input;
        }

        // Open TMDB search modal for create
        document.getElementById('search-tmdb-btn').addEventListener('click', function() {
            $('#tmdbSearchModal').modal('show');
            $('#createActorModal').modal('hide');

            // Add event to handle returning to create modal after TMDB search
            $('#tmdbSearchModal').on('hidden.bs.modal', function() {
                $('#createActorModal').modal('show');
            });
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

                // Determine which modal is currently active
                var isEditModalActive = $('#editActorModal').hasClass('show');

                if (isEditModalActive) {
                    // Fill the edit form
                    $('#edit_name').val(actorName);
                    $('#edit_profile_photo').val(profileUrl);
                    document.getElementById('edit_preview_image').src = profileUrl;

                    // Fetch additional actor details for edit form
                    fetchActorDetailsForEdit(actorId);
                } else {
                    // Fill the create form
                    $('#name').val(actorName);
                    $('#profile_photo').val(profileUrl);
                    document.getElementById('preview_image').src = profileUrl;
                    document.getElementById('image_name').textContent = 'TMDB Image';

                    // Fetch additional actor details for create form
                    fetchActorDetailsForCreate(actorId);
                }

                // Close the TMDB search modal
                $('#tmdbSearchModal').modal('hide');
            });
        }

        // Function to fetch additional actor details for create form
        function fetchActorDetailsForCreate(actorId) {
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

        // Function to fetch additional actor details for edit form
        function fetchActorDetailsForEdit(actorId) {
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
                        $('#edit_biography').val(data.biography);
                    }

                    // Fill birth date if available
                    if (data.birthday) {
                        $('#edit_birth_date').val(data.birthday);
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
