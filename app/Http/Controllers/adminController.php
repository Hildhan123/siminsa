<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class adminController extends Controller
{
    public function login()
    {
        if (session()->has('hakAkses')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }
    public function loginProses(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = $request->name;
        $pass = $request->password;

        $adm = DB::table('admins')->where([
            ['name', '=', $user],
        ])->first();
        if ($adm == null) {
            return redirect()->route('admin.login')->with('error', 'Username atau password salah');
        }

        $check = Hash::check($pass, $adm->password);

        if ($check == true) {
            //save to log_activity
            DB::table('log_activity')->insert([
                'user_id'            => null,
                'nama'               => $user,
                'action'             => 'login',
                'ip'                 => $request->ip(),
                'browser_user_agent' => $request->userAgent(),
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]);

            session(['hakAkses' => $user, 'id' => $adm->id]);
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->with('error', 'Username atau password salah');
    }
    public function dashboard()
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id', $id)->first();
        $users = count(DB::table('users')->get());
        $kelurahan = count(DB::table('kelurahan')->get());
        $log = DB::table('log_activity')->whereNull('user_id')->latest()->get();
        return view('admin.dashboard', compact('admin','users','kelurahan','log'));
    }
    public function users()
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id', $id)->first();
        $users = DB::table('users')->get();
        return view('admin.users', compact('admin', 'users'));
    }
    public function user($user)
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $user)->first();
        return view('admin.user', compact('admin', 'user'));
    }
    public function userUpdate($user, Request $request)
    {
        //$user = DB::table('users')->where('id', $user)->first();
        $data = $request->validate([
            'nama' => 'required|string|max:64',
            'email' => ['required','email',Rule::unique('users','email')->ignore($user)],
            'password' => 'nullable|min:8|string|confirmed',
        ]);

        $data['updated_at'] = date('Y-m-d H:i:s');

        if($data['password'])
        {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        DB::table('users')->where('id',$user)->update($data);
        return redirect()->route('admin.users')->with('success','User berhasil diupdate');
    }
    public function userDelete($user)
    {
        DB::table('users')->where('id',$user)->delete();
        return redirect()->route('admin.users')->with('success','User berhasil dihapus');
    }
    public function kelurahan()
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id', $id)->first();
        $kelurahan = DB::table('kelurahan')->
            join('users', 'users.id', '=', 'kelurahan.id')->
            get();
        return view('admin.kelurahan', compact('admin', 'kelurahan'));
    }
    public function dataCreate()
    {
        $kelurahan = DB::table('kelurahan')->count();
        if ($kelurahan > 0) {
            return back()->with('error','Data kelurahan sudah ada');
        }
        $id = session('id');
        $admin = DB::table('admins')->where('id', $id)->first();
        return view('admin.tambah-data', compact('admin'));
    }
    public function dataStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required|max:64',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:8|string|confirmed',
            'nama_kelurahan' => 'required|string|max:20',
            'kodepos' => 'numeric|required|digits_between:5,10',
        ]);

        $data['slug'] = Str::slug($data['nama_kelurahan']);
        if (DB::table('kelurahan')->where('slug', $data['slug'])->exists()) {
            return back()->withErrors(['nama_kelurahan' => 'Nama kelurahan sudah ada di database'])->withInput();
        }

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
            'alamat' => $data['nama_kelurahan'],
            'kodepos' => $data['kodepos'],
            'kontak' => '08123456789',
            'logo' => 'logo.png',
            'created_at' => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        $template = DB::table('template')->insert([
            'user_id'   => $user->id,
            'key'       => 'selayang',
            'title'     => 'Selayang Pandang',
            'konten'    => '<p style="margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat nam at lectus urna. Imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor. Nisl pretium fusce id velit ut tortor pretium viverra suspendisse. Nunc id cursus metus aliquam eleifend mi. Sit amet risus nullam eget felis. Consequat nisl vel pretium lectus quam id leo. Sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. A pellentesque sit amet porttitor eget dolor morbi. Odio tempor orci dapibus ultrices in iaculis nunc sed augue. </p><p style="margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;"><span style="font-size: 1rem;">Amet purus gravida quis blandit turpis. Sed faucibus turpis in eu mi bibendum neque egestas. Posuere urna nec tincidunt praesent semper feugiat nibh. Quisque sagittis purus sit amet volutpat consequat mauris. Non sodales neque sodales ut etiam. Rhoncus mattis rhoncus urna neque viverra justo nec ultrices dui. Sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis. Semper feugiat nibh sed pulvinar.</span><br></p>',
            'active'    => 1,
            'created_at' => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        DB::table('template')->insert([
            'user_id'   => $user->id,
            'key'       => 'sambutan',
            'title'     => 'Sambutan Kepala Kelurahan',
            'konten'    => '<div style="text-align: left;"><p style="margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; font-size: 16px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat nam at lectus urna. Imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor. Nisl pretium fusce id velit ut tortor pretium viverra suspendisse. Nunc id cursus metus aliquam eleifend mi. Sit amet risus nullam eget felis. Consequat nisl vel pretium lectus quam id leo. Sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. A pellentesque sit amet porttitor eget dolor morbi. Odio tempor orci dapibus ultrices in iaculis nunc sed augue.</p><p style="margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; font-size: 16px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;"><span style="font-size: 1rem;">Amet purus gravida quis blandit turpis. Sed faucibus turpis in eu mi bibendum neque egestas. Posuere urna nec tincidunt praesent semper feugiat nibh. Quisque sagittis purus sit amet volutpat consequat mauris. Non sodales neque sodales ut etiam. Rhoncus mattis rhoncus urna neque viverra justo nec ultrices dui. Sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis. Semper feugiat nibh sed pulvinar.</span></p></div>',
            'active'    => 1,
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
    public function dump()
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id', $id)->first();
        $users = DB::table('kelurahan')->
        join('users', 'users.id', '=', 'kelurahan.id')->
        select('*','users.id as id')->
        get();
        return view('admin.dump', compact('admin','users'));
    }

    public function makeDump(Request $request)
    {
        $request->validate([
            'id' => 'numeric|required'
        ]);

        $user_id = $request->id;

        //buat berita
        DB::table('berita')->insertGetId([
            'user_id' => $user_id,
            'judul' => 'Hello World',
            'konten' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //buat page
        $page = [
            [
                'user_id' => $user_id,
                'judul' => 'Visi Misi',
                'konten' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'judul' => 'Tentang Kami',
                'konten' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];
        $pageIds = [];
        foreach ($page as $item) {
            $pageId = DB::table('pages')->insertGetId($item);
            $pageIds[] = $pageId;
        }

        //buat parent navbar
        $parent = [
            [
                'user_id' => $user_id,
                'order' => 1,
                'parent' => null,
                'title' => 'Profil Kelurahan',
                'type' => 2,
                'url' => '#',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 2,
                'parent' => null,
                'title' => 'Pemerintahan Kelurahan',
                'type' => 2,
                'url' => '#',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 3,
                'parent' => null,
                'title' => 'Layanan',
                'type' => 4,
                'url' => '/layanan-kelurahan',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 4,
                'parent' => null,
                'title' => 'Informasi',
                'type' => 2,
                'url' => '#',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 5,
                'parent' => null,
                'title' => 'Produk',
                'type' => 4,
                'url' => '/produk-kelurahan',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 6,
                'parent' => null,
                'title' => 'Potensi',
                'type' => 4,
                'url' => '/potensi-kelurahan',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];
        $parentIds = [];
        foreach ($parent as $item) {
            $parentId = DB::table('navbars')->insertGetId($item);
            $parentIds[] = $parentId;
        }
        //buat child navbar
        DB::table('navbars')->insert([
            [
                'user_id' => $user_id,
                'order' => 1,
                'parent' => $parentIds[0],
                'title' => 'Visi Misi',
                'type' => 3,
                'url' => '/p/'.$pageIds[0].'/visi-misi',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 2,
                'parent' => $parentIds[0],
                'title' => 'Tentang Kami',
                'type' => 3,
                'url' => '/p/'.$pageIds[1].'/tentang-kami',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 1,
                'parent' => $parentIds[1],
                'title' => 'Struktur Organisasi',
                'type' => 4,
                'url' => '/organisasi',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 2,
                'parent' => $parentIds[1],
                'title' => 'Perangkat Kelurahan',
                'type' => 4,
                'url' => '/perangkat-kelurahan',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 3,
                'parent' => $parentIds[1],
                'title' => 'Lembaga Kelurahan',
                'type' => 4,
                'url' => '/lembaga-kelurahan',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 1,
                'parent' => $parentIds[3],
                'title' => 'Berita',
                'type' => 4,
                'url' => '/berita',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 2,
                'parent' => $parentIds[3],
                'title' => 'Pengumuman',
                'type' => 4,
                'url' => '/pengumuman-kelurahan',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 3,
                'parent' => $parentIds[3],
                'title' => 'Agenda',
                'type' => 4,
                'url' => '/agenda-kelurahan',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 4,
                'parent' => $parentIds[3],
                'title' => 'Galeri',
                'type' => 4,
                'url' => '/gallery',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $user_id,
                'order' => 5,
                'parent' => $parentIds[3],
                'title' => 'Download',
                'type' => 4,
                'url' => '/download-kelurahan',
                'target' => null,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);

        return redirect()->route('admin.dump')->with('success','Dump berhasil ditambahkan');
    }
    public function profil()
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id', $id)->first();
        return view('admin.profil',compact('admin'));
    }
    public function profilStore(Request $request)
    {
        $id = session('id');
        $admin = DB::table('admins')->where('id', $id)->first();
        $data = $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|min:8|string|confirmed',       
        ]);
        //dump($admin->password, $request->old_password);
        if (Hash::check($data['old_password'],$admin->password, ) == false) {
            return redirect()->route('admin.profil')->with('error','Password lama salah');
        }
        DB::table('admins')->where('id',$id)->update([
            'password' => Hash::make($data['password']),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.profil')->with('success','Profil berhasil diperbarui');
    }
}