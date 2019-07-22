<?php
/**
 * Created by PhpStorm.
 * User: surest : http://surest.cn
 * Date: 19-7-22
 * Time: 下午4:16
 */

namespace app\admin\validate;

use app\common\validate\BaseValidate;

class AvatarValidate extends BaseValidate
{
    protected $rule = [
        'file' => 'require|image'
    ];
}