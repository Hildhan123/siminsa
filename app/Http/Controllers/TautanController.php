<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;

class TautanController extends Controller
{
    public function index()
    {
        $tautan = $this->getTablebyUser('tautans');
        return view('tautan.index',compact('tautan'));
    }
    public function create()
    {
        return view('tautan.create');
    }
    public function edit($tautan)
    {
        $tautan = $this->firstTablebyId('tautans',$tautan);
        return view('tautan.edit',compact('tautan'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'gambar'    => 'nullable|image|max:2048',
            'title'     => 'required|string|max:100',
            'url'       => 'required|url|max:200',
            'target'    => 'nullable|string|max:20',
            'deskripsi' => 'nullable',
        ]);

        if ($request->gambar) {
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'tautan');
        }
        $data = $this->createRowbyUser('tautans',$data);

        return redirect()->route('tautan.index')->with('success', 'Tautan berhasil dibuat');
    }
    public function update($tautan, Request $request)
    {
        $data = $request->validate([
            'gambar'    => 'nullable|image|max:2048',
            'title'     => 'required|string|max:100',
            'url'       => 'required|url|max:200',
            'target'    => 'nullable|string|max:20',
            'deskripsi' => 'nullable',
        ]);
        $tautan = DB::table('tautans')->where('id',$tautan)->first();

        if ($request->gambar) {
            File::delete(public_path() . $tautan->gambar);
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'tautan');
        }

        $data = $this->updateRowbyUser('tautans',$tautan->id,$data);

        return redirect()->route('tautan.index')->with('success', 'Tautan berhasil diupdate');
    }
    public function destroy($tautan)
    {
        $tautan = DB::table('tautans')->where('id',$tautan)->first();
        if ($tautan->gambar){
            File::delete(public_path() . $tautan->gambar);
        }
        DB::table('tautans')->where('id',$tautan->id)->delete();

        return back()->with('success','Tautan berhasil dihapus');
    }
    public function show()
    {
        $tautan = $this->getTablebyDesa('tautans');
        return view('tautan.show');
    }
    public function detail($kelurahan_slug,$tautan)
    {
        $tautan = $this->firstTablebyId('tautans',$tautan);
        return view('tautan.detail');
    }
}
