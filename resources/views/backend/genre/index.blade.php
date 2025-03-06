@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
            <div class="d-flex justify-content-end mb-2">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Add New Genre
              </button>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Genre Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Other browsers</td>
                    <td>All others</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</a>
                        <a href="#" class="btn btn-danger delete-btn" data-id="1">Delete</a>
                    </td>
                  </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
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
              // Here you would handle the deletion
              // Example: window.location.href = '/genre/delete/' + genreId;
              showSuccessToast('This is a success message');
            }
          });
        });
      });
    });
  </script>
@endsection
