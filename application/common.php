<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use googleauthenticator\Authenticator as GA;
// 应用公共文件
function goole_validate($secret,$code){
    $ga = new GA();
    //$s_code= $ga->getCode($user_arr['secret']);
    $verifyCode = $ga->verifyCode($secret,$code,2);
    return $verifyCode;
}

function getPrice(){
    $url = 'https://www.good.top:9001/queryprice';
    $data = json_encode(['contractName'=>'dke/usdt']);
    $header = [
        "Content-type: application/json;charset='utf-8'",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
    ];

    $content = sendCurl($url,'post',$data,$header);
    $price_arr = json_decode($content,true);
    $price = $price_arr['price'];
    return $price;
}

/**
 * 发送curl请求
 * @param $url
 * @param $type
 * @param string $data
 * @return mixed
 */
function sendCurl($url,$type,$data='',$header=false){
    if($type === 'get'){
        //创建curl资源
        $ch = curl_init() ;
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//设置是否返回数据
        curl_setopt($ch,CURLOPT_HEADER,false);//是否显示请求头
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);//是否显示请求头
        curl_setopt($ch,CURLOPT_TIMEOUT,10);//设置超时时间，秒
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//是否启用ssl验证
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);//是否验证主机
        //发起请求
        $content = curl_exec($ch);
        //关闭
        curl_close($ch);
        return $content;
    }else if($type === 'post'){
        //创建curl资源
        $ch = curl_init() ;
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//设置是否返回数据
        curl_setopt($ch,CURLOPT_HEADER,false);//是否显示请求头
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);//是否显示请求头
        curl_setopt($ch,CURLOPT_TIMEOUT,10);//设置超时时间，秒
        curl_setopt($ch,CURLOPT_POST,true);//设置post请求
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);//设置post请求参数
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//是否启用ssl验证
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);//是否验证主机
        //发起请求
        $content = curl_exec($ch);
        //关闭
        curl_close($ch);
        return $content;
    }else{
        return false;
    }
}