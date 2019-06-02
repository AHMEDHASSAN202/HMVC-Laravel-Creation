<?php

namespace Modules\Users\Http\Middleware;

use Closure;

class TestMiddleware
{

    public function handle($request, Closure $next, $guard = null)
    {
        return $next($request);
    }
}
