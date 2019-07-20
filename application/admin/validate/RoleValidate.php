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
        'name.isUnique' => '角色名称已经存在'
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