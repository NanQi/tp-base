<?php
/**
 * Created by PhpStorm.
 * User: 86155
 * Date: 2019/4/8
 * Time: 13:43
 */

namespace app\framework;

use app\exception\UndefinedValidateException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\JWT;
use think\Cache;

class JwtHelper
{
    use ApiHelper;

    /**
     * 生成JWT
     * @param string $user_id 用户ID
     * @return string token
     */
    public function build(string $user_id)
    {
        $key = config('secure.token_salt'); //key

        $now = time();
        $expire_in = config('setting.token_expire_in');

        $token = [
            'data' => $user_id,
            'exp' => $now + $expire_in,//过期时间，30天过期
        ];

        $access_token = JWT::encode($token, $key);
        return $access_token;
    }

    /**
     * 验证返回userId
     * @param string $token
     * @return bool
     * @throws UndefinedValidateException
     */
    public function verify(string $token)
    {
        $key = config('secure.token_salt');

        try {
            $ret = JWT::decode($token, $key, ['HS256']);
            if (!$ret) {
                return false;
            }
        } catch (SignatureInvalidException $signatureInvalidException) {
            //token验证不通过
            $this->retError(1001);
        } catch (BeforeValidException $beforeValidException) {
            //token前置验证不通过,暂时不存在
            throw new UndefinedValidateException('token前置验证不通过');
        } catch (ExpiredException $expiredException) {
            //token过期
            $this->retError(1002);
        }

        $user_id = $ret['data'];
        if (!$user_id) {
            return false;
        } else {
            return $user_id;
        }
    }
}