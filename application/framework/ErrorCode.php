<?php
/**
 * author: NanQi
 * datetime: 2019/4/27 9:07
 */
namespace app\framework;

/**
 * ErrorCode实体类
 * Class ErrorCode
 * @package app\api\common
 */
class ErrorCode {
    public function __construct($code, $msg)
    {
        $this->code = $code;
        $this->msg = $msg;
    }
}
