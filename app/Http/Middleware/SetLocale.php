<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Support\Carbon;

class SetLocale
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
        $locale = App::getLocale();
        $localeFourDigits = $locale . '_' . strtoupper($locale);

        Carbon::setLocale($locale);
        setlocale(LC_TIME, $localeFourDigits);

        return $next($request);
    }
}
