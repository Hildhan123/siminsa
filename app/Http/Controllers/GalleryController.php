<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Gallery;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desa = Desa::where('user_id',Auth::user()->id)->first();
        $gallery = Gallery::where([
            ['slider', '=', null],
            ['organisasi', '=', null],
            ['lembaga_id', '=', null],
            ['user_id','=',Auth::user()->id]
        ])->get();
        $videos = Video::where('user_id',Auth::user()->id);
        $galleries = array();

        foreach ($gallery as $key => $value) {
            $gambar = [
                'gambar' => $value->gallery,
                'id' => $value->id,
                'caption' => $value->caption,
                'jenis' => 1,
                'created_at' => strtotime($value->created_at),
            ];
            array_push($galleries, $gambar);
        }

        foreach ($videos as $key => $value) {
            $gambar = [
                'gambar' => $value->gambar,
                'id' => $value->video_id,
                'caption' => $value->caption,
                'jenis' => 2,
                'created_at' => strtotime($value->published_at),
            ];
            array_push($galleries, $gambar);
        }

        // usort($galleries, function($a, $b) {
        //     return $a['created_at'] < $b['created_at'];
        // });

        return view('gallery.index', compact('galleries', 'desa'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {
        $desa = app('desa');
        $gallery = Gallery::where([
            ['slider', '=', null],
            ['organisasi', '=', null],
            ['lembaga_id', '=', null],
            ['user_id','=',$desa->user_id]
        ])->get();
        $videos = Video::where('user_id',$desa->user_id);
        $galleries = array();

        foreach ($gallery as $key => $value) {
            $gambar = [
                'gambar' => $value->gallery,
                'id' => $value->id,
                'caption' => $value->caption,
                'jenis' => 1,
                'created_at' => strtotime($value->created_at),
            ];
            array_push($galleries, $gambar);
        }

        foreach ($videos as $key => $value) {
            $gambar = [
                'gambar' => $value->gambar,
                'id' => $value->video_id,
                'caption' => $value->caption,
                'jenis' => 2,
                'created_at' => strtotime($value->published_at),
            ];
            array_push($galleries, $gambar);
        }

        // usort($galleries, function($a, $b) {
        //     return $a['created_at'] < $b['created_at'];
        // });

        return view('gallery.gallery', compact('galleries', 'desa'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSlider()
    {
        $gallery = Gallery::where([
            ['slider','=', 1],
            ['user_id','=',Auth::user()->id],
            ])->latest()->get();
        return view('gallery.slider', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => ['required', 'image', 'max:2048'],
            'caption' => ['nullable', 'string']
        ]);

        //check organisasi
        // if($request->organisasi) {
        //     $CheOrg = Gallery::where('organisasi', 1)->first();
        //     if ($CheOrg) {
        //         File::delete(storage_path('app/' . $CheOrg->gallery));
        //         Gallery::where('organisasi', 1)->delete();
        //     }
        // }
        $file = $request->gambar;
        $path = $this->gambarPath($file,'gallery');

        Gallery::create([
            'user_id' => Auth::user()->id,
            'gallery' => $path,
            'caption' => $request->caption,
            'slider' => $request->slider,
            'organisasi' => $request->organisasi,
            'lembaga_id' => $request->lembaga_id,
        ]);

        return redirect()->back()->with('success', 'Gambar berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        File::delete(public_path() . $gallery->gallery);
        $gallery->delete();
        return back()->with('success', 'Gambar berhasil dihapus');
    }
}