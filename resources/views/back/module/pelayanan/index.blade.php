@extends('back.layout.main')

@section('konten')

    @php
    use App\Models\Instansi;
    use App\Models\Loket;
    @endphp

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Pelayanan</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a class="text-muted">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-muted">Data Master</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Pelayanan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <a class="btn btn-primary" href="{{ URL::to('tambah_pelayanan') }}">Tambah Pelayanan</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Pelayanan</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Instansi</th>
                                        <th>Loket</th>
                                        <th>Pelayanan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($modul as $item)
                                        @php
                                            $instansi = Instansi::find($item->id_instansi);
                                            $loket = Loket::find($item->id_loket);
                                        @endphp
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $instansi->instansi }}</td>
                                            <td>{{ $loket->nama_loket }}</td>
                                            <td>{{ $item->produk_pelayanan }}</td>
                                            <td>
                                                <form method="POST" action="{{ URL::to('edit_pelayanan') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger hapus" data-toggle="modal"
                                                        data-target="#hapus" value="{{ $item->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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

    <div id="hapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form method="post" action="{{ URL::to('hapus_pelayanan') }}">
            @csrf
            <input type="hidden" name="id" id="id_hapus">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Hapus Pelayanan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus Pelayanan ini?
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
        <div class="toast" data-delay="5000"
            style="position: absolute; right: 0; top: 0; margin-right: 20px; margin-top: 100px; background-color: #fff;">
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

        $('.hapus').click(function() {
            var valueid = $(this).attr("value");
            $('#id_hapus').val(valueid);
        });
    </script>

@endsection
