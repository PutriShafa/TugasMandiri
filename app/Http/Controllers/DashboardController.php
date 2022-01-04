<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $idProfile = Auth::user()->id_profile;
        if ($idProfile == '4') {
            return redirect()->intended('pemilihan_instansi');
        }
        return view('back.index', [
            'title' => 'Dashboard',
        ]);
    }
}
