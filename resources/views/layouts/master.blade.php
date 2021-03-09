<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/main.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light headeratas">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: #fff;"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link" style="color: #fff;">Home</a>
      </li>
      <li class="nav-item mt-1 btn btn-info">
        {{ Carbon\Carbon::now()->format('l, d F Y')}}
      </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->


      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button" style="color: #fff">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>


      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" style="color: #fff;" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebarsamping">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link text-center">
      <span class="brand-text font-weight-light text-center">SIANG BRPS </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-1 mb-2 d-flex">
        <div class="info text-center">
            <h3 style="color: #fff; text-transform: uppercase; font-size: 12px;">{{Auth::user()->name}}</h3>
            <p style="color: #fff; text-transform: uppercase;">
                {{ print_r(Auth::user()->getRoleNames()[0], 1) }}
            </p>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @role('Admin')
          <li class="nav-item {{ (request()->is('User*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('User*')) ? 'active' : '' }}">
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <p>
                USER
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('user.data')}}" class="nav-link {{ (request()->is('User*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DATA USER</p>
                </a>
              </li>
            </ul>
          </li>
          @endrole


          {{-- DATA BUS --}}
          @role('Pelaksana|Admin|User')
          <li class="nav-item {{ (request()->is('Keberangkatan*')) ? 'menu-open' : '' }} {{ (request()->is('Kedatangan*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('Keberangkatan*')) ? 'active' : '' }} {{ (request()->is('Kedatangan*')) ? 'active' : '' }}">
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <p>
                KATEGORI
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('keberangkatan.index')}}" class="nav-link {{ (request()->is('Keberangkatan*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>KEBERANGKATAN</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('kedatangan.index')}}" class="nav-link {{ (request()->is('Kedatangan*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>KEDATANGAN</p>
                </a>
              </li>

            </ul>
          </li>
          @endrole
          
          @role('User')
          {{-- DATA KENDARARAAN USER --}}
          <li class="nav-item {{ (request()->is('Kendaraan*')) ? 'menu-open' : '' }} {{ (request()->is('Kendaraan*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('Kendaraan*')) ? 'active' : '' }} {{ (request()->is('Kendaraan*')) ? 'active' : '' }}">
            
              <p>
                DATA KENDARARAAN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('kendaraan.index')}}" class="nav-link {{ (request()->is('Kendaraan*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>BUS</p>
                </a>
                
              </li>
            </ul>
          </li>

          {{-- DATA OPERASIONAL --}}

          <li class="nav-item {{ (request()->is('Operasional*')) ? 'menu-open' : '' }} {{ (request()->is('Operasional*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('Operasional*')) ? 'active' : '' }} {{ (request()->is('Operasional*')) ? 'active' : '' }}">
            
              <p>
                OPERASIONAL
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('operasional.keberangkatan')}}" class="nav-link {{ (request()->is('Operasional/Keberangkatan*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keberangkatan</p>
                </a>
                
              </li>
            </ul>
          </li>
          @endrole



          {{-- DATA MASTER --}}
          @role('Admin')
          <li class="nav-item {{ (request()->is('Bus*')) ? 'menu-open' : '' }} {{ (request()->is('Provinsi*')) ? 'menu-open' : '' }} {{ (request()->is('Terminal*')) ? 'menu-open' : '' }} {{ (request()->is('Po*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('Bus*')) ? 'active' : '' }} {{ (request()->is('Provinsi*')) ? 'active' : '' }} {{ (request()->is('Terminal*')) ? 'active' : '' }} {{ (request()->is('Po*')) ? 'active' : '' }}">
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <p>
                DATA MASTER
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('bus.index')}}" class="nav-link {{ (request()->is('Bus*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>BUS</p>
                </a>
                <a href="{{route('provinsi.index')}}" class="nav-link {{ (request()->is('Provinsi*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>PROVINSI</p>
                  </a>
                <a href="{{route('terminal.index')}}" class="nav-link {{ (request()->is('Terminal*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>TERMINAL</p>
                  </a>
                  <a href="{{route('po.index')}}" class="nav-link {{ (request()->is('Po*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>PO</p>
                  </a>
              </li>
            </ul>
        </li>
        @endrole

        @role('Pelaksana')
        {{-- DATA OPERASIONAL --}}

        <li class="nav-item {{ (request()->is('Operasional*')) ? 'menu-open' : '' }} {{ (request()->is('Operasional*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->is('Operasional*')) ? 'active' : '' }} {{ (request()->is('Operasional*')) ? 'active' : '' }}">
          
            <p>
              OPERASIONAL
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('operasional.kedatangan')}}" class="nav-link {{ (request()->is('Operasional/Kedatangan*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Kedatangan</p>
              </a>
              
            </li>
          </ul>
        </li>
        @endrole

        {{-- LAPORAN --}}
        @role('Admin')
        <li class="nav-item {{ (request()->is('Laporan*')) ? 'menu-open' : '' }} {{ (request()->is('Laporan*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->is('Laporan*')) ? 'active' : '' }} {{ (request()->is('Laporan*')) ? 'active' : '' }}">
            {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
            <p>
              LAPORAN
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('laporan.keberangkatan')}}" class="nav-link {{ (request()->is('Laporan/Keberangkatan*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>KEBERANGKATAN</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('laporan.kedatangan')}}" class="nav-link {{ (request()->is('Laporan/Kedatangan*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>KEDATANGAN</p>
              </a>
            </li>

          </ul>
        </li>
      @endrole



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#">SIANG BRPS</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('sweetalert::alert')

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
{{-- <!-- AdminLTE for demo purposes -->
<script src="adminlte/dist/js/demo.js"></script>
<!-- Page specific script --> --}}
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [ "excel", "colvis"]
    }).buttons().container().appendTo('#table2 .col-md-6:eq(0)');
  });
</script>
</body>
</html>
