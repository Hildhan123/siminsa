<?php

namespace App\Http\Controllers;

use App\Desa;
use App\PemerintahanDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Auth;

class PemerintahanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pemerintahan_desa = $this->getTablebyUser('pages');
        // $pemerintahan_desa = PemerintahanDesa::orderBy('id','desc')->paginate(12);

        // if ($request->cari) {
        //     $pemerintahan_desa = PemerintahanDesa::where('judul','like',"%{$request->cari}%")
        //     ->orWhere('konten','like',"%{$request->cari}%")
        //     ->orderBy('id','desc')->paginate(15);
        // }

        // $pemerintahan_desa->appends($request->only('cari'));
        return view('pages.index', compact('pemerintahan_desa'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pemerintahan_desa(Request $request)
    {
        $pemerintahan_desa = $this->getTablebyDesa('pages');
        $desa = app('desa');
        // $pemerintahan_desa = PemerintahanDesa::orderBy('id','desc')->paginate(12);
        // $desa = Desa::find(1);

        // if ($request->cari) {
        //     $pemerintahan_desa = PemerintahanDesa::where('judul','like',"%{$request->cari}%")
        //     ->orWhere('konten','like',"%{$request->cari}%")
        //     ->orderBy('id','desc')->paginate(12);
        // }

        // $pemerintahan_desa->appends($request->only('cari'));
        return view('pages.pemerintah-desa', compact('pemerintahan_desa','desa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => ['required','string','max:191'],
            'konten'    => ['required'],
            'gambar'    => ['nullable','image','max:2048'],
        ]);

        if ($request->gambar) {
            $file = $request->gambar;
            $data['gambar'] = $this->gambarPath($file,'pages');
        }
        $data['user_id'] = Auth::user()->id;

        PemerintahanDesa::create($data);

        return redirect()->route('pages.index')->with('success','Page berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PemerintahanDesa  $pemerintahan_desa
     * @return \Illuminate\Http\Response
     */
    // public function show(PemerintahanDesa $pemerintahan_desa, $slug, $kelurahan_slug)
    // {
    //     //$desa = app('desa');
    //     // $pemerintahan_desas = PemerintahanDesa::where('id','!=', $pemerintahan_desa->id)->inRandomOrder()->limit(3)->get();
    //     if ($slug != Str::slug($pemerintahan_desa->judul)) {
    //         return abort(404);
    //     }
    //     $pemerintahan_desa->update(['dilihat' => $pemerintahan_desa->dilihat + 1]);
    //     return view('pages.show', compact('pemerintahan_desa'));
    // }

    public function show($pemerintahan_desa, $slug)
    {
        $pemerintahan_desa = PemerintahanDesa::where('id',$pemerintahan_desa)->first();
        if ($slug != Str::slug($pemerintahan_desa->judul)) {
            return abort(404);
        }
        $pemerintahan_desa->update(['dilihat' => $pemerintahan_desa->dilihat + 1]);
        return view('pages.show', compact('pemerintahan_desa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PemerintahanDesa  $pemerintahan_desa
     * @return \Illuminate\Http\Response
     */
    public function edit(PemerintahanDesa $page)
    {
        $pemerintahan_desa = $page;
        return view('pages.edit', compact('pemerintahan_desa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PemerintahanDesa  $pemerintahan_desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemerintahanDesa $page)
    {
        $data = $request->validate([
            'judul'     => ['required','string','max:191'],
            'konten'    => ['required'],
            'gambar'    => ['nullable','image','max:2048'],
        ]);

        if ($request->gambar) {
            if ($page->gambar) {
                File::delete(public_path() . $page->gambar);
            }
            $file = $request->gambar;
            $data['gambar'] = $this->gambarPath($file,'pages');
        }
        $data['user_id'] = Auth::user()->id;

        $page->update($data);

        return back()->with('success','Page berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PemerintahanDesa  $pemerintahan_desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemerintahanDesa $page)
    {
        if ($page->gambar) {
            File::delete(public_path() . $page->gambar);
        }
        $page->delete();
        return back()->with('success','Page berhasil dihapus');
    }
}
