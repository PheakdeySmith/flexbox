@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Genres</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Genres</li>
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
            <div class="d-flex justify-content-end mb-2">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i> Add New Genre
              </button>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Genre Management</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @forelse($genres ?? [] as $genre)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $genre->name }}</td>
                      <td>{{ $genre->slug }}</td>
                      <td>{{ $genre->created_at->diffForHumans() }}</td>
                      <td>
                        <a href="#" class="btn btn-primary btn-sm"
                           data-toggle="modal"
                           data-target="#editModal"
                           data-id="{{ $genre->id }}"
                           data-name="{{ $genre->name }}"
                           data-slug="{{ $genre->slug }}">
                          <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#"
                           class="btn btn-danger btn-sm delete-btn"
                           data-id="{{ $genre->id }}"
                           data-url="{{ route('genre.destroy', $genre->id) }}">
                          <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                  </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center">No genres found</td>
                  </tr>
                  @endforelse
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
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



  @include('backend.genre.create')
  @include('backend.genre.edit')

  <!-- Test buttons for SweetAlert2 -->
  <div class="card mt-4">
    <div class="card-header">
      <h3 class="card-title">SweetAlert2 Examples</h3>
    </div>
    <div class="card-body">
      <h5>Toast Notifications</h5>
      <div class="mb-3">
        <button type="button" class="btn btn-success" id="successToastBtn">Show Success Toast</button>
        <button type="button" class="btn btn-danger" id="errorToastBtn">Show Error Toast</button>
        <button type="button" class="btn btn-warning" id="warningToastBtn">Show Warning Toast</button>
        <button type="button" class="btn btn-info" id="infoToastBtn">Show Info Toast</button>
      </div>

      <h5>Confirmation Dialogs</h5>
      <div class="mb-3">
        <button type="button" class="btn btn-secondary" id="confirmDialogBtn">Show Confirm Dialog</button>
        <button type="button" class="btn btn-danger delete-test-btn">Test Delete Dialog</button>
      </div>

      <p class="text-muted">
        Note: These examples show how the SweetAlert2 library works.
        The delete buttons in the table also use SweetAlert2 for confirmation.
      </p>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var deleteButtons = document.querySelectorAll('.delete-btn');

      // Add click event listener to each button
      deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          const genreId = this.getAttribute('data-id');
          const deleteUrl = this.getAttribute('data-url');

          // Show SweetAlert2 confirmation
          Swal.fire({
            title: 'Delete Genre',
            text: 'Are you sure you want to delete this genre?',
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
      });
    });
  </script>
@endsection
