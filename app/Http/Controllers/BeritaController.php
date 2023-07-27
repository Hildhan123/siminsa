<?php

namespace App\Http\Controllers;

use App\Berita;
use App\Desa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Auth;
use DB;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = $this->getTablebyUser('berita');
        // $berita = Berita::orderBy('id','desc')->paginate(12);

        // if ($request->cari) {
        //     $berita = Berita::where('judul','like',"%{$request->cari}%")
        //     ->orWhere('konten','like',"%{$request->cari}%")
        //     ->orderBy('id','desc')->paginate(12);
        // }

        // $berita->appends($request->only('cari'));
        return view('berita.index', compact('berita'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function berita(Request $request)
    {
        $desa = app('desa');
        $berita = $this->getTablebyDesa('berita');
        // $berita = Berita::orderBy('id','desc')->paginate(12);
        // $desa = Desa::find(1);

        // if ($request->cari) {
        //     $berita = Berita::where('judul','like',"%{$request->cari}%")
        //     ->orWhere('konten','like',"%{$request->cari}%")
        //     ->orderBy('id','desc')->paginate(12);
        // }

        // $berita->appends($request->only('cari'));
        $archive = DB::table('berita')
        ->where('user_id', $desa->user_id)
        ->selectRaw('MONTHNAME(created_at) AS month, YEAR(created_at) AS year, COUNT(*) AS count')
        ->groupBy('year', 'month')
        ->orderByRaw('MIN(created_at) DESC')
        ->get();

        $archives = [];
        foreach ($archive as $row) {
            $data = [
                'month' => $row->month,
                'year' => $row->year,
                'count' => $row->count,
            ];

            $monthYear = $row->month . ' ' . $row->year;
            if (array_key_exists($monthYear, $archives)) {
                $archives[$monthYear]['jumlah'] += $row->count;
            } else {
                $archives[$monthYear] = $data;
            }
        }

        $selectedMonth = $request->query('month');
        $selectedYear = $request->query('year');
        $selectedMonthYear = $selectedMonth . ' ' . $selectedYear;

        if ($selectedMonth && $selectedYear) {
            $berita = DB::table('berita')
                ->whereMonth('created_at', '=', date('m', strtotime($selectedMonth)))
                ->whereYear('created_at', '=', $selectedYear)
                ->where('user_id', $desa->user_id)->latest()->paginate(9);
        }

        return view('berita.berita', compact('berita','archives','selectedMonthYear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita.create');
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
        $data['user_id'] = Auth::user()->id; 

        if ($request->gambar) {
            $file = $request->gambar;
            $data['gambar'] = $this->gambarPath($file,'berita');
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success','Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita, $slug)
    {
        // $desa = Desa::find(1);
        //$beritas = Berita::where('id','!=', $berita->id)->inRandomOrder()->limit(3)->get();
        if ($slug != Str::slug($berita->judul)) {
            return abort(404);
        }
        $berita->update(['dilihat' => $berita->dilihat + 1]);
        return view('berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Berita  $beritum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $beritum)
    {
        $data = $request->validate([
            'judul'     => ['required','string','max:191'],
            'konten'    => ['required'],
            'gambar'    => ['nullable','image','max:2048'],
        ]);

        if ($request->gambar) {
            if ($beritum->gambar) {
                //File::delete(storage_path('app/' . $beritum->gambar));
                File::delete(public_path() . $beritum->gambar);
            }
            $file = $request->gambar;
            $data['gambar'] = $this->gambarPath($file,'berita');
        }

        $beritum->update($data);

        return back()->with('success','Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Berita  $beritum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $beritum)
    {
        if ($beritum->gambar) {
            //File::delete(storage_path('app/' . $beritum->gambar));
            File::delete(public_path() . $beritum->gambar);
        }
        $beritum->delete();
        return back()->with('success','Berita berhasil dihapus');
    }
}
