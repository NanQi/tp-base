<?php
/**
 * Created by PhpStorm.
 * User: NanQi
 * Date: 2019/4/9
 * Time: 14:12
 */
namespace app\api\service;

/**
 * 风险控制
 * Class RiskService
 */
class DingDingService {

    protected  $url = "https://oapi.dingtalk.com/robot/send?access_token=47cdf8c06a6d22c33b61bf008176ba3af59dcd73866399b987ea453433911b8e";

    public function send($content)
    {
        return $this->curl_post($this->url, $content);
    }

    /**
     * @param string $url post请求地址
     * @param array $params
     * @return mixed
     */
    function curl_post($url, $data_string)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json'
            )
        );
        $data = curl_exec($ch);
        curl_close($ch);
        return ($data);
    }
}