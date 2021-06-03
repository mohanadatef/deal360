<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.admin.head')
    @yield('head_style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
@include('includes.admin.header')
<!-- Content Wrapper. Contains page content -->
@yield('content')
<!-- /.content-wrapper -->
@include('includes.admin.footer')
<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('includes.admin.script')
</body>
</html>
