<?php
/**
 * author: NanQi
 * datetime: 2019/4/27 9:42
 */
namespace app\exception;

use Exception;

class NoFoundArgumentException extends Exception {
    protected $message = "没有找到路由对应的参数";
}