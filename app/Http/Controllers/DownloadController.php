<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use File;

class DownloadController extends Controller
{
    public function index()
    {
        $download = $this->getTablebyUser('downloads');
        return view('download.index',compact('download'));
    }
    public function create()
    {
        return view('download.create');
    }
    public function edit($download)
    {
        $download = $this->firstTablebyId('downloads',$download);
        return view('download.edit',compact('download'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'keterangan' => ['string', 'nullable','max:200'],
            'tipe' => ['required','string'],
            'file1' => ['nullable'],
            'file2' => ['nullable'],
        ]);

        if($data['tipe'] == 'internal') {
            $request->validate(['file1' => 'required|mimes:doc,docx,pdf|max:20000']);
            $file = $request->file1;
            
            $data['file'] = $this->gambarPath($file,'download');
        } else {
            $request->validate(['file2' => 'required|url']);
            $data['file'] = $data['file2'];
        }
        unset($data['file1']);
        unset($data['file2']);

        $data = $this->createRowbyUser('downloads',$data);

        return redirect()->route('download.index')->with('success', 'Download berhasil dibuat');
    }
    public function update($download, Request $request)
    {
        $download = DB::table('downloads')->where('id',$download)->first();
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'keterangan' => ['string', 'nullable','max:200'],
            'tipe' => ['required','string'],
            'file1' => ['nullable'],
            'file2' => ['nullable'],
        ]);

        if($data['tipe'] == 'internal') {
            $request->validate(['file1' => 'nullable|mimes:doc,docx,pdf|max:20000']);
            if($request->file1) {
                File::delete(public_path() . $download->file);
                $file = $request->file1;

                $data['file'] = $this->gambarPath($file,'download');
            }
        } else {
            $request->validate(['file2' => 'required|url']);
            $data['file'] = $data['file2'];
        }
        unset($data['file1']);
        unset($data['file2']);

        $data = $this->updateRowbyUser('downloads',$download->id,$data);

        return redirect()->route('download.index')->with('success', 'Download berhasil diupdate');
    }
    public function destroy($download)
    {
        $download = DB::table('downloads')->where('id',$download)->first();
        if($download->tipe == 'internal') {
            File::delete(public_path() . $download->file);
        }
        DB::table('downloads')->where('id',$download->id)->delete();

        return back()->with('success','Download berhasil dihapus');
    }
    public function show()
    {
        $download = $this->getTablebyDesa('downloads');
        return view('download.show',compact('download'));
    }
    // public function detail()
    // {
    //     return view('download.detail');
    // }
}
