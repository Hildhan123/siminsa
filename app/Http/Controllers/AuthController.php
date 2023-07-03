<?php

namespace App\Http\Controllers;

use App\Rules\LoginRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Desa;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.masuk');
    }

    public function masuk(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'max:64', 'required_with:password', new LoginRule($request->password)],
            'password'  => ['required']
        ]);
        
        return redirect()->route('dashboard');
    }

    public function register()
    {
        return view('auth.register');
    }
    public function daftar(Request $request)
    {
        
    }

    public function keluar()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
