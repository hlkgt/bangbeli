<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FetchData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $links = Link::all();
        view()->share('links',$links);
        return $next($request);
    }
}
