<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfMarketplaceNotConnected
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
        if(!auth()->user()->stripe_id){//ako uzero nema stripe id nema da mozi da posetuva nisto pred da se registrira na stripe
            return redirect()->route('account.connect')
                ->withError('please connect a Stripe Account');
        }

        return $next($request);
    }
}
