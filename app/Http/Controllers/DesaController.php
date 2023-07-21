<?php

namespace App\Http\Controllers;

use App\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Auth;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //desa = $this->firstTablebyId('kelurahan',Auth::user()->id);
        //$desa = Desa::find(1);
        $desa = Desa::where('user_id',Auth::user()->id)->first();
        return view('desa.index', compact('desa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('desa.create');
    }
     public function store(Request $request)
    {

    }
    public function update(Request $request, Desa $desa)
    {
        if (request()->ajax()) {
            $validator = Validator::make($request->all(),[
                'logo'   => ['required', 'image', 'max:2048']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error'     => true,
                    'message'   => $validator->errors()->all()
                ]);
            }

            if ($desa->logo != 'logo.png') {
                File::delete(storage_path('app/'.$desa->logo));
            }

            $desa->logo = $request->file('logo')->store('public/logo');
            $desa->save();

            return response()->json([
                'error'     => false,
                'data'      => ['logo'   => $desa->logo]
            ]);
        } else {
            $data = $request->validate([
                'nama_kelurahan'            => ['required', 'max:64', 'string'],
                'kodepos'                   => 'required|numeric|digits_between:5,10',
                // 'nama_kecamatan'        => ['required', 'max:64', 'string'],
                'alamat'                => ['required', 'string'],
                'kontak'        => ['required', 'string', 'numeric'],
                // 'nama_kepala_desa'      => ['required', 'max:64', 'string'],
                // 'alamat_kepala_desa'    => ['required', 'string']
                'iframe'    => 'nullable',
            ]);

            if ($request->nama_kelurahan != $desa->nama_kelurahan  || $request->kodepos != $desa->kodepos || $request->alamat != $desa->alamat || $request->kontak != $desa->kontak || $request->iframe != $desa->iframe) {
                $desa->update($data);
                return redirect()->back()->with('success','Profil desa berhasil di perbarui');
            } else {
                return redirect()->back()->with('error','Tidak ada perubahan yang berhasil disimpan');
            }
        }
    }

    public function iframe(Request $request, Desa $desa)
    {
        $data = $request->validate([
            'iframe' => 'required',
        ]);

        $desa->update($data);
        return redirect()->back()->with('success','Maps desa berhasil di perbarui');
    }
}
