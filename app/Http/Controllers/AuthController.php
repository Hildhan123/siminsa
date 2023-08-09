<?php

namespace App\Http\Controllers;

use App\Rules\LoginRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

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
        
        if (Auth::check()) {
            // Simpan log aktivitas pengguna
            DB::table('log_activity')->insert([
                'user_id'            => Auth::id(),
                'nama'               => Auth::user()->nama,
                'action'             => 'login',
                'ip'         => $request->ip(),
                'browser_user_agent' => $request->userAgent(),
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->route('dashboard');
    }

    // public function register()
    // {
    //     return view('auth.register');
    // }
    // public function daftar(Request $request)
    // {
        
    // }

    public function keluar()
    {
        Auth::logout();
        return redirect()->route('masuk');
    }
}
