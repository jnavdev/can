<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class Access
{
    public function handle($request, Closure $next)
    {
        $currentDate = Carbon::now();

        if (auth()->user()->role_id == 1) {
            return $next($request);
        } else {
            if ($currentDate->format('l') == 'Saturday' || $currentDate->format('l') == 'Sunday') {
                if ($currentDate->format('H:i') < '08:00' || $currentDate->format('H:i') > '15:00') {
                    \Auth::logout();

                    return redirect('aceso-denegado');
                }
            } else {
                if ($currentDate->format('H:i') < '08:00' || $currentDate->format('H:i') > '20:00') {
                    \Auth::logout();

                    return redirect('aceso-denegado');
                }
            }
        }

        return $next($request);
    }
}
