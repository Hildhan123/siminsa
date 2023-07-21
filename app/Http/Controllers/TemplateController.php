<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use File;

class TemplateController extends Controller
{
    public function selayang()
    {
        $template = DB::table('template')->where([
            'user_id' => Auth::user()->id,
            'key' => 'selayang',
        ])->first();
        return view('template.selayang',compact('template'));
    }
    public function updateSelayang(Request $request, $template)
    {
        $data = $request->validate([
            'photo' => 'nullable|image|max:2048',
            'title' => 'required|string|max:50',
            'konten' => 'required',
            'active' => 'nullable',
        ]);
        if (!$request->active) {
            $data['active'] = 0;
        }

        $template = DB::table('template')->where('id', $template)->first();
        if ($request->photo) {
            File::delete(public_path() . $template->photo);
            $file = $request->photo;

            $data['photo'] = $this->gambarPath($file,'template');
        }

        $template = $this->updateRowbyUser('template',$template->id,$data);
        return redirect()->route('selayang-pandang')->with('success','Selayang Pandang berhasil diperbarui');
    }
    public function sambutan()
    {
        $template = DB::table('template')->where([
            'user_id' => Auth::user()->id,
            'key' => 'sambutan',
        ])->first();
        return view('template.sambutan',compact('template'));
    }
    public function updateSambutan(Request $request, $template)
    {
        $data = $request->validate([
            'photo' => 'nullable|image|max:2048',
            'title' => 'required|string|max:50',
            'konten' => 'required',
            'active' => 'nullable',
        ]);
        if (!$request->active) {
            $data['active'] = 0;
        }

        $template = DB::table('template')->where('id', $template)->first();
        if ($request->photo) {
            File::delete(public_path() . $template->photo);
            $file = $request->photo;

            $data['photo'] = $this->gambarPath($file,'template');
        }

        $template = $this->updateRowbyUser('template',$template->id,$data);
        return redirect()->route('sambutan')->with('success','Sambutan berhasil diperbarui');
    }
}
