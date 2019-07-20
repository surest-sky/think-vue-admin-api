<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-11
 * Time: 上午11:54
 */

namespace app\admin\validate;

use app\common\validate\BaseValidate;
use Surest\Model\Role;

class RoleValidate extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isUnique',
        'reamark' => 'max:100',
        'permission_ids' => 'regex:ids'
    ];

    protected $message = [
        'name.isUnique' => '角色名称已经存在',
        'name.require' => '角色名称必须存在',
        'permission_ids.regex' => '权限id格式必须符合',
        'reamark' => '备注字数不能超过100个字符串'
    ];

    protected function isUnique($name) {
        if($id = request()->id) {
            if(Role::where('name', $name)->where('id', '<>', $id)->find()) {
                return false;
            }
        }else{
            if(Role::where('name', $name)->find()) {
                return false;
            }
        }

        return true;
    }
}