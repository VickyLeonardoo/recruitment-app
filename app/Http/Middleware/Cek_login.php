<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth::check()) { 
            return redirect('login')->with('message','Kamu Belum Login');
        }
        $user = Auth::user();

        if (in_array($user->role_id, $roles)) {
            return $next($request); 
        }
        return redirect('login')->with('message','Kamu Tidak Punya Akses, Silahkan Login terlebih dahulu!');
    }
}
