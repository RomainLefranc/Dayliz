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
        // $roles = [
        //     'user' => [1],
        //     'admin' => [1,2]
        // ];

        // $role_ids = $roles[$role];
        // $test= auth()->user();
        // //dd($test);
        //dd($request->user());
        
        // if (!in_array(auth()->user()->role_id, $role_ids)) {
        //     abort(403);
        // }

        //dd($request->user()->role_id);
        //die();

        // $role_name = Role::query()
        //     ->where('name', 'LIKE', "%{$role}%") 
        //     ->first()->id;
        
        //     //dd($role_name);
        
        //$request->user()->roles()->where('name', $role)->exists()
        
        // if ($request->user()->role_id == $role_name) {
        if ($request->user()->role()->where('name', $role)->exists()) {
            return $next($request);
        }else{
            abort(403);
        }
        //dd($role);

        //return redirect('URI', 'URI', 301);

    }
}
