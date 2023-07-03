<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class navbarController extends Controller
{
    public function index()
    {
        $navbar = $this->getTablebyUser('navbars');
        return view('navbar.index', compact('navbar'));
    }
    public function create()
    {
        // $parent = $this->getTablebyUser('navbars');
        $parent = DB::table('navbars')->where([
            ['user_id','=',Auth::user()->id],
            ['parent','=',null]
        ])->get();
        $page = $this->getTablebyUser('pages');
        $modul = DB::table('moduls')->get();
        return view('navbar.create',compact('parent','page','modul'));
    }
    public function edit($navbar)
    {
        $navbar = $this->firstTablebyId('navbars',$navbar);
        //$parent = $this->getTablebyUser('navbars');
        $parent = DB::table('navbars')->where([
            ['user_id','=',Auth::user()->id],
            ['parent','=',null]
        ])->get();
        $page = $this->getTablebyUser('pages');
        $modul = DB::table('moduls')->get();
        return view('navbar.edit',compact('navbar','parent','page','modul'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'parent'    => 'nullable|numeric',
            'title'     => 'required|string',
            'type'      => 'required|numeric',
            'tipe1'     => 'nullable|url',
            'tipe2'     => 'nullable|string',
            'page'      => 'nullable|string',
            'modul'     => 'nullable|string',
            'target'    => 'nullable|string',
            'enable'    => 'numeric|nullable',
            // 'url'       => 'required'
        ]);
        if (!$request->enable) {
            $data['enable'] = 0;
        }

        if($data['type'] == 1) {
            $data['url'] = $data['tipe1'];
        }
        else if ($data['type'] == 2) {
            $data['url'] = $data['tipe2'];
        }
        else if ($data['type'] == 3) {
            $data['url'] = $data['page'];
        }
        else if ($data['type'] == 4) {
            $data['url'] = $data['modul'];
        }
        unset($data['tipe1']);
        unset($data['tipe2']);
        unset($data['page']);
        unset($data['modul']);

        $data = $this->createRowbyUser('navbars',$data);
        return redirect()->route('navbar.index')->with('success', 'Navbar berhasil dibuat');
    }
    public function update(Request $request, $navbar)
    {
        $data = $request->validate([
            'parent'    => 'nullable|numeric',
            'title'     => 'required|string',
            'type'      => 'required|numeric',
            'tipe1'     => 'nullable|url',
            'tipe2'     => 'nullable|string',
            'page'      => 'nullable|string',
            'modul'     => 'nullable|string',
            'target'    => 'nullable|string',
            'enable'    => 'numeric|nullable',
        ]);
        if (!$request->enable) {
            $data['enable'] = 0;
        }

        if($data['type'] == 1) {
            $data['url'] = $data['tipe1'];
        }
        else if ($data['type'] == 2) {
            $data['url'] = $data['tipe2'];
        }
        else if ($data['type'] == 3) {
            $data['url'] = $data['page'];
        }
        else if ($data['type'] == 4) {
            $data['url'] = $data['modul'];
        }
        unset($data['tipe1']);
        unset($data['tipe2']);
        unset($data['page']);
        unset($data['modul']);

        $data = $this->updateRowbyUser('navbars',$navbar,$data);
        return redirect()->route('navbar.index')->with('success', 'Navbar berhasil diupdate');
    }
    public function destroy($navbar)
    {
        DB::table('navbars')->where('id',$navbar)->delete();
        return back()->with('success','Navbar berhasil dihapus');
    }
}
