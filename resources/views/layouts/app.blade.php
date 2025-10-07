<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/')}}/template/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/') }}/template/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('/')}}/template/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('/') }}/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('/') }}/template/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}/template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @guest
        <li class="nav-item">
            Belum Login
        </li>
        @endguest
        @auth
        <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Log Out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        @endauth
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SIHADIR</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
        @yield('content')
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.1 Beta
    </div>
    <strong>Copyright &copy; 2023 <a href="{{url('/')}}">SIHADIR</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- jQuery -->
<script src="{{asset('/')}}/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/')}}/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('/') }}/template/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/')}}/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/')}}/template/dist/js/demo.js"></script>
<!-- Toastr -->
<script src="{{ asset('/') }}/template/plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('/') }}/template/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('/') }}/template/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('/') }}/template/dist/js/demo.js"></script>
<!-- jQuery Mapael -->
<script src="{{ asset('/') }}/template/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ asset('/') }}/template/plugins/raphael/raphael.min.js"></script>
<script src="{{ asset('/') }}/template/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ asset('/') }}/template/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- PAGE SCRIPTS -->
<script src="{{ asset('/') }}/template/dist/js/pages/dashboard2.js"></script>
@yield('js')
<script>
  $(function () {
    $("#tables").DataTable();
    $("#absensiTable").DataTable({"pageLength": 50});
  });
</script>
  <script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    @if (Session::has('success'))
    Toast.fire({
        type: 'success',
        title: '{{Session::get('success')}}'
    });
    @elseif (Session::has('errors'))
    Toast.fire({
        type: 'error',
        title: '{{Session::get('errors')}}'
    });
    @endif
  });
</script>
</body>
</html>
