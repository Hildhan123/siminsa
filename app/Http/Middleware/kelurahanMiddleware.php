<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;

class kelurahanMiddleware
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
        $kelurahan = DB::table('kelurahan')->where('user_id',Auth::user()->id)->first();
        if (!$kelurahan) {
            return view('desa.create');//Buat kelurahan terlebih dahulu
        } else { 
            // Specifying a default value...
            // session(['id' => bcrypt(Auth::user()->id)]);
            return $next($request);
        }
    }
}
