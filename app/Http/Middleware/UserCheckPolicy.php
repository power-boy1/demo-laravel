<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserCheckPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param $ability
     * @return mixed
     */
    public function handle($request, Closure $next, $ability)
    {
        if (Auth::user() !== null) {
            if (policy(\App\Models\User::class)->before(Auth::user())) {
                return $next($request);
            }
        }

        if (policy(\App\Models\User::class)->$ability(Auth::user())) {
            return $next($request);
        }

        abort(403);
    }
}
