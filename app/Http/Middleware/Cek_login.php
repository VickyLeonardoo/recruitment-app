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
            return redirect('auth.login')->with('error','You don\'t have permission to access this page!');
        }
        $user = Auth::user();

        if (in_array($user->role_id, $roles)) {
            if ($user->is_active == 0) {
                return redirect()->route('auth.login')->with('error','Your account is not active');
            }
            return $next($request); 
        }
        return redirect('auth.login')->with('error','You don\'t have permission to access this page!');
    }
}
