<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('public/back/assets/images/favicon.png') }}">
    <title>{{ $title }}</title>
    <link href="{{ URL::asset('public/back/assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/back/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/back/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/back/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/back/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <script src="{{ URL::asset('public/back/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ URL::asset('public/back/dist/js/feather.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ URL::asset('public/back/dist/js/custom.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        @include('back.layout.partial.menu')

        <div class="page-wrapper">
            @yield('konten')

            <footer class="footer text-center text-muted">
                Copyright &copy; {{ date('Y') }}
            </footer>
        </div>

    </div>

</body>
</html>