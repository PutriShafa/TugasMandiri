<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Instansi;

class LoketController extends Controller
{
    public function index(){
        $user = Auth::user();
        $modul = Loket::where(function($a) use ($user) {
            if ($user->id_profile == '2') {
                $a->where('id_instansi',$user->id_instansi);
            }
        })
        ->latest()
        ->get();
        $instansi = Instansi::get();
        return view('back.module.loket.index',[
            'title' => 'Loket',
            'modul' => $modul,
            'instansi' => $instansi,
        ]);
    }

    public function tambah(){
        $user = Auth::user();
        $modul = new Loket;
        if ($user->id_profile == '1') {
            $modul->id_instansi = request('id_instansi');
        } else {
            $modul->id_instansi = $user->id_instansi;
        }

        $cek_kd = Loket::where('kd_loket',request('kd_loket'))->get();
        if (count($cek_kd) > 0) {
            return Redirect::to('loket')->with([
                'alert' => 0,
                'message' => 'Kode Loket Sudah Digunakan'
            ]);
        }
        $modul->kd_loket = request('kd_loket');
        $modul->nama_loket = request('nama_loket');

        if ($modul->save()) {
            return Redirect::to('loket')->with([
                'alert' => 1,
                'message' => 'Berhasil Menambah Loket'
            ]);
        }else{
            return Redirect::to('loket')->with([
                'alert' => 0,
                'message' => 'Gagal Menambah Loket'
            ]);
        }
    }

    public function detail_edit(){
        $modul = Loket::find(request('id'));
        $instansi = Instansi::get();
        return view('back.module.loket.edit',[
            'title' => 'Loket',
            'modul' => $modul,
            'instansi' => $instansi,
        ]);
    }

    public function edit(){
        $user = Auth::user();
        $modul = Loket::find(request('id'));
        if ($user->id_profile == '1') {
            $modul->id_instansi = request('id_instansi');
        } else {
            $modul->id_instansi = $user->id_instansi;
        }

        $cek_kd = Loket::where('id','!=',$modul->id)->where('kd_loket',request('kd_loket'))->get();

        if (count($cek_kd) > 0) {
            return Redirect::to('loket')->with([
                'alert' => 0,
                'message' => 'Kode Loket Sudah Digunakan'
            ]);
        }

        $modul->kd_loket = request('kd_loket');
        $modul->nama_loket = request('nama_loket');

        if ($modul->save()) {
            return Redirect::to('loket')->with([
                'alert' => 1,
                'message' => 'Berhasil Mengubah Loket'
            ]);
        }else{
            return Redirect::to('loket')->with([
                'alert' => 0,
                'message' => 'Gagal Mengubah Loket'
            ]);
        }
    }

    public function hapus(){
        $modul = Loket::find(request('id'));

        if ($modul->delete()) {
            return Redirect::to('loket')->with([
                'alert' => 1,
                'message' => 'Berhasil Menghapus Loket'
            ]);
        }else{
            return Redirect::to('loket')->with([
                'alert' => 0,
                'message' => 'Gagal Menghapus Loket'
            ]);
        }
    }
}
