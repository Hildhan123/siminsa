<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\User;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function login()
    {
        if(session()->has('hakAkses'))
        {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }
    public function loginProses(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'password' => 'required|string'
        ]);

        $user = $request->name;
        $pass = $request->password;

        $adm = DB::table('admins')->where([
            ['name','=', $user],
        ])->first();
        if($adm == null){return redirect()->route('admin.login')->with('error','Username atau password salah');}

        $check = Hash::check($pass, $adm->password);
        
        if($check == true)
        {
            session(['hakAkses' => $user,'id' => $adm->id]);
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->with('error','Username atau password salah');
    }
    public function dashboard()
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id',$id)->first();
        return view('admin.dashboard', compact('admin'));
    }
    public function users()
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id',$id)->first();
        $users = DB::table('users')->get();
        return view('admin.users',compact('admin','users'));
    }
    public function user($user)
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id',$id)->first();
        $user = DB::table('users')->where('id',$user)->first();
        return view('admin.user',compact('admin','user'));
    }
    public function kelurahan()
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id',$id)->first();
        $kelurahan = DB::table('kelurahan')->
        join('users','users.id','=','kelurahan.id')->
        get();
        return view('admin.kelurahan',compact('admin','kelurahan'));
    }
    public function dataCreate()
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id',$id)->first();
        return view('admin.tambah-data',compact('admin'));
    }
    public function dataStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required|max:255',
            'email' => 'email|required',
            'password' => 'required|min:8|string|confirmed',
            'nama_kelurahan' => 'required|string|max:20',
            'kodepos' => 'numeric|required|digits_between:5,10',
        ]);

        $user = User::create([
            'nama' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'foto_profil' => 'noavatar.png',
            'created_at' => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        $kelurahan = DB::table('kelurahan')->insert([
            'user_id' => $user->id,
            'slug' => Str::slug($data['nama_kelurahan']),
            'nama_kelurahan' => $data['nama_kelurahan'],
            'nama_kecamatan' => 'Demak',
            'nama_kabupaten' => 'Demak',
            'alamat' => $data['nama_kelurahan'],
            'kodepos' => $data['kodepos'],
            'logo' => 'logo.png',
            'created_at' => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.users')->with('success', 'Data berhasil ditambahkan');
    }
    
    public function logout()
    {
        session()->forget('hakAkses');
        session()->forget('id');
        return redirect()->route('admin.login');
    }
}
