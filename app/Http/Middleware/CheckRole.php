<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
        public function handle($request, Closure $next, ... $roles)
    {
        if (!\Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect('login');

        
        $user = \Auth::user();

        // check if blocked
        if($user->blocked){
        return redirect()->route('response')->with(['error' => 'Twoje konto zostało zablokowane. ']);
        }
        
        foreach($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if($user->role==$role)
                return $next($request);
        }

        return redirect()->route('response')->with(['error' => 'Unauthorized access']);
    }
}