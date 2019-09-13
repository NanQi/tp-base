<?php
/**
 * Created by PhpStorm.
 * User: NanQi
 * Date: 2019/4/4
 * Time: 15:36
 */
return [
    'host' => env('redis_host', '127.0.0.1'),
    'port' => env('redis_port', '6379'),
    'password' => env('redis_password', null),
    'timeout' => env('redis_timeout', 3600),
    'select' => env('cache_select', '1'),
];