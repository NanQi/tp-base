<?php
namespace app\api\controller;


use app\framework\BaseController;
use app\framework\NRedis;

class IndexController extends BaseController
{
    public function test(NRedis $redis)
    {
        $this->retSuccess();
        echo 'nanqi';
//        $redis->set('name1', 'nanqi');
//        cache('name', '5');
    }

    public function show()
    {
        echo 'show';
    }


}
