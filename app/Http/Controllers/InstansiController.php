<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pelayanan;
use App\Models\Loket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class InstansiController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user->id_profile != '1'){
            return view('errors/404');
        }

        $modul = Instansi::get();
        return view('back.module.instansi.index',[
            'title' => 'Instansi',
            'modul' => $modul
        ]);
    }

    public function tambah(){
        $user = Auth::user();
        if($user->id_profile != '1'){
            return view('errors/404');
        }

        $modul = new Instansi;
        $modul->instansi = request('instansi');

        if ($modul->save()) {
            return Redirect::to('instansi')->with([
                'alert' => 1,
                'message' => 'Berhasil Menambah Instansi'
            ]);
        }else{
            return Redirect::to('instansi')->with([
                'alert' => 0,
                'message' => 'Gagal Menambah Instansi'
            ]);
        }
    }

    public function edit(){
        $user = Auth::user();
        if($user->id_profile != '1'){
            return view('errors/404');
        }

        $modul = Instansi::find(request('id'));
        $modul->instansi = request('instansi');

        if ($modul->update()) {
            return Redirect::to('instansi')->with([
                'alert' => 1,
                'message' => 'Berhasil Mengubah Instansi'
            ]);
        }else{
            return Redirect::to('instansi')->with([
                'alert' => 0,
                'message' => 'Gagal Mengubah Instansi'
            ]);
        }
    }

    public function hapus(){
        $user = Auth::user();
        if($user->id_profile != '1'){
            return view('errors/404');
        }

        $modul = Instansi::find(request('id'));
        $modul2 = Pelayanan::where('id_instansi',$modul->id);
        $modul2->delete();
        $modul3 = Loket::where('id_instansi',$modul->id);
        $modul3->delete();
        $modul4 = User::where('id_instansi',$modul->id);
        $modul4->delete();

        if ($modul->delete()) {
            return Redirect::to('instansi')->with([
                'alert' => 1,
                'message' => 'Berhasil Menghapus Instansi'
            ]);
        }else{
            return Redirect::to('instansi')->with([
                'alert' => 0,
                'message' => 'Gagal Menghapus Instansi'
            ]);
        }
    }
}
