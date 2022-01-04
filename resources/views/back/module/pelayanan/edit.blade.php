@extends('back.layout.main')

@section('konten')

@php
    $user = Auth::user();
@endphp

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Pelayanan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-muted">Data Master</a></li>
                        <li class="breadcrumb-item"><a class="text-muted">Pelayanan</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Edit Pelayanan</li>
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
                    <form method="POST" action="{{ URL::to('ubah_pelayanan') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $modul->id }}">
                        <div class="row">
                            @if ($user->id_profile == '1')
                                <div class="col-md-6">
                                    <label>Instansi</label>
                                    <select class="form-control" name="id_instansi" required>
                                        <option value="">Pilih Instansi</option>
                                        @foreach ($instansi as $item)
                                            <option value="{{ $item->id }}" <?php if($modul->id_instansi == $item->id){ echo "selected"; } ?>>{{ $item->instansi }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label>Loket</label>
                                <select class="form-control" name="id_loket" required>
                                    <option value="">Pilih Loket</option>
                                    @foreach ($loket as $item)
                                        <option value="{{ $item->id }}" <?php if($modul->id_loket == $item->id){ echo "selected"; } ?>>{{ $item->nama_loket }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label>Produk Pelayanan</label>
                                <input class="form-control" name="produk_pelayanan" value="{{ $modul->produk_pelayanan }}" required>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label>Jangka Waktu</label>
                                <input class="form-control" name="jangka_waktu" value="{{ $modul->jangka_waktu }}" required>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label>Biaya / Tarif</label>
                                <input class="form-control" name="tarif" value="{{ $modul->tarif }}" required>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Persyaratan</label>
                                <div class="tinymce-wrap">
                                    <textarea class="tinymce" name="persyaratan">{!! $modul->persyaratan !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Sistem Mekanisme dan Prosedur</label>
                                <div class="tinymce-wrap">
                                    <textarea class="tinymce" name="prosedur">{!! $modul->prosedur !!}</textarea>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label>Dasar hukum</label>
                                <div class="tinymce-wrap">
                                    <textarea class="tinymce" name="dasar_hukum">{!! $modul->dasar_hukum !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Edit</button>
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
</script>

@endsection