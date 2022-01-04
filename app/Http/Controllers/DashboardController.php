<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        return view('back.index',[
            'title' => 'Dashboard',
        ]);
    }
}
