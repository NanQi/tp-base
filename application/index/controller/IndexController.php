<?php
namespace app\index\controller;

use app\framework\NRedis;

class IndexController
{
    public function test(NRedis $redis)
    {
        trace('index nanqi');
//        $redis->set('name1', 'nanqi');
//        cache('name', '5');
    }

    public function info()
    {
        echo 'info.php';
    }
}
