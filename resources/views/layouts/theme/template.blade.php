@extends('layouts.theme.headers')

@section('body')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.theme.navbar')
        <!-- Main Sidebar Container -->
     

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          
            <!-- Main content -->
            @yield('content')
      
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->


        @include('layouts.theme.footers')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    @yield('script')
</body>
@endsection