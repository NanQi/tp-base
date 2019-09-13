<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/8 0008
 * Time: 14:00
 */

namespace app\api\controller\v1;


use app\api\model\MemberModel;
use app\framework\BaseController;
use app\framework\Schedule;
use think\facade\Lang;

class TestController extends BaseController
{
    public function get_version()
    {
        $this->retError(1001);
//        $this->retSuccess('get_version');
    }

    public function auth_token()
    {
        $this->retError(9902, 'test');
    }

    public function test()
    {
        dump([ 'name'  => 'huwei'] + ['age' => 'nanqi']);
    }

    public function notFound(MemberModel $memberModel)
    {
        $info = $memberModel->findOrFail('305354942499293131');
        $this->retSuccess($info->toArray());
    }

    public function schedule(Schedule $schedule)
    {
        $schedule->run();
    }

    public function lang()
    {
        $name = Lang::get('name');
        echo $name;
    }
}
