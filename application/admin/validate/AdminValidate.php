<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-11
 * Time: 下午5:00
 */

namespace app\admin\validate;

use app\common\validate\BaseValidate;

class AdminValidate extends BaseValidate
{
    protected $rule = [
        'username' => 'require|min:4|max:10',
        'password' => 'require|min:4|max:20',
    ];
}