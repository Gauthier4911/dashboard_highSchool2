<?php

namespace App\Http\Controllers;

use App\Models\Salles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeContronllers extends Controller
{
    public function home(){
    return view('app.home');
}
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
