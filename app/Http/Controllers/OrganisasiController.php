<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Gallery;
use File;
use Auth;

class OrganisasiController extends Controller
{
    public function index()
    {
        $organisasi = DB::table('organisasis')
            ->join('pegawais', 'pegawais.id', '=', 'organisasis.pegawai_id')
            ->where('organisasis.user_id', Auth::user()->id)
            ->orderBy('order', 'asc')
            ->select('*', 'organisasis.id as id', 'organisasis.deskripsi as deskripsi')
            ->get();
        //$gallery = DB::table('galleries')->where('organisasi', 1)->latest()->get();
        $gallery = Gallery::where([
            ['organisasi', '=', 1],
            ['user_id', '=', Auth::user()->id]
        ])->latest()->get();
        return view('organisasi.index', compact('organisasi', 'gallery'));
    }
    public function create()
    {
        $pegawai = $this->getTablebyUser('pegawais');
        return view('organisasi.create', compact('pegawai'));
    }
    public function edit($organisasi)
    {
        $pegawai = $this->getTablebyUser('pegawais');
        $organisasi = $this->firstTablebyId('organisasis', $organisasi);
        return view('organisasi.edit', compact('pegawai', 'organisasi'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'deskripsi' => 'nullable',
            'pegawai_id' => 'required',
            'order' => 'numeric|required|',
        ]);
        $this->createRowbyUser('organisasis', $data);
        DB::table('pegawais')->where('id', $data['pegawai_id'])->update([
            'jabatan' => $data['title'],
        ]);

        return redirect()->route('organisasi.index')->with('success', 'Struktur organisasi berhasil ditambahkan');
    }
    public function update(Request $request, $organisasi)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'deskripsi' => 'nullable',
            'pegawai_id' => 'required',
            'order' => 'numeric|required|',
        ]);

        $this->updateRowbyUser('organisasis', $organisasi);
        DB::table('pegawais')->where('id', $data['pegawai_id'])->update([
            'jabatan' => $data['title'],
        ]);
        return redirect()->route('organisasi.index')->with('success', 'Struktur organisasi berhasil diupdate');
    }
    public function destroy($organisasi)
    {
        DB::table('organisasis')->where('id', $organisasi)->delete();
        return back()->with('success', 'Organisasi berhasil dihapus');
    }
    public function show()
    {
        $desa = app('desa');
        $organisasi = DB::table('organisasis')
            ->join('pegawais', 'pegawais.id', '=', 'organisasis.pegawai_id')
            ->where('organisasis.user_id', $desa->user_id)
            ->orderBy('order', 'asc')
            ->select('*', 'organisasis.id as id')
            ->get();
        $gallery = Gallery::where([
            ['organisasi', '=', 1],
            ['user_id', '=', $desa->user_id]
        ])->latest()->get();
        return view('organisasi.show', compact('organisasi', 'gallery'));
    }
    public function detail($kelurahan_slug, $organisai)
    {
        $desa = app('desa');
        $organisasi = DB::table('organisasis')
            ->join('pegawais', 'pegawais.id', '=', 'organisasis.pegawai_id')
            ->where('organisasis.user_id', $desa->user_id)
            ->orderBy('order', 'asc')
            ->select('*', 'organisasis.id as id')
            ->get();
        $detail = DB::table('organisasis')
            ->join('pegawais', 'pegawais.id', '=', 'organisasis.pegawai_id')
            ->where('organisasis.id', $organisai)
            ->select('*', 'organisasis.deskripsi as deskripsi')
            ->first();
        return view('organisasi.detail', compact('organisasi', 'detail'));
    }
}