<?php

namespace app\api\middleware;

use app\framework\ApiHelper;
use Closure;
use think\Request;

class TokenMiddleware
{
    use ApiHelper;

    public function handle(Request $request, Closure $next)
    {
        $token = $request->header(config('setting.token_header_name'));
        if (!$token) {
            return $this->getResponse(1000);
        }

        return $next($request);
    }
}
