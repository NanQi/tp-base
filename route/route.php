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

use app\api\validate\IdValidate;
use app\api\validate\LanguageValidate;
use app\api\validate\member\SetUsernameValidate;
use app\api\validate\password\PasswordValidate;
use app\api\validate\password\PayPasswordMail;
use app\api\validate\password\ResavePasswordInapp;
use app\api\validate\password\ResavePasswordNoPay;
use app\api\validate\password\ResavePasswordValidate;
use app\api\validate\phone\BlindPhone;
use app\api\validate\phone\PhoneSendCodeValidate;
use app\api\validate\property\BaozhiValidate;
use app\api\validate\property\CalendarValidate;
use app\api\validate\property\UserClickValidate;
use think\facade\Route;

//需要验证的API路由
Route::group('api/:version', function() {

    Route::get('auth_token', 'Test/auth_token');

})->prefix('api/:version.')->middleware('auth');
