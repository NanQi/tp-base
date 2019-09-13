<?php
namespace app\framework\exception;

use think\Exception;

class BaseException extends Exception
{
    public $msg = 'invalid parameters';
    public $errorCode = 999;
    public $data = [];

    public function __construct($errorCode, $msg = '', $data = false)
    {
        $this->errorCode = $errorCode;
        if($msg){
            $this->msg = $msg;
        }

        if($data){
            $this->data = $data;
        }

    }
}

