<!DOCTYPE html>
<html lang="en">
<head>
    @include('template.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('assets/dist/img/synodev-logo.png') }}" alt="SynoDev Logo" height="150" width="150">
        </div>

        @include('template.navbar')

        @include('template.sidebar')

        @include('sweetalert::alert')

        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        @include('template.footer')

    </div>
    <!-- ./wrapper -->

    @include('template.script')
    @include('template.datatable')

</body>
</html>
