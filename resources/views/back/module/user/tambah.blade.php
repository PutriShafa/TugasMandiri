@extends('back.layout.main')

@section('konten')

@php
    $user = Auth::user();
    if ($user->id_profile == '2' || $user->id_profile == '3') {
        $hide = "";
    } else {
        $hide = 'd-none';
    }
@endphp

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah User</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-muted">User</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Tambah User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('tambah_user') }}">
                        @csrf
                        @if ($user->id_profile == '1')
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Profil</label>
                                    <select class="form-control" name="id_profile" id="profile" required>
                                        <option value="">Pilih Profil</option>
                                        <option value="1">Super Administrator</option>
                                        <option value="2">Administrator</option>
                                        <option value="3">Loket</option>
                                    </select>
                                    <br>
                                </div>
                            </div>
                            <div class="row instansi d-none">
                                <div class="col-md-6">
                                    <label>Instansi</label>
                                    <select class="form-control" name="id_instansi" id="instansi">
                                        <option value="">Pilih Instansi</option>
                                        @foreach ($instansi as $item)
                                            <option value="{{ $item->id }}">{{ $item->instansi }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                            </div>
                        @endif
                        <div class="row loket {{ $hide }}">
                            <div class="col-md-6">
                                <label>Loket</label>
                                <select class="form-control" name="id_loket" id="loket">
                                    <option value="">Pilih Loket</option>
                                    @foreach ($loket as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_loket }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Lengkap" required>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Retype Password</label>
                                <input type="password" class="form-control" name="repassword" placeholder="Masukkan Password Lagi" required>
                                <br>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@error('repassword')
    <div class="toast" data-delay="5000" style="position: absolute; right: 0; top: 0; margin-right: 20px; margin-top: 100px; background-color: #fff;">
        <div class="toast-header">
            <strong class="mr-auto" style="color: red">Error!</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Password tidak sama
        </div>
    </div>
@enderror

@if (session()->has('message'))
    @php
        $message = session('message');
        if (session('alert') == 0) {
            $color = 'red';
            $pesan = 'Error!';
        } else {
            $color = 'green';
            $pesan = 'Sukses';
        }
    @endphp
    <div class="toast" data-delay="5000" style="position: absolute; right: 0; top: 0; margin-right: 20px; margin-top: 100px; background-color: #fff;">
        <div class="toast-header">
            <strong class="mr-auto" style="color: {{ $color }}">{{ $pesan }}</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ $message }}
        </div>
    </div>
@endif

<script src="{!! asset('public/back/tinymce/tinymce.min.js') !!}"></script>
<script src="{!! asset('public/back/tinymce-data.js') !!}"></script>

<script>
    $('#zero_config').DataTable();
    $('.toast').toast('show');

    $('#profile').on('change', function(){
        var profil = this.value;
        if (profil == '2' || profil == '3') {
            $('.instansi').removeClass('d-none');
            $('#instansi').prop('required',true);
        } else {
            $('.instansi').addClass('d-none');
            $('#instansi').prop('required',false);
        }

        if (profil == '3') {
            $('.loket').removeClass('d-none');
            $('#loket').prop('required',true);
        } else {
            $('.loket').addClass('d-none');
            $('#loket').prop('required',false);
        }
    });
</script>

@endsection