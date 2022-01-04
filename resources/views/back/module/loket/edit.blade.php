@php
    $user = Auth::user();
@endphp
<input type="hidden" name="id" value="{{ $modul->id }}">
<div class="row">
    @if ($user->id_profile == '1')
        <div class="col-md-12">
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
    <div class="col-md-12">
        <label>Nama Loket</label>
        <input class="form-control" name="nama_loket" value="{{ $modul->nama_loket }}" required>
        <br>
    </div>
    <div class="col-md-12">
        <label>Kode Loket</label>
        @php $huruf = 'a'; @endphp
        <select class="form-control" name="kd_loket" required>
            <option value="">Pilih Kode Loket</option>
            @while ($huruf != 'z')
                @php $abjad = strtoupper($huruf); @endphp 
                    <option value="{{ $abjad }}" <?php if($modul->kd_loket == $abjad){ echo "selected"; } ?>>{{ $abjad }}</option>
                @php $huruf = chr(ord($huruf) + 1); @endphp 
            @endwhile
            <option value="Z" <?php if($modul->kd_loket == 'Z'){ echo "selected"; } ?>>Z</option>
        </select>
    </div>
</div>