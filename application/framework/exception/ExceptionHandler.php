<?php

namespace app\framework\exception;

use app\framework\ApiHelper;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use Exception;

/*
 * 重写Handle的render方法，实现自定义异常消息
 */

class ExceptionHandler extends Handle
{
    use ApiHelper;

    public function render(Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $response = $this->getResponse(3999, false, [$e->getModel()]);
            $response->send();
            exit;
        } else if ($e instanceof BaseException) {
            $this->retError($e->errorCode, $e->msg, $e->data);
        } else {
            if (config('app_debug')) {
                return parent::render($e);
            }

            $this->retError(4999);
            trace($e->getTraceAsString(), 'error');
        }
    }
}