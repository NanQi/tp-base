<?php
/**
 * Created by PhpStorm.
 * User: 86155
 * Date: 2019/3/26
 * Time: 17:25
 */

namespace app\api\validate;


class LanguageValidate extends BaseValidate
{
    protected $rule = [
        'language' => 'require|isNotEmpty|in:1,2',
    ];
}