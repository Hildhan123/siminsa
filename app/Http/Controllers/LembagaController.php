<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;

class LembagaController extends Controller
{
    public function index()
    {
        $lembaga = $this->getTablebyUser('lembagas');
        return view('lembaga.index',compact('lembaga'));
    }
    public function create()
    {
        return view('lembaga.create');
    }
    public function edit($lembaga)
    {
        $lembaga = $this->firstTablebyId('lembagas',$lembaga);
        return view('lembaga.edit', compact('lembaga'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'logo' => ['nullable', 'image', 'max:1024'],
            'nama' => ['required', 'string', 'max:200'],
            'singkatan' => ['nullable', 'string', 'max:50'],
            'dasar_hukum' => ['nullable', 'string', 'max:100'],
            'alamat' => ['nullable', 'string', 'max:100'],
            'profil' => ['nullable'],
            'visi_misi' => ['nullable'],
            'tugas_dan_fungsi' => ['nullable'],
            'kepengurusan' => ['nullable'],
        ]);

        if ($request->logo) {
            $file = $request->logo;

            $data['logo'] = $this->gambarPath($file,'lembaga');
        }
        $data = $this->createRowbyUser('lembagas',$data);

        return redirect()->route('lembaga.index')->with('success', 'Lembaga berhasil ditambahkan');
    }
    public function update($lembaga, Request $request)
    {
        $data = $request->validate([
            'logo' => ['nullable', 'image', 'max:1024'],
            'nama' => ['required', 'string', 'max:200'],
            'singkatan' => ['nullable', 'string', 'max:50'],
            'dasar_hukum' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string', 'max:100'],
            'profil' => ['nullable'],
            'visi_misi' => ['nullable'],
            'tugas_dan_fungsi' => ['nullable'],
            'kepengurusan' => ['nullable'],
        ]);

        $lembaga = DB::table('lembagas')->where('id',$lembaga)->first();

        if ($request->logo) {
            File::delete(public_path() . $lembaga->logo);
            $file = $request->logo;

            $data['logo'] = $this->gambarPath($file,'lembaga');
        }
        $data = $this->updateRowbyUser('lembagas',$lembaga->id,$data);

        return redirect()->route('lembaga.index')->with('success', 'Lembaga berhasil diupdate');
    }
    public function destroy($lembaga)
    {
        $lembaga = DB::table('lembagas')->where('id',$lembaga)->first();
        if($lembaga->logo) {
            File::delete(public_path() . $lembaga->logo);
        }

        DB::table('lembagas')->where('id',$lembaga->id)->delete();
        return back()->with('success', 'Lembaga berhasil dihapus');
    }
    public function show()
    {
        $lembaga = $this->getTablebyDesa('lembagas');
        return view('lembaga.show',compact('lembaga'));
    }
    public function detail($kelurahan_slug,$lembaga)
    {
        $lembaga = $this->firstTablebyId('lembagas',$lembaga);
        return view('lembaga.detail',compact('lembaga'));
    }
}
