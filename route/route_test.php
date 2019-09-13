<?php
/**
 * author: NanQi
 * datetime: 2019/4/22 17:00
 */

//测试路由，只有在测试环境下才可以访问
use think\facade\Route;

Route::group('test', function() {
    Route::get('test', 'Index/test');
    Route::get('test2', 'Index/test');
})->prefix('test/')->middleware(['test', 'throttle']);


Route::group('api', function() {
    Route::get('lang', 'Test/lang');
    Route::get('schedule', 'Test/schedule');
    Route::get('model/not_found', 'Test/notFound');
    Route::get('test', 'Test/test');
})->prefix('api/v1.')->middleware(['test', 'throttle', 'lang']);