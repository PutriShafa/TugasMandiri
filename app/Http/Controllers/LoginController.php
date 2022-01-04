<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class LoginController extends Controller
{
    public function index()
    {
        return view('back.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $idProfile = Auth::user()->id_profile;
            if ($idProfile == '4') {
                return redirect()->intended('pemilihan_instansi');
            }
            return redirect()->intended('home');
        }

        return Redirect::to('/')->with([
            'alert' => 0,
            'message' => 'Email Atau Password Salah'
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'id_profile' => '4',
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt('123456dummy')
                ]);
                Auth::login($newUser);
            }

            $idProfile = Auth::user()->id_profile;
            if ($idProfile == '4') {
                return redirect()->intended('pemilihan_instansi');
            }
            return redirect()->intended('home');
        } catch (Exception $e) {
            return Redirect::to('/')->with([
                'alert' => 0,
                'message' => 'Email Already Used'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
