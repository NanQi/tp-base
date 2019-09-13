<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/4
 * Time: 11:18
 */

namespace app\api\validate;


class IdValidate extends BaseValidate
{
    protected $rule = [
        'id'  =>  'require|number|isNotEmpty',
    ];
}