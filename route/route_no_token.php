<?php
/**
 * author: NanQi
 * datetime: 2019/4/22 17:00
 */

//不需要验证的API路由，只允许get请求，不验证token
use think\facade\Route;

Route::group('api/:version', function() {
    Route::get('get_version', 'Test/get_version');
})->prefix('api/:version.');

