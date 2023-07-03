<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use DB;
use Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $desa = app('desa');
        // View::composer('*', function ($view) use($desa) {
        //     $parentMenus = DB::table('navbars')
        //         ->where('user_id',$desa->user_id)
        //         ->whereNull('parent')
        //         ->orderBy('id', 'asc')
        //         ->get();
    
        //     $menuItems = [];
        //     foreach ($parentMenus as $parentMenu) {
        //         $menu = [
        //             'parent' => $parentMenu,
        //             'children' => DB::table('navbars')
        //                 ->where([
        //                     ['parent','=', $parentMenu->id],
        //                     ['user_id','=',$desa->user_id]
        //                     ])
        //                 ->orderBy('id', 'asc')
        //                 ->get(),
        //         ];
        //         $menuItems[] = $menu;
        //     }
    
        //     $view->with('menuItems', $menuItems);
        // });
    }
}
