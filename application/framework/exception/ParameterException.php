<?php
namespace app\framework\exception;

/**
 * Class ParameterException
 * 通用参数类异常错误
 */
class ParameterException extends BaseException
{
    public $errorCode = 10000;
    public $msg = "invalid parameters";
}