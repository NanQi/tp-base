<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 中间件配置
// +----------------------------------------------------------------------
use app\api\middleware\LangMiddleware;
use app\api\middleware\OperateMiddleware;
use app\api\middleware\TestMiddleware;
use app\api\middleware\ThrottleMiddleware;
use app\api\middleware\TokenMiddleware;

return [
    'auth'	    => TokenMiddleware::class,
    'throttle'  => ThrottleMiddleware::class,
    'test'	    => TestMiddleware::class,
    'do'	    => OperateMiddleware::class,
    'lang'	    => LangMiddleware::class,
];
