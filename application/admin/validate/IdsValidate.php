<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/20
 * Time: 9:37
 */

namespace app\admin\validate;


use app\common\validate\BaseValidate;
use think\Validate;

class IdsValidate extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|regex:ids'
    ];

    protected $message = [
        'ids.require' => "请选择参数",
        'ids.regex' => "参数不符合条件,请联系管理员",
    ];
}