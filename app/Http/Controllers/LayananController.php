<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use File;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = $this->getTablebyUser('layanans');
        return view('layanan.index',compact('layanan'));
    }
    public function create()
    {
        return view('layanan.create');
    }
    public function edit($layanan)
    {
        $layanan = $this->firstTablebyId('layanans',$layanan);
        return view('layanan.edit',compact('layanan'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'gambar'            => 'nullable|image|max:2048',
            'nama'              => 'required|string|max:100',
            'judul'             => 'required|string|max:200',
            'konten'            => 'nullable',
        ]);

        if ($request->gambar) {
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'layanan');
        }
        $data = $this->createRowbyUser('layanans',$data);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dibuat');
    }
    public function update($layanan, Request $request)
    {
        $data = $request->validate([
            'gambar'            => 'nullable|image|max:2048',
            'nama'              => 'required|string|max:100',
            'judul'             => 'required|string|max:200',
            'konten'            => 'nullable',
        ]);

        $layanan = DB::table('layanans')->where('id',$layanan)->first();

        if ($request->gambar) {
            File::delete(public_path() . $layanan->gambar);
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'layanan');
        }
         $data = $this->updateRowbyUser('layanans',$layanan->id,$data);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diupdate');
    }
    public function destroy($layanan)
    {  
        $layanan = DB::table('layanans')->where('id',$layanan)->first();
        if($layanan->gambar) {
            File::delete(public_path() . $layanan->gambar);
        }
        DB::table('layanans')->where('id',$layanan->id)->delete();
        return back()->with('success','Layanan berhasil dihapus'); 
    }
    public function show()
    {
        $layanan = $this->getTablebyDesa('layanans');
        return view('layanan.show',compact('layanan'));
    }
    public function detail($layanan)
    {
        $layanan = $this->firstTablebyId('layanans',$layanan);
        return view('layanan.detail',compact('layanan'));
    }
}
