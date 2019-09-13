<?php

namespace app\api\middleware;

use app\framework\ApiHelper;
use Closure;
use think\Request;

/**
 * 操作中间件，用以热升级所用
 * Class OperateMiddleware
 * @package app\api\middleware
 */
class OperateMiddleware
{
    use ApiHelper;

    public function handle(Request $request, Closure $next)
    {
        $flg = false;
        if ($flg) {
            return $this->getResponse('0001');
        }

        return $next($request);
    }
}
