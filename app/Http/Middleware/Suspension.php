<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Suspension
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
        $user = Auth::user();
        if (!$user->active) {
            $request->session()->flash('error', 'Your account has been suspended.');
            Auth::logout();
            return redirect('/auth/login');
        }
        return $next($request);
    }
}
