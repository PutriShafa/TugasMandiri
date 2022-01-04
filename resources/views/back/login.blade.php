<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('public/back/assets/images/favicon.png') }}">
    <title>Administrator</title>
    <link href="{{ URL::asset('public/back/dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url({{ URL::asset('public/back/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-3 col-md-5 modal-bg-img">
                </div>
                <div class="col-lg-7 bg-white">
                    <div class="p-3">
                        <h2 class="mt-3 text-center">Administrator Login</h2>
                        <form class="mt-4" action="{{ URL::to('login') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="uname" type="email" placeholder="Email" name="email" required value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control" id="pwd" type="password"
                                            placeholder="password" name="password">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        @php
            $message = session('message');
            if (session('alert') == 0) {
                $color = 'red';
                $pesan = 'Error!';
            } else {
                $color = 'green';
                $pesan = 'Success';
            }
        @endphp
        <div class="toast" data-delay="5000" style="position: absolute; bottom: 0; right: 0; margin-right: 20px;">
            <div class="toast-header">
                <strong class="mr-auto" style="color: {{ $color }}">{{ $pesan }}</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{ $message }}
            </div>
        </div>
    @endif

    @error('email')
        <div class="toast" data-delay="5000" style="position: absolute; bottom: 0; right: 0; margin-right: 20px;">
            <div class="toast-header">
                <strong class="mr-auto" style="color: red">Error !</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Format Email Salah
            </div>
        </div>
    @enderror

    <script src="{{ URL::asset('public/back/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ URL::asset('public/back/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>
        $(".preloader ").fadeOut();
        $('.toast').toast('show');
    </script>
</body>

</html>