<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVisitorRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->hasRole('visitor')) {
            return redirect()->route('home')->with('error', 'Only visitors can make reservations');
        }

        return $next($request);
    }
}
