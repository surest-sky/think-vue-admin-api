<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-12
 * Time: 上午10:28
 */

namespace app\admin\validate;


use app\common\validate\BaseValidate;

class AdminUserLoginValidate extends BaseValidate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
    ];
}