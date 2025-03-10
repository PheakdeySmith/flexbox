@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Actor Details: {{ $actor->name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('actor.index') }}">Actors</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  @if($actor->profile_photo)
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ $actor->profile_photo }}"
                         alt="{{ $actor->name }}">
                  @else
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('AdminLTE/dist/img/user4-128x128.jpg') }}"
                         alt="{{ $actor->name }}">
                  @endif
                </div>

                <h3 class="profile-username text-center">{{ $actor->name }}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Birth Date</b> <a class="float-right">{{ $actor->birth_date ? $actor->birth_date->format('M d, Y') : 'N/A' }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Created At</b> <a class="float-right">{{ $actor->created_at->format('M d, Y') }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Updated At</b> <a class="float-right">{{ $actor->updated_at->format('M d, Y') }}</a>
                  </li>
                </ul>

                <div class="d-flex justify-content-between">
                  <a href="{{ route('actor.edit', $actor->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="#" class="btn btn-danger delete-btn"
                     data-id="{{ $actor->id }}"
                     data-url="{{ route('actor.destroy', $actor->id) }}">
                    <i class="fas fa-trash"></i> Delete
                  </a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <h3 class="card-title">Biography</h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane">
                    <p>{{ $actor->biography ?? 'No biography available.' }}</p>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Movies Section -->
            <div class="card">
              <div class="card-header p-2">
                <h3 class="card-title">Movies</h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                @if($actor->movies->count() > 0)
                  <div class="row">
                    @foreach($actor->movies as $movie)
                      <div class="col-md-4 mb-3">
                        <div class="card h-100">
                          @if($movie->poster_url)
                            <img src="{{ $movie->poster_url }}" class="card-img-top" alt="{{ $movie->title }}" style="height: 200px; object-fit: cover;">
                          @else
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                              <i class="fas fa-film fa-3x text-white"></i>
                            </div>
                          @endif
                          <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text text-muted">
                              {{ $movie->release_date ? $movie->release_date->format('Y') : 'N/A' }}
                              @if($movie->pivot->character)
                                <br>as <strong>{{ $movie->pivot->character }}</strong>
                              @endif
                            </p>
                            <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-sm btn-info w-100">
                              <i class="fas fa-eye"></i> View Movie
                            </a>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @else
                  <p>No movies found for this actor.</p>
                @endif
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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var deleteButton = document.querySelector('.delete-btn');

      // Add click event listener to the button
      if (deleteButton) {
        deleteButton.addEventListener('click', function(e) {
          e.preventDefault();
          const actorId = this.getAttribute('data-id');
          const deleteUrl = this.getAttribute('data-url');

          // Show SweetAlert2 confirmation
          Swal.fire({
            title: 'Delete Actor',
            text: 'Are you sure you want to delete this actor?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              // Create a form element
              const form = document.createElement('form');
              form.method = 'POST';
              form.action = deleteUrl;
              form.style.display = 'none';

              // Add CSRF token
              const csrfToken = document.createElement('input');
              csrfToken.type = 'hidden';
              csrfToken.name = '_token';
              csrfToken.value = '{{ csrf_token() }}';
              form.appendChild(csrfToken);

              // Add method spoofing for DELETE
              const methodField = document.createElement('input');
              methodField.type = 'hidden';
              methodField.name = '_method';
              methodField.value = 'DELETE';
              form.appendChild(methodField);

              // Append form to body, submit it, then remove it
              document.body.appendChild(form);
              form.submit();
            }
          });
        });
      }
    });
  </script>
@endsection
