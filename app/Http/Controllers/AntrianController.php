<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Carbon\Carbon;

class AntrianController extends Controller
{
    public function index(){
        $user = Auth::user();
        $antrian_selesai = Antrian::where('id_instansi',$user->id_instansi)
        ->where('id_loket',$user->id_loket)
        ->where('status','2')
        ->whereDate('created_at',Carbon::today())
        ->get();

        $antrian_menunggu = Antrian::where('id_instansi',$user->id_instansi)
        ->where('id_loket',$user->id_loket)
        ->where('status','0')
        ->whereDate('created_at',Carbon::today())
        ->get();

        $antrian_selanjutnya = Antrian::where('id_instansi',$user->id_instansi)
        ->where('id_loket',$user->id_loket)
        ->where('status','0')
        ->whereDate('created_at',Carbon::today())
        ->oldest()
        ->first();

        $antrian_sekarang = Antrian::where('id_instansi',$user->id_instansi)
        ->where('id_loket',$user->id_loket)
        ->where('status','1')
        ->whereDate('created_at',Carbon::today())
        ->get()
        ->first();

        $antrian_dilewati = Antrian::where('id_instansi',$user->id_instansi)
        ->where('id_loket',$user->id_loket)
        ->where('status','3')
        ->whereDate('created_at',Carbon::today())
        ->get();

        $total_antrian = Antrian::where('id_instansi',$user->id_instansi)
        ->where('id_loket',$user->id_loket)
        ->whereDate('created_at',Carbon::today())
        ->get();

        return view('back.module.antrian.index',[
            'title' => 'Antrian',
            'antrian_selesai' => $antrian_selesai,
            'antrian_menunggu' => $antrian_menunggu,
            'antrian_selanjutnya' => $antrian_selanjutnya,
            'antrian_sekarang' => $antrian_sekarang,
            'antrian_dilewati' => $antrian_dilewati,
            'total_antrian' => $total_antrian,
        ]);
    }

    public function panggil_next(){
        $modul = Antrian::find(request('id'));
        $modul->status = '1';

        if ($modul->update()) {
            return Redirect::to('antrian')->with([
                'alert' => 1,
                'message' => 'Berhasil Memanggil Antrian Selanjutnya'
            ]);
        }else{
            return Redirect::to('antrian')->with([
                'alert' => 0,
                'message' => 'Gagal Memanggil Antrian Selanjutnya'
            ]);
        }
    }

    public function panggil_selesai(){
        $modul = Antrian::find(request('id'));
        $modul->status = '2';

        $akhir = date('Y-m-d H:i:s');

        $start = new Carbon($modul->updated_at);
        $end = new Carbon($akhir);
        $time = $start->diff($end)->format('%H:%I:%S');

        $modul->lama_proses = $time;

        if ($modul->update()) {
            return Redirect::to('antrian')->with([
                'alert' => 1,
                'message' => 'Berhasil Memanggil Antrian Selanjutnya'
            ]);
        }else{
            return Redirect::to('antrian')->with([
                'alert' => 0,
                'message' => 'Gagal Memanggil Antrian Selanjutnya'
            ]);
        }
    }

    public function panggil_lewati(){
        $modul = Antrian::find(request('id'));
        $modul->status = '3';

        if ($modul->update()) {
            return Redirect::to('antrian')->with([
                'alert' => 1,
                'message' => 'Berhasil Lewati Antrian'
            ]);
        }else{
            return Redirect::to('antrian')->with([
                'alert' => 0,
                'message' => 'Gagal Lewati Antrian'
            ]);
        }
    }
}
