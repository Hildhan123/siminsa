<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = $this->getTablebyUser('produks');
        return view('produk.index',compact('produk'));
    }
    public function create()
    {
        return view('produk.create');
    }
    public function edit($produk)
    {
        $produk = $this->firstTablebyId('produks',$produk);
        return view('produk.edit',compact('produk'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'keterangan' => ['string', 'nullable','max:200'],
            'tipe' => ['required','string'],
            'file1' => ['nullable'],
            'file2' => ['nullable'],
        ]);

        if($data['tipe'] == 'internal') {
            $request->validate(['file1' => 'required|mimes:doc,docx,pdf|max:20000']);
            $file = $request->file1;

            $data['file'] = $this->gambarPath($file,'produk');
        } else {
            $request->validate(['file2' => 'required|url']);
            $data['file'] = $data['file2'];
        }
        unset($data['file1']);
        unset($data['file2']);

        $data = $this->createRowbyUser('produks',$data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dibuat');
    }
    public function update($produk, Request $request)
    {
        $produk = DB::table('produks')->where('id',$produk)->first();
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'keterangan' => ['string', 'nullable','max:200'],
            'tipe' => ['required','string'],
            'file1' => ['nullable'],
            'file2' => ['nullable'],
        ]);

        if($data['tipe'] == 'internal') {
            $request->validate(['file1' => 'nullable|mimes:doc,docx,pdf|max:20000']);
            if($request->file1) {
                File::delete(public_path() . $produk->file);
                $file = $request->file1;

                $data['file'] = $this->gambarPath($file,'produk');
            }
        } else {
            $request->validate(['file2' => 'required|url']);
            $data['file'] = $data['file2'];
        }
        unset($data['file1']);
        unset($data['file2']);

        $data = $this->updateRowbyUser('produks',$produk->id,$data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
    }
    public function destroy($produk)
    {
        $produk = DB::table('produks')->where('id',$produk)->first();
        if($produk->tipe == 'internal') {
            File::delete(public_path() . $produk->file);
        }
        DB::table('produks')->where('id',$produk->id)->delete();

        return back()->with('success','Produk berhasil dihapus');
    }
    public function show()
    {
        $produk = $this->getTablebyDesa('produks');
        return view('produk.show',compact('produk'));
    }
    public function detail($produk)
    {
        $produk = $this->firstTablebyId('produks',$produk);
        return view('produk.detail',compact('produk'));
    }
}
