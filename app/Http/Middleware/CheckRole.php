<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Validation\Rules\Exists;

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
        if ($request->user() === null) {
            alert('Attention!', 'Vous n\'avez pas les droits requises de faire cette action', 'error');
            // return abort(403);
            return redirect('/');
        }
        if ($request->user()->role != 1) {
            alert('Attention!', 'Vous n\'avez pas les droits requises de faire cette action', 'error');
            // return abort(403);
            return redirect('/');
        }
        return $next($request);
    }
}