<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Loket;

class PelayananController extends Controller
{
    public function index(){
        $user = Auth::user();
        $modul = Pelayanan::where(function($a) use ($user) {
            if ($user->id_profile == '2') {
                $a->where('id_instansi',$user->id_instansi);
            }
        })
        ->latest()
        ->get();
        return view('back.module.pelayanan.index',[
            'title' => 'Pelayanan',
            'modul' => $modul
        ]);
    }

    public function tambah_pelayanan(){
        $instansi = Instansi::get();
        $loket = Loket::get();
        return view('back.module.pelayanan.tambah',[
            'title' => 'Pelayanan',
            'instansi' => $instansi,
            'loket' => $loket,
        ]);
    }

    public function tambah(){
        $user = Auth::user();
        $modul = new Pelayanan;
        if ($user->id_profile == '1') {
            $modul->id_instansi = request('id_instansi');
        } else {
            $modul->id_instansi = $user->id_instansi;
        }
        $modul->id_loket = request('id_loket');
        $modul->produk_pelayanan = request('produk_pelayanan');
        $modul->persyaratan = request('persyaratan');
        $modul->prosedur = request('prosedur');
        $modul->jangka_waktu = request('jangka_waktu');
        $modul->tarif = request('tarif');
        $modul->dasar_hukum = request('dasar_hukum');

        if ($modul->save()) {
            return Redirect::to('pelayanan')->with([
                'alert' => 1,
                'message' => 'Berhasil Menambah Pelayanan'
            ]);
        }else{
            return Redirect::to('pelayanan')->with([
                'alert' => 0,
                'message' => 'Gagal Menambah Pelayanan'
            ]);
        }
    }

    public function edit_pelayanan(){
        $modul = Pelayanan::find(request('id'));
        $instansi = Instansi::get();
        $loket = Loket::get();
        return view('back.module.pelayanan.edit',[
            'title' => 'Pelayanan',
            'instansi' => $instansi,
            'loket' => $loket,
            'modul' => $modul,
        ]);
    }

    public function edit(){
        $user = Auth::user();
        $modul = Pelayanan::find(request('id'));
        if ($user->id_profile == '1') {
            $modul->id_instansi = request('id_instansi');
        } else {
            $modul->id_instansi = $user->id_instansi;
        }
        $modul->id_loket = request('id_loket');
        $modul->produk_pelayanan = request('produk_pelayanan');
        $modul->persyaratan = request('persyaratan');
        $modul->prosedur = request('prosedur');
        $modul->jangka_waktu = request('jangka_waktu');
        $modul->tarif = request('tarif');
        $modul->dasar_hukum = request('dasar_hukum');

        if ($modul->update()) {
            return Redirect::to('pelayanan')->with([
                'alert' => 1,
                'message' => 'Berhasil Mengubah Pelayanan'
            ]);
        }else{
            return Redirect::to('pelayanan')->with([
                'alert' => 0,
                'message' => 'Gagal Mengubah Pelayanan'
            ]);
        }
    }

    public function hapus(){
        $modul = Pelayanan::find(request('id'));

        if ($modul->delete()) {
            return Redirect::to('pelayanan')->with([
                'alert' => 1,
                'message' => 'Berhasil Menghapus Pelayanan'
            ]);
        }else{
            return Redirect::to('pelayanan')->with([
                'alert' => 0,
                'message' => 'Gagal Menghapus Pelayanan'
            ]);
        }
    }
}

