<?php

namespace app\api\middleware;

use app\framework\ApiHelper;
use Closure;
use think\Request;
use think\Response;

class TestMiddleware
{
    use ApiHelper;

    public function handle(Request $request, Closure $next)
    {
        $isDebug = config('app.app_debug');
        if (!$isDebug) {
            return $this->getResponse(1003);
        }

        return $next($request);
    }
}
