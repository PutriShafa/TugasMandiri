<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Pemilihan Instansi</title>

    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/main.css') }}">

    <link rel="shortcut icon" href="{{ URL::asset('front/assets/images/favicon.png') }}" type="image/x-icon">
    <link href="{{ URL::asset('front/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
</head>

<body>
    <!--============= ScrollToTop Section Starts Here =============-->
    <div class="overlayer" id="overlayer">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>
    <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
    <div class="overlay"></div>
    <!--============= ScrollToTop Section Ends Here =============-->


    <!--============= Header Section Starts Here =============-->
    <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo-area">
                    <div class="logo">
                        <a href="{{ URL::to('pemilihan_instansi') }}">
                            <img src="{{ URL::asset('front/assets/images/logo/logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>
                @if (Auth::check())
                    <a href="{{ URL::to('logout') }}" class="cl-white">
                        Logout
                    </a>
                @else
                    <a href="{{ URL::to('login') }}" class="cl-white">
                        Login
                    </a>
                @endif
            </div>
        </div>
    </header>
    <!--============= Header Section Ends Here =============-->

    <!--============= Banner Section Starts Here =============-->
    <section class="banner-2 bg_img" data-background="{{ URL::asset('front/assets/images/banner/banner-2.jpg') }}"
        style="margin-top: -50px; min-height: 650px;">
        <div class="container">
            <div class="banner-content-2">
                <h1 class="title cl-white">Pilih Instansi</h1>
            </div>
            <div class="row mb-30-none justify-content-center">
                @foreach ($instansi as $item)
                    <div class="col-sm-10 col-md-6 col-lg-4">
                        <div class="how-search-item no-border">
                            <a href="{{ URL::to('instansi/' . $item->id) }}">
                                <div class="content">
                                    <h4 class="title">{{ $item->instansi }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--============= Banner Section Ends Here =============-->


    <script src="{{ URL::asset('front/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('front/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/plugins.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/wow.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/waypoints.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/nice-select.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/owl.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/main.js') }}"></script>

    @if (session()->has('message'))
        @php
            $message = session('message');
            if (session('alert') == 0) {
                $heading = 'Error !';
                $status = 'danger';
            } else {
                $heading = 'Success :)';
                $status = 'success';
            }
        @endphp
        <script>
            sweetAlert("{!! $heading !!}", "{!! $message !!}", "{!! $status !!}")
        </script>
    @endif
</body>

</html>
