@extends('back.layout.main')

@section('konten')

@php
    use App\Models\Instansi;
    $user = Auth::user();
@endphp

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Antrian</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Antrian</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">
                
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-hover">
                        <div class="p-2 bg-primary text-center">
                            <h1 class="font-light text-white">{{ count($antrian_selesai) }}</h1>
                            <h6 class="text-white">Antrian Selesai</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-1 col-xlg-3"></div>
                <div class="col-md-6 col-lg-4 col-xlg-3">
                    <div class="card card-hover">
                        <div class="p-2 bg-primary text-center">
                            <h1 class="font-light text-white">{{ count($total_antrian) }}</h1>
                            <h6 class="text-white">Total Antrian</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-1 col-xlg-3"></div>
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-hover">
                        <div class="p-2 bg-primary text-center">
                            <h1 class="font-light text-white">{{ count($antrian_menunggu) }}</h1>
                            <h6 class="text-white">Antrian Menunggu</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card" style="border: solid #e9ecef">
                <div class="card-body">
                    <h4 class="card-title">
                        <center>Dipanggil</center>
                    </h4>
                    <div class="card card-hover">
                        <div class="p-2 bg-success text-center">
                            <h1 class="font-light text-white">
                                @php
                                    if ($antrian_sekarang == null) {
                                        $now = "Tidak Ada";
                                    } else {
                                        $now = $antrian_sekarang->no_antrian;
                                    }
                                @endphp
                                {{ $now }}
                            </h1>
                        </div>
                    </div>
                    <center>
                        @if ($antrian_sekarang != null)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lewati">Lewati</button>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#selesai">Selesai</button>
                            <button class="btn btn-danger">Panggil Lagi</button>
                        @endif
                    </center>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card" style="border: solid #e9ecef">
                <div class="card-body">
                    <h4 class="card-title">
                        <center>Antrian Selanjutnya</center>
                    </h4>
                    <div class="card card-hover">
                        <div class="p-2 bg-warning text-center">
                            <h1 class="font-light text-white">
                                @php
                                    if ($antrian_selanjutnya == null) {
                                        $next = "Tidak Ada";
                                    } else {
                                        $next = $antrian_selanjutnya->no_antrian;
                                    }
                                @endphp
                                {{ $next }}
                            </h1>
                        </div>
                    </div>
                    <center>
                        @if ($antrian_selanjutnya != null)
                            @php
                                if ($antrian_sekarang != null) {
                                    $disabled = "disabled";
                                } else {
                                    $disabled = "";
                                }
                            @endphp
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#panggil" {{ $disabled }}>Panggil</button>
                        @endif
                    </center>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card" style="border: solid #e9ecef">
                <div class="card-body">
                    <h4 class="card-title">
                        <center>Antrian Dilewati</center>
                    </h4>
                    <div class="row">
                        @if (count($antrian_dilewati) > 0)
                            @foreach ($antrian_dilewati as $item)
                                <div class="col-md-4">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-cyan text-center">
                                            <h1 class="font-light text-white">
                                                {{ $item->no_antrian }}
                                            </h1>
                                            @php
                                                if ($antrian_sekarang != null) {
                                                    $disabled = "disabled";
                                                } else {
                                                    $disabled = "";
                                                }
                                            @endphp
                                            <button type="button" class="btn btn-danger panggil_lagi" data-toggle="modal" data-target="#panggil_lagi" {{ $disabled }} value="{{ $item->id }}">Panggil</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="panggil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ URL::to('panggil_next') }}">
        @csrf
        @if ($antrian_selanjutnya != null)
            <input type="hidden" name="id" value="{{ $antrian_selanjutnya->id }}">
            <input type="hidden" name="id_loket" value="{{ $user->id_loket }}">
        @endif
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Panggil Antrian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    Panggil Nomor Antrian Ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Panggil</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="selesai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ URL::to('panggil_selesai') }}">
        @csrf
        @if ($antrian_sekarang != null)
            <input type="hidden" name="id" value="{{ $antrian_sekarang->id }}">
        @endif
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Antrian Selesai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    Apakah Antrian Ini Sudah Selesai?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="lewati" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ URL::to('panggil_lewati') }}">
        @csrf
        @if ($antrian_sekarang != null)
            <input type="hidden" name="id" value="{{ $antrian_sekarang->id }}">
        @endif
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Antrian Lewati</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    Yakin ingin melewati antrian ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Lewati</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="panggil_lagi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ URL::to('panggil_next') }}">
        @csrf
        <input type="hidden" name="id" value="" id="id_panggil">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Panggil Antrian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    Panggil Nomor Antrian Ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Panggil</button>
                </div>
            </div>
        </div>
    </form>
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

<script>
    $('.toast').toast('show');

    $('.panggil_lagi').click(function() {
        var valueid = $(this).attr("value");
        $('#id_panggil').val(valueid);
    });
</script>

@endsection