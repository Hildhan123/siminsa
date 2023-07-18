<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use File;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = $this->getTablebyUser('agendas');
        return view('agenda.index',compact('agenda'));
    }
    public function create()
    {
        return view('agenda.create');
    }
    public function edit($agenda)
    {
        $agenda = $this->firstTablebyId('agendas',$agenda);
        return view('agenda.edit',compact('agenda'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gambar'            => 'nullable|image|max:2048',
            'nama'             => 'required|string|max:100',
            'lokasi'            => 'required|string|max:50',
            'tanggalDimulai'    => 'required|date',
            'tanggalBerakhir'   => 'required|date',
            'detail'            => 'nullable',
        ]);

        if ($request->gambar) {
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'agenda');
        }
        $data = $this->createRowbyUser('agendas',$data);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dibuat');
    }
    public function update($agenda, Request $request)
    {
        $data = $request->validate([
            'gambar'            => 'nullable|image|max:2048',
            'nama'             => 'required|string|max:100',
            'lokasi'            => 'required|string|max:50',
            'tanggalDimulai'    => 'required|date',
            'tanggalBerakhir'   => 'required|date',
            'detail'            => 'nullable',
        ]);

        $agenda = DB::table('agendas')->where('id',$agenda)->first();

        if ($request->gambar) {
            File::delete(public_path() . $agenda->gambar);
            $file = $request->gambar;

            $data['gambar'] = $this->gambarPath($file,'agenda');
        }
        $data = $this->updateRowbyUser('agendas',$agenda->id,$data);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diupdate');
    }
    public function destroy($agenda)
    {
        $agenda = DB::table('agendas')->where('id',$agenda)->first();
        if($agenda->gambar) {
            File::delete(public_path() . $agenda->gambar);
        }
        DB::table('agendas')->where('id',$agenda->id)->delete();
        return back()->with('success','Agenda berhasil dihapus');
    }
    public function show()
    {
        $agenda = $this->getTablebyDesa('agendas');
        return view('agenda.show',compact('agenda'));
    }
    public function detail($agenda)
    {
        $agenda = $this->firstTablebyId('agendas',$agenda);
        return view('agenda.detail',compact('agenda'));
    }
}
