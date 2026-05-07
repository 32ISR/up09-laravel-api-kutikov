<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class TrustProxies
{
    public function handle(Request $request, Closure $next) {
        dump($request);
        $request->headers->remove('content-length');

        return $next($request);
    }    
    // protected $proxies = '*';

    // protected $headers =
    // Request::HEADER_X_FORWARDED_FOR |
    // Request::HEADER_X_FORWARDED_PORT |
    // Request::HEADER_X_FORWARDED_HOST |
    // Request::HEADER_X_FORWARDED_PROTO |
    // Request::HEADER_X_FORWARDED_AWS_ELB;
}