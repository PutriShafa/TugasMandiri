<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Pelayanan;
use App\Models\Antrian;
use App\Models\Loket;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function index(){
        $instansi = Instansi::latest()->get();
        return view('front.index',[
            'title' => 'Pemilihan Instansi',
            'instansi' => $instansi
        ]);
    }

    public function pelayanan($slug){
        $instansi = Instansi::find($slug);
        $pelayanan = Pelayanan::where('id_instansi',$instansi->id)->get();
        return view('front.pelayanan',[
            'title' => 'Pelayanan',
            'instansi' => $instansi,
            'pelayanan' => $pelayanan
        ]);
    }

    public function persyaratan($slug){
        $pelayanan = Pelayanan::find($slug);
        return view('front.persyaratan',[
            'title' => 'Persyaratan',
            'pelayanan' => $pelayanan
        ]);
    }

    public function no_antrian(){
        $modul = new Antrian;
        $modul->id_instansi = request('id_instansi');
        $modul->id_pelayanan = request('id_pelayanan');
        $modul->id_loket = request('id_loket');

        $cek_antrian = Antrian::whereDate('created_at',Carbon::today())->where('id_loket',request('id_loket'))->latest()->first();
        $loket = Loket::find(request('id_loket'));
        if ($cek_antrian == null) {
            $no_antrian = $loket->kd_loket."001";
        } else {
            $antrian = "1".str_replace($loket->kd_loket,'',$cek_antrian->no_antrian);
            $tambah_antrian = (int)$antrian + 1;
            $no_antrian = $loket->kd_loket.substr($tambah_antrian,1);
        }

        $modul->no_antrian = $no_antrian;
        $modul->status = '0';
        $modul->lama_proses = null;

        if ($modul->save()) {
            return Redirect::to('pemilihan_instansi')->with([
                'alert' => 1,
                'message' => 'Berhasil'
            ]);
        } else {
            return Redirect::to('pemilihan_instansi')->with([
                'alert' => 0,
                'message' => 'Gagal'
            ]);
        }
    }

    public function panggil_antrian(){
        $antrian = Antrian::where('status','1')->orderBy('updated_at','desc')->first();
        return view('front.panggil_antrian',[
            'title' => 'Panggil Antrian',
            'antrian' => $antrian
        ]);
    }

    public function panggil_antrian_ref(){
        $antrian = Antrian::where('status','1')->orderBy('updated_at','desc')->first();
        if ($antrian == null) {
            $no_antrian = "";
        } else {
            $loket = Loket::find($antrian->id_loket);
            $no_antrian = [
                $antrian->no_antrian,
                $loket->nama_loket
            ];
        }
        return $no_antrian;
    }
}
