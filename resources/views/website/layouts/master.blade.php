<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("meta-title")

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/toggle/toggle.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.css')}}">

    @yield("stylesheets")
    <link rel="icon" href="{{asset("admin-assets/images/laravel.png")}}" />
    <link rel="shortcut icon" href="{{asset("admin-assets/images/laravel.png")}}" />
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60"
            width="60">
        </div> --}}
        
        @include('website.layouts.header')
        
        <!-- Sidebar Menu -->
        @include('website.layouts.sidebar')
        <!-- /.sidebar-menu -->
        
        @yield('content')
        
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        @include('website.layouts.footer')
    </div>

    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/js/demo.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/js/pages/dashboard2.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin-assets/dist/js/datepicker.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ asset('admin-assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    {{-- <script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

    <script>
        $('.datepicker').datepicker();
    </script>
    @livewireScripts
    @stack('script')
</body>

</html>
