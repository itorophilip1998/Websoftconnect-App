<?php

namespace App\Http\Middleware;

use Auth;
use Cache;
use Closure;
use Carbon\Carbon;
use App\Events\Notification;

class LastUserActivity
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
        if(Auth::check())
        {
            $expiresAt=Carbon::now()->addSeconds(20);
            Cache::put('user-is-online-'.Auth::user()->id,true,$expiresAt);
        }
        return $next($request);
    }
}
