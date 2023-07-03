<?php

namespace App\Traits;
use Auth;
use DB;

trait Traits
{
    public function getUserId($data)
    {
        $data = $data;
        $data['user_id'] = Auth::user()->id;

        return $data;
    }

    public function getTablebyUser($table)
    {
        $data = DB::table($table)->where('user_id',Auth::user()->id)->latest()->get();
        return $data;
    }
    public function getTablebyDesa($table)
    {
        $desa = app('desa');
        $data = DB::table($table)->where('user_id',$desa->user_id)->latest()->get();
        return $data;
    }
    public function firstTablebyId($table,$id)
    {
        $data = DB::table($table)->where('id',$id)->first();
        return $data;
    }
    public function createRowbyUser($table, $data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['user_id'] = Auth::user()->id;
        $data = DB::table($table)->insert($data);
        return $data;
    }
    public function updateRowbyUser($table,$id,$data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data = DB::table($table)->where('id',$id)->update($data);
        return $data;
    }

    public function gambarPath($raw,$folder)
    {
        $file = $raw;
        $id = Auth::user()->id;
        $unique = uniqid();
        $extFile = $file->getClientOriginalExtension();
        $namaFile = $unique . "{$id}" . "." . $extFile;
        $file->move('content/user-' . $id . '/' . $folder, $namaFile);
        $path = '/content/user-' . $id . '/' . $folder . '/' . $namaFile;
        return $path;
    }
    public function getMenuItems()
    {
        $desa = app('desa');
        $parentMenus = DB::table('navbars')
                ->where([
                    ['enable','=', 1],
                    ['user_id','=',$desa->user_id]
                    ])
                ->whereNull('parent')
                ->orderBy('id', 'asc')
                ->get();
    
            $menuItems = [];
            foreach ($parentMenus as $parentMenu) {
                $menu = [
                    'parent' => $parentMenu,
                    'children' => DB::table('navbars')
                        ->where([
                            ['parent','=', $parentMenu->id],
                            ['user_id','=',$desa->user_id],
                            ['enable','=', 1]
                            ])
                        ->orderBy('id', 'asc')
                        ->get(),
                ];
                $menuItems[] = $menu;
            }

        return $menuItems;
    }
}