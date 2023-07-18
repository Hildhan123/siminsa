<?php

namespace App\Http\Controllers;

// use App\Traits\HasUserId;
use Illuminate\Http\Request;
use DB;
use File;
use Auth;


class PegawaiController extends Controller
{
    // use HasUserId;
    public function index()
    {
        $pegawai = $this->getTablebyUser('pegawais');
        return view('pegawai.index', compact('pegawai'));
    }
    public function create()
    {
        $organisasi = $this->getTablebyUser('organisasis');
        return view('pegawai.create', compact('organisasi'));
    }
    public function edit($pegawai)
    {
        $organisasi = $this->getTablebyUser('organisasis');
        $organisasiPegawai = DB::table('organisasis')->where('pegawai_id', $pegawai)->first();
        $pegawai = DB::table('pegawais')->where('id', $pegawai)->first();
        return view('pegawai.edit', compact('organisasi', 'pegawai', 'organisasiPegawai'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'nip' => ['numeric', 'nullable'],
            'jabatan1' => ['nullable', 'string'],
            'jabatan2' => ['nullable', 'string'],
            'deskripsi' => ['nullable'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);
        //check jabatan
        if ($request['tipe_jabatan'] == 'struktural') {
            $data['jabatan'] = $data['jabatan1'];
        } else {
            $data['jabatan'] = $data['jabatan2'];
        }
        unset($data['jabatan1']);
        unset($data['jabatan2']);

        if ($request->photo) {
            $file = $request->photo;
            
            $data['photo'] = $this->gambarPath($file,'pegawai');
        }
        //$data = $this->createRowbyUser('pegawais',$data);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['user_id'] = Auth::user()->id;

        $idPegawai = DB::table('pegawais')->insertGetId($data);
        if ($request['tipe_jabatan'] == 'struktural') {
            //update organisasi
            DB::table('organisasis')->where('title', $data['jabatan'])->update(['pegawai_id' => $idPegawai]);
        }

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }
    public function update($pegawai, Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'nip' => ['numeric', 'nullable'],
            'jabatan1' => ['nullable', 'string'],
            'jabatan2' => ['nullable', 'string'],
            'deskripsi' => ['nullable'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $pegawai = DB::table('pegawais')->where('id', $pegawai)->first();

        //check jabatan
        if ($request['tipe_jabatan'] == 'struktural') {
            $data['jabatan'] = $data['jabatan1'];
            //update organisasi
            DB::table('organisasis')->where('title', $data['jabatan'])->update(['pegawai_id' => $pegawai->id]);
        } else {
            $data['jabatan'] = $data['jabatan2'];
        }
        unset($data['jabatan1']);
        unset($data['jabatan2']);

        if ($request->photo) {
            File::delete(public_path() . $pegawai->photo);
            $file = $request->photo;

            $data['photo'] = $this->gambarPath($file,'pegawai');
        }
        $data = $this->updateRowbyUser('pegawais',$pegawai->id,$data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diupdate');
    }
    public function destroy($pegawai)
    {
        $pegawai = DB::table('pegawais')->where('id', $pegawai)->first();
        if ($pegawai->photo) {
            File::delete(public_path() . $pegawai->photo);
        }

        DB::table('pegawais')->where('id', $pegawai->id)->delete();
        return back()->with('success', 'Pegawai berhasil dihapus');
    }
    public function show()
    {
        $pegawai = $this->getTablebyDesa('pegawais');
        return view('pegawai.show',compact('pegawai'));
    }
    public function detail($pegawai)
    {   
        $pegawai = $this->firstTablebyId('pegawais',$pegawai);
        return view('pegawai.detail',compact('pegawai'));
    }
}