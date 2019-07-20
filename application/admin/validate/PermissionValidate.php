<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-10
 * Time: 上午11:15
 */

namespace app\admin\validate;

use app\common\validate\BaseValidate;

class PermissionValidate extends BaseValidate
{
    protected $rule = [
        'p_id' => 'require|min:0',
        'name' => 'require|min:1|max:20',
        'rule' => 'require|min:1|max:20',
        'remark' => 'min:1',
        'status' => 'require|in:1,0',
        'method' => 'require|min:1',
        'route' => 'max:100',
        'hidden' => 'require|in:1,0',
        'icon' => 'min:1'
    ];
}