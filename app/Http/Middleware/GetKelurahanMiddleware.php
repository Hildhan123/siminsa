<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use View;

class GetKelurahanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nama = $request->route('kelurahan_slug');
        //$nama = 'mangunjiwan'; //disesuaikan dengan nama desa
        // Ambil data Desa/Kelurahan berdasarkan 'nama'
        $desa = DB::table('kelurahan')->where('slug', $nama)->first();

        if ($desa) {
            // Bagikan data 'desa' ke semua controller
            app()->instance('desa', $desa);
            app()->instance('kelurahan', $desa);

            View::share('desa', $desa);

            return $next($request);
        } else {
            return abort(404);
        }
    }
}