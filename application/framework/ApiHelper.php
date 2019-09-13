<?php
/**
 * Created by PhpStorm.
 * User: NanQi
 * Date: 2019/3/29
 * Time: 9:32
 */
namespace app\framework;

use app\api\validate\BaseValidate;
use app\exception\NoFoundArgumentException;
use app\exception\UndefinedValidateException;
use InvalidArgumentException;
use think\facade\Cache;
use think\facade\Request;
use think\Middleware;
use think\Response;
use UnexpectedValueException;

trait ApiHelper {

    /**
     * API返回
     * @param int $error_code
     * @param mixed $data
     * @param string $msg
     * @param array $header
     */
    private function retMessage(
        int $error_code
        , $data = false
        , string $msg = ''
        , array $header = [])
    {

        $response = $this->getResponse($error_code, $data, $msg, $header);
        $response->send();
        exit();
    }

    /**
     * 获取返回对象
     * @param string $error_code
     * @param mixed $data
     * @param string|array $msg
     * @param array $header
     * @return Response
     */
    public function getResponse(
        string $errorCode
        , $data = false
        , $msg = ''
        , array $header = [])
    {
        $errorCode = $this->getErrorCode($errorCode, $msg);

        $return['error_code'] = $errorCode->code;
        $return['msg'] = $errorCode->msg;
        $return['data'] = $data;
        $dataResponse = json_encode($return, JSON_UNESCAPED_UNICODE);

        $response = new Response($dataResponse, 200, $header);
        return $response;
    }

    /**
     * 获取参数
     * @param string $paramName 参数名
     * @return array|string 传入参数名返回参数值，否则返回所有参数
     * @throws UndefinedValidateException
     * @throws NoFoundArgumentException
     */
    public function getParam(string $paramName = '')
    {
        $res = request()->routeInfo()['option'];

        if(array_key_exists('validate', $res)){
            $res = $res['validate'];
        } else {
            throw new UndefinedValidateException();
        }

        if (count($res) <= 0) {
            throw new UndefinedValidateException();
        }

        $validate = new $res[0]();
        if ($validate instanceof BaseValidate) {

            $newArray = $validate->getDataByRule();
            if (!$paramName) {
                return $newArray;
            }

            if(in_array($paramName, $newArray)) {
                return $newArray[$paramName];
            } else {
                throw new NoFoundArgumentException();
            }
        } else {
            throw new UndefinedValidateException();
        }
    }

    /**
     * 获取登录的用户ID
     * @return string
     * @throws UndefinedValidateException
     */
    public function getAuthId()
    {
        $token = Request::header(config('setting.token_header_name'));

        $jwt = new JwtHelper();
        $user_id = $jwt->verify($token);
        if ($user_id === false) {
            throw new UndefinedValidateException('获取登录用户数据为空');
        }
        return $user_id;
    }

    /**
     * API返回正常
     * @param mixed $data 返回的数据
     */
    public function retSuccess($data = true)
    {
        $this->retMessage(0, $data);
    }

    /**
     * API返回失败
     * @param int $error_code 错误码
     * @param string $msg 错误信息
     * @param mixed $data 错误内容
     */
    public function retError($errorCode, $msg = '', $data = false)
    {
        $this->retMessage($errorCode, $data, $msg);
    }

    /**
     * 获取ErrorCode
     * @param string $code
     * @param string|array $msg
     * @return ErrorCode
     */
    public function getErrorCode(string $code, $msg = '')
    {
        if ($code < 0 || $code > 9999) {
            throw new InvalidArgumentException('code必须为0~9999之间的整数');
        }

        $code = str_pad($code, 4, '0', STR_PAD_LEFT);

        $errorCode = Cache::remember('ErrorCode', function() {
            $fileName = realpath(__DIR__ . '/ErrorCode.json');
            $jsonData = json_decode(file_get_contents($fileName), true);
            return $jsonData;
        }, -1);

        if (!$msg) {
            if (isset($errorCode[$code])) {
                $msg = $errorCode[$code];
            } else {
                throw new \UnexpectedValueException('没有对应的错误号' . $code);
            }
        } else if (is_array($msg)) {
            if (isset($errorCode[$code]) && strpos($errorCode[$code], '%s') !== false) {
                $msg = sprintf($errorCode[$code], ...$msg);
            } else {
                throw new \UnexpectedValueException('附加信息不匹配错误号' . $code);
            }
        } else if (is_string($msg)) {
            if ($code > 999 && isset($errorCode[$code])) {
                throw new \UnexpectedValueException('首位非0错误号不能自定义错误信息' . $code);
            }
        }

        return new ErrorCode($code, $msg);
    }

    public function gjPage()
    {
        return request()->param('page', 1);
    }

    public function gjSize()
    {
        return request()->param('size', 10);
    }


}