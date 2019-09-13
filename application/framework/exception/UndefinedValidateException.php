<?php
/**
 * author: NanQi
 * datetime: 2019/4/27 9:42
 */
namespace app\exception;

use Exception;

class UndefinedValidateException extends Exception {
    protected $message = "接受参数请验证参数，(^o^)Y";
}