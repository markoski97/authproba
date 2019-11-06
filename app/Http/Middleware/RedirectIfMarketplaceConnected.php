<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfMarketplaceConnected
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
        if(auth()->user()->stripe_id){//go zema usero i ako ima akaunt ne go truja pak da praj ist :D
            return redirect()->route('account');
        }
        return $next($request);
    }
}
