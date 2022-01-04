<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Loket;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user->id_profile != '1' && $user->id_profile != '2'){
            return view('errors/404');
        }
        $modul = User::where('id','!=',$user->id)
        ->where(function($x) use($user){
            if ($user->id_profile == '2') {
                $x->where('id_instansi',$user->id_instansi);
            }
        })
        ->get();
        return view('back.module.user.index',[
            'title' => 'User',
            'modul' => $modul
        ]);
    }

    public function tambah_user(){
        $user = Auth::user();
        if($user->id_profile != '1' && $user->id_profile != '2'){
            return view('errors/404');
        }

        $instansi = Instansi::get();
        $loket = Loket::get();
        return view('back.module.user.tambah',[
            'title' => 'User',
            'instansi' => $instansi,
            'loket' => $loket,
        ]);
    }

    public function tambah(Request $request){
        $user = Auth::user();
        if($user->id_profile != '1' && $user->id_profile != '2'){
            return view('errors/404');
        }

        $cek_email = User::where('email',request('email'))->get();
        if (count($cek_email) > 0) {
            return Redirect::back()->with([
                'alert' => 0,
                'message' => 'Email Sudah Pernah Digunakan'
            ]);
        }

        $this->validate($request, [
            'password' => 'required',
            'repassword' => 'required|same:password'
        ]);

        $modul = new User;
        if ($user->id_profile == '1') {
            $modul->id_profile = request('id_profile');
            $modul->id_instansi = request('id_instansi');
        } else {
            $modul->id_profile = '3';
            $modul->id_instansi = $user->id_instansi;
        }

        if ($modul->id_profile == '3') {
            $modul->id_loket = request('id_loket');
        } else {
            $modul->id_loket = null;
        }

        $modul->name = request('name');
        $modul->email = request('email');
        $modul->password = bcrypt(request('password'));

        if ($modul->save()) {
            return Redirect::to('user')->with([
                'alert' => 1,
                'message' => 'Berhasil Menambah user'
            ]);
        }else{
            return Redirect::to('user')->with([
                'alert' => 0,
                'message' => 'Gagal Menambah user'
            ]);
        }
    }

    public function edit_user(){
        $user = Auth::user();
        if($user->id_profile != '1' && $user->id_profile != '2'){
            return view('errors/404');
        }

        $instansi = Instansi::get();
        $loket = Loket::get();
        $modul = User::find(request('id'));
        return view('back.module.user.edit',[
            'title' => 'User',
            'instansi' => $instansi,
            'loket' => $loket,
            'modul' => $modul,
        ]);
    }

    public function edit(Request $request){
        $user = Auth::user();
        if($user->id_profile != '1' && $user->id_profile != '2'){
            return view('errors/404');
        }

        $modul = User::find(request('id'));

        if ($modul->email != request('email')) {
            $cek_email = User::where('email',request('email'))->get();
            if (count($cek_email) > 0) {
                return Redirect::to('user')->with([
                    'alert' => 0,
                    'message' => 'Email Sudah Pernah Digunakan'
                ]);
            }
        }

        if ($user->id_profile == '1') {
            if (request('id_instansi') != "" && request('id_instansi') != null) {
                $modul->id_instansi = request('id_instansi');
            } else {
                $modul->id_instansi = null;
            }
            $modul->id_profile = request('id_profile');
        } else {
            $modul->id_instansi = $user->id_instansi;
            $modul->id_profile = '3';
        }

        if ($modul->id_profile == '3') {
            $modul->id_loket = request('id_loket');
        } else {
            $modul->id_loket = null;
        }

        $modul->name = request('name');
        $modul->email = request('email');
        
        if (request('password') != "" && request('password') != null) {
            $this->validate($request, [
                'password' => 'required',
                'repassword' => 'required|same:password'
            ]);
            $modul->password = bcrypt(request('password'));
        }

        if ($modul->update()) {
            return Redirect::to('user')->with([
                'alert' => 1,
                'message' => 'Berhasil Mengubah user'
            ]);
        }else{
            return Redirect::to('user')->with([
                'alert' => 0,
                'message' => 'Gagal Mengubah user'
            ]);
        }
    }

    public function hapus(Request $request){
        $user = Auth::user();
        if($user->id_profile != '1' && $user->id_profile != '2'){
            return view('errors/404');
        }
        
        $modul = User::find(request('id'));

        if ($modul->delete()) {
            return Redirect::to('user')->with([
                'alert' => 1,
                'message' => 'Berhasil Menghapus user'
            ]);
        }else{
            return Redirect::to('user')->with([
                'alert' => 0,
                'message' => 'Gagal Menghapus user'
            ]);
        }
    }
}
