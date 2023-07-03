<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = $this->getTablebyUser('pengumumans');
        return view('pengumuman.index',compact('pengumuman'));
    }
    public function create()
    {
        return view('pengumuman.create');
    }
    public function edit($pengumuman)
    {
        $pengumuman = $this->firstTablebyId('pengumumans',$pengumuman);
        return view('pengumuman.edit', compact('pengumuman'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'judul' => 'required|string|max:100',
            'konten' => 'nullable',
        ]);

        if ($request->gambar) {
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'pengumuman');
        }
        $data = $this->createRowbyUser('pengumumans',$data);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dibuat');
    }
    public function update($pengumuman, Request $request)
    {
        $data = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'judul' => 'required|string|max:100',
            'konten' => 'nullable',
        ]);

        $pengumuman = DB::table('pengumumans')->where('id',$pengumuman)->first();

        if ($request->gambar) {
            File::delete(public_path() . $pengumuman->gambar);
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'pengumuman');
        }
        $data = $this->updateRowbyUser('pengumumans',$pengumuman->id,$data);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diupdate');
    }
    public function destroy($pengumuman)
    {
        $pengumuman = DB::table('pengumumans')->where('id',$pengumuman)->first();
        if($pengumuman->gambar) {
            File::delete(public_path() . $pengumuman->gambar);
        }

        DB::table('pengumumans')->where('id',$pengumuman->id)->delete();
        return back()->with('success','Pengumuman berhasil dihapus');
    }
    public function show()
    {
        $pengumuman = $this->getTablebyDesa('pengumumans');
        return view('pengumuman.show',compact('pengumuman'));
    }
    public function detail($kelurahan_slug,$pengumuman)
    {
        $pengumuman = DB::table('pengumumans')->where('id',$pengumuman)->first();
        return view('pengumuman.detail',compact('pengumuman'));
    }
}
