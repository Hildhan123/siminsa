<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use View;
use App\Pengunjung;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

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
        // Ambil data Desa/Kelurahan berdasarkan 'nama'
        $desa = DB::table('kelurahan')->where('slug',$nama)->first();
        if ($desa) {
            // Bagikan data 'desa' ke semua controller
            app()->instance('desa', $desa);
            app()->instance('kelurahan', $desa);

            View::share('desa', $desa);

            $ipAddress = $request->ip();

            if (!session()->has('pengunjung')) {
                Pengunjung::create([
                    'ip_address' => $ipAddress,
                    'waktu_kunjungan' => Carbon::now(),
                ]);
                Session::put('pengunjung', $ipAddress, now()->addHour(2));
            }
            
            return $next($request);
        } else {
            return abort(404);
        }
    }
}