<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Petugas;
use App\Models\Anggota;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach($roles as $role){
            if($role == 'anggota'){
                if (Anggota::where('api_token',$request->header('Authorization'))->first()){
                    return $next($request);
                }
            }

            if($role == 'petugas'){
                if (Petugas::where('api_token',$request->header('Authorization'))->first()){
                    return $next($request);
                } else {
                    return response('Unauthorized.', 401);
                }
            }
        }
    }
}
