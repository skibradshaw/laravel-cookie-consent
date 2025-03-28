<?php

namespace Devrabiul\CookieConsent\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CookieConsentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('cookie_consent')) {
            $request->session()->put('cookie_consent', false);
        }

        return $next($request);
    }
}
