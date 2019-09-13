<?php
namespace app\api\validate;

use app\framework\ApiHelper;
use think\Validate;

/**
 * Class BaseValidate
 * 验证类的基类
 */
class BaseValidate extends Validate
{
    use ApiHelper;

    protected $code = 1010;


    /**
     * 检测所有客户端发来的参数是否符合验证类规则
     * 基类定义了很多自定义验证方法
     * 这些自定义验证方法其实，也可以直接调用
     * @return true
     */
    public function check($data, $rules = [], $scene = '')
    {
        if (!parent::check($data, $rules, $scene)) {
            $this->retError($this->code, $this->getError());
        }

        return true;
    }

    /**
     * @return array 按照规则key过滤后的变量数组
     */
    public function getDataByRule()
    {
        $inputData = input();
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            if(!empty($inputData[$key])){
                $newArray[$key] = $inputData[$key];
            }
        }
        return $newArray;
    }

    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return $field . '必须是正整数';
    }

    protected function isNotEmpty($value, $rule='', $data='', $field='')
    {
        if (empty($value)) {
            return $field . '不允许为空';
        } else {
            return true;
        }
    }

    //没有使用TP的正则验证，集中在一处方便以后修改
    //不推荐使用正则，因为复用性太差
    //手机号的验证规则
    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8|6|9)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    protected function isMail($value, $rule='', $data='', $field='')
    {
        $rule = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return $field . '格式不正确';
        }
    }

    protected function password($value, $rule='', $data='', $field='')
    {
        $rule = '/^(?![^a-zA-Z]+$)(?!\D+$).{6,}$/';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return $field . '格式不正确';
        }
    }

}