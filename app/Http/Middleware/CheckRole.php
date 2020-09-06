<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if ($request->user()->role === 0) {
            alert('Attention!', 'Vous n\'avez pas le droit de faire cette action', 'error');
            // return abort(403);
            return redirect('/');
        }
        return $next($request);
    }
}