<?php

namespace App\Http\Controllers;

use App\Berita;
use App\Desa;
use App\Gallery;
// use App\PemerintahanDesa;
// use App\Penduduk;
// use App\Surat;
use App\Video;
use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $desa = app('desa');
        //$desa = DB::table('kelurahan')->where('user_id',1)->first();
        $surat = null; //Surat::whereTampilkan(1)->latest()->take(3)->get();
        $berita = Berita::where('user_id',$desa->user_id)->latest()->take(3)->get();
        // $pemerintahan_desa = PemerintahanDesa::latest()->take(3)->get();
        $gallery = Gallery::where([
            ['slider','=', 1],
            ['user_id','=',$desa->user_id]
            ])->latest()->get();
        $galleries = array();
        $videos = Video::all();
        $pengumuman = DB::table('pengumumans')->where('user_id',$desa->user_id)->latest()->take(3)->get();
        $agenda = DB::table('agendas')->where('user_id',$desa->user_id)->latest()->take(3)->get();
        $organisasi = DB::table('organisasis')
            ->join('pegawais', 'pegawais.id', '=', 'organisasis.pegawai_id')
            ->where('organisasis.user_id',$desa->user_id)
            ->orderBy('order', 'asc')
            ->select('*', 'organisasis.id as id')
            ->get();

        foreach (Gallery::where(['slider' => null, 'organisasi' => null,'user_id' => $desa->user_id])->get() as $key => $value) {
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

        usort($galleries, function ($a, $b) {
            return strlen($a['created_at']) <=> strlen($b['created_at']);
        });

        return view('home.index', compact('desa', 'gallery', 'berita', 'galleries', 'pengumuman', 'agenda', 'organisasi'));
    }

    public function index2()
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        $surat = null; //Surat::all();
        $hari = 0;
        $bulan = 0;
        $tahun = 0;
        $totalCetakSurat = 0;
        $totalPenduduk = null; //new Penduduk();

        // foreach ($surat as $value) {
        //     if (count($value->cetakSurat) != 0) {
        //         foreach ($value->cetakSurat as $cetakSurat) {
        //             if (date('Y-m-d', strtotime($cetakSurat->created_at)) == date('Y-m-d')) {
        //                 $hari = $hari + 1;
        //             }
        //             if (date('Y-m', strtotime($cetakSurat->created_at)) == date('Y-m')) {
        //                 $bulan = $bulan + 1;
        //             }
        //             if (date('Y', strtotime($cetakSurat->created_at)) == date('Y')) {
        //                 $tahun = $tahun + 1;
        //             }
        //             $totalCetakSurat = $totalCetakSurat + 1;
        //         }
        //     }
        // }

        return view('dashboard', compact('surat', 'hari', 'bulan', 'tahun', 'totalCetakSurat', 'totalPenduduk'));
    }

    // public function suratHarian(Request $request)
    // {
    //     $date = $request->tanggal ? date('Y-m-d', strtotime($request->tanggal)) : date('Y-m-d');
    //     $surat = Surat::all();
    //     $data = array();
    //     foreach ($surat as $value) {
    //         if (count($value->cetakSurat) == 0) {
    //             $nilai = 0;
    //         } else {
    //             $nilai = 0;
    //             foreach ($value->cetakSurat as $cetakSurat) {
    //                 if (date('Y-m-d', strtotime($cetakSurat->created_at)) == $date) {
    //                     $nilai = $nilai + 1;
    //                 }
    //             }
    //         }

    //         array_push($data, [$value->nama, $nilai]);
    //     }

    //     return response()->json($data);
    // }

    // public function suratBulanan(Request $request)
    // {
    //     $date = $request->bulan ? date('Y-m', strtotime($request->bulan)) : date('Y-m');
    //     $surat = Surat::all();
    //     $data = array();
    //     foreach ($surat as $value) {
    //         if (count($value->cetakSurat) == 0) {
    //             $nilai = 0;
    //         } else {
    //             $nilai = 0;
    //             foreach ($value->cetakSurat as $cetakSurat) {
    //                 if (date('Y-m', strtotime($cetakSurat->created_at)) == $date) {
    //                     $nilai = $nilai + 1;
    //                 }
    //             }
    //         }

    //         array_push($data, [$value->nama, $nilai]);
    //     }

    //     return response()->json($data);
    // }

    // public function suratTahunan(Request $request)
    // {
    //     $date = $request->tahun ? $request->tahun : date('Y');
    //     $surat = Surat::all();
    //     $data = array();
    //     foreach ($surat as $value) {
    //         if (count($value->cetakSurat) == 0) {
    //             $nilai = 0;
    //         } else {
    //             $nilai = 0;
    //             foreach ($value->cetakSurat as $cetakSurat) {
    //                 if (date('Y', strtotime($cetakSurat->created_at)) == $date) {
    //                     $nilai = $nilai + 1;
    //                 }
    //             }
    //         }

    //         array_push($data, [$value->nama, $nilai]);
    //     }

    //     return response()->json($data);
    // }

    // public function panduan()
    // {
    //     $desa = Desa::find(1);
    //     return view('panduan', compact('desa'));
    // }
}