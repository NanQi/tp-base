<?php

namespace app\api\middleware;

use Closure;
use think\Request;

class LangMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
