<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <script src="{{ asset('AdminLTE') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('AdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  @include('backend.partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('backend.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  @include('backend.partials.footer')


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('AdminLTE') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('AdminLTE') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('AdminLTE') }}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('AdminLTE') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('AdminLTE') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('AdminLTE') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('AdminLTE') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('AdminLTE') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('AdminLTE') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE') }}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('AdminLTE') }}/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('AdminLTE') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

<script>
  $(function() {
    // Initialize SweetAlert2 Toast
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    // Success Toast
    window.showSuccessToast = function(message) {
      Toast.fire({
        icon: 'success',
        title: message || 'Operation completed successfully!'
      });
    };

    // Error Toast
    window.showErrorToast = function(message) {
      Toast.fire({
        icon: 'error',
        title: message || 'An error occurred!'
      });
    };

    // Warning Toast
    window.showWarningToast = function(message) {
      Toast.fire({
        icon: 'warning',
        title: message || 'Warning!'
      });
    };

    // Info Toast
    window.showInfoToast = function(message) {
      Toast.fire({
        icon: 'info',
        title: message || 'Information!'
      });
    };

    // Question Toast
    window.showQuestionToast = function(message) {
      Toast.fire({
        icon: 'question',
        title: message || 'Question?'
      });
    };

    // Show confirmation dialog
    window.showConfirmDialog = function(title, text, callback) {
      Swal.fire({
        title: title || 'Are you sure?',
        text: text || "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed && typeof callback === 'function') {
          callback();
        }
      });
    };

    // Process Flash Messages from Laravel
    @if(session('success'))
      showSuccessToast("{{ session('success') }}");
    @endif

    @if(session('error'))
      showErrorToast("{{ session('error') }}");
    @endif

    @if(session('warning'))
      showWarningToast("{{ session('warning') }}");
    @endif

    @if(session('info'))
      showInfoToast("{{ session('info') }}");
    @endif
  });
</script>

</body>
</html>
