<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-9
 * Time: 下午2:52
 */

namespace app\admin\validate;

use app\common\validate\BaseValidate;

class CircleValidate extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|regex:ids',
        'status' => 'require|in:0,1,2,3'
    ];

    protected $message = [
        'ids.require' => 'ids必须存在',
        'ids.regex' => 'ids必须符合规则',
        'status.regex' => 'status必须存在',
        'status.in' => 'status必须符合规则',
    ];
}