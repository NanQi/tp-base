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
// | 缓存设置
// +----------------------------------------------------------------------

return [
    // 驱动方式
    'type'   => 'redis',
    // 缓存保存目录
    'path'   => '',
    // 缓存前缀
    'prefix' => 'inspiration:',
    // 缓存有效期 0表示永久缓存
    'expire' => 60,
    // Redis缓存
    'host' => env('redis_host', '127.0.0.1'),
    'port' => env('redis_port', '6379'),
    'password' => env('redis_password', null),
    'timeout' => env('redis_timeout', 3600),
    'select' => env('cache_select', '2'),
];
