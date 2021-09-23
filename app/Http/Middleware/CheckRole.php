<?php

namespace App\Http\Middleware;

use auth;
use Closure;
use App\Models\Role;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($request->user()->role()->where('id', $role)->exists()) {
            return $next($request);
        }else{
            abort(403);
        }
    }
}
