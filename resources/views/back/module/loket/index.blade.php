@extends('back.layout.main')

@section('konten')

@php
    use App\Models\Instansi;
    $user = Auth::user();
@endphp

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Loket</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-muted">Data Master</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Loket</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Loket</button>
            </div>
        </div>
    </div>
</div>

<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ URL::to('loket') }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah Loket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($user->id_profile == '1')
                            <div class="col-md-12">
                                <label>Instansi</label>
                                <select class="form-control" name="id_instansi" required>
                                    <option value="">Pilih Instansi</option>
                                    @foreach ($instansi as $item)
                                        <option value="{{ $item->id }}">{{ $item->instansi }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <label>Nama Loket</label>
                            <input class="form-control" name="nama_loket" placeholder="Masukkan nama Loket" required>
                            <br>
                        </div>
                        <div class="col-md-12">
                            <label>Kode Loket</label>
                            @php
                                $huruf = 'a';
                            @endphp
                            <select class="form-control" name="kd_loket" required>
                                <option value="">Pilih Kode Loket</option>
                                @while ($huruf != 'z')
                                    @php $abjad = strtoupper($huruf); @endphp 
                                        <option value="{{ $abjad }}">{{ $abjad }}</option>
                                    @php $huruf = chr(ord($huruf) + 1); @endphp 
                                @endwhile
                                <option value="Z">Z</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Loket</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Instansi</th>
                                    <th>Nama Loket</th>
                                    <th>Kode Loket</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($modul as $item)
                                    @php
                                        $getinstansi = Instansi::find($item->id_instansi);
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $getinstansi->instansi }}</td>
                                        <td>{{ $item->nama_loket }}</td>
                                        <td>{{ $item->kd_loket }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary edit" data-toggle="modal" data-target="#edit" value="{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger hapus" data-toggle="modal" data-target="#hapus" value="{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ URL::to('edit_loket') }}">
        @csrf
        <input type="hidden" name="id" id="id_edit">
        <div class="modal-dialog">
            <form method="POST" action="{{ URL::to('edit_loket') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Loket</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="layout_edit"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </form>
</div>

<div id="hapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ URL::to('hapus_loket') }}">
        @csrf
        <input type="hidden" name="id" id="id_hapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Hapus Loket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus Loket ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
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
    $('#zero_config').DataTable();
    $('.toast').toast('show');

    $('.edit').click(function() {
        var valueid = $(this).attr("value");
        $.ajax({
            type: 'post',
            url: 'detail_edit_loket',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": valueid,
            },
            success : function(data){
                $('.layout_edit').html(data);
            }
        });
    });

    $('.hapus').click(function() {
        var valueid = $(this).attr("value");
        $('#id_hapus').val(valueid);
    });
</script>

@endsection