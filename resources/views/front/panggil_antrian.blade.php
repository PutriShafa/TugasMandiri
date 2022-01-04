<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Panggil Antrian</title>

    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/assets/css/main.css') }}">

    <link rel="shortcut icon" href="{{ URL::asset('front/assets/images/favicon.png') }}" type="image/x-icon">
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
            </div>
        </div>
    </header>
    <!--============= Header Section Ends Here =============-->

    <!--============= Banner Section Starts Here =============-->
    <section class="banner-2 bg_img" data-background="{{ URL::asset('front/assets/images/banner/banner-2.jpg') }}"
        style="margin-top: -50px; height: 650px;">
        <div class="container">
            <div class="banner-content-2">
                <h1 class="title cl-white">Nomor Antrian</h1>
            </div>
            <div class="row mb-30-none justify-content-center">
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <div class="how-search-item">
                        <div class="content">
                            @php
                                if ($antrian == null) {
                                    $no_antrian = '';
                                } else {
                                    $no_antrian = $antrian->no_antrian;
                                }
                            @endphp
                            <h1 class="title" id="no_antrian">{{ $no_antrian }}</h1>
                            <input type="hidden" id="antrian_sekarang" value="{{ $no_antrian }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Banner Section Ends Here =============-->


    <script src="{{ URL::asset('front/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/plugins.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/wow.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/waypoints.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/nice-select.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/owl.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('front/assets/js/main.js') }}"></script>
    <script src='https://code.responsivevoice.org/responsivevoice.js'></script>

    <script>
        var auto_refresh = setInterval(function() {
            $.ajax({
                type: 'post',
                url: 'panggil_antrian',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('#no_antrian').text(data[0]);
                    var no_antrian = $('#antrian_sekarang').val();

                    // responsiveVoice.speak("Nomor antrian 3 SIlahkan menuju ke loket","Indonesian Female",{
                    //     pitch: 0, 
                    //     rate: 1, 
                    //     volume: 2
                    // });

                    if (no_antrian != data[0] && data[0] != undefined) {
                        $('#antrian_sekarang').val(data[0]);
                        var loket = data[1];
                        console.log(loket);
                        responsiveVoice.speak("Nomor antrian" + data[0] + " segera ke " + loket,
                            "Indonesian Female", {
                                pitch: 0,
                                rate: 1,
                                volume: 2
                            });
                    }
                }
            });
        }, 2000);
    </script>

</body>

</html>
