<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;

class PotensiController extends Controller
{
    public function index()
    {
        $potensi = $this->getTablebyUser('potensis');
        return view('potensi.index', compact('potensi'));
    }
    public function create()
    {
        return view('potensi.create');
    }
    public function edit($potensi)
    {
        $potensi = $this->firstTablebyId('potensis',$potensi);
        return view('potensi.edit', compact('potensi'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'nama' => 'required|string|max:100',
            'konten' => 'nullable',
        ]);

        if ($request->gambar) {
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'potensi');
        }
       $data = $this->createRowbyUser('potensis',$data);

        return redirect()->route('potensi.index')->with('success', 'Potensi berhasil dibuat');
    }
    public function update($potensi, Request $request)
    {
        $data = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'nama' => 'required|string|max:100',
            'konten' => 'nullable',
        ]);

        $potensi = DB::table('potensis')->where('id', $potensi)->first();

        if ($request->gambar) {
            File::delete(public_path() . $potensi->gambar);
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'potensi');
        }
        $data = $this->updateRowbyUser('potensis',$potensi->id,$data);

        return redirect()->route('potensi.index')->with('success', 'Potensi berhasil diupdate');
    }
    public function destroy($potensi)
    {
        $potensi = DB::table('potensis')->where('id', $potensi)->first();
        if ($potensi->gambar) {
            File::delete(public_path() . $potensi->gambar);
        }

        DB::table('potensis')->where('id', $potensi->id)->delete();
        return back()->with('success', 'Potensi berhasil dihapus');
    }
    public function show()
    {
        $potensi = $this->getTablebyDesa('potensis');
        return view('potensi.show', compact('potensi'));
    }
    public function detail($kelurahan_slug,$potensi)
    {
        $potensi = DB::table('potensis')->where('id', $potensi)->first();
        return view('potensi.detail', compact('potensi'));
    }
}