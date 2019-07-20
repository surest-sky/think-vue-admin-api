<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-12
 * Time: 上午10:28
 */

namespace app\admin\validate;


use app\admin\model\AdminUser;
use app\common\validate\BaseValidate;

class AdminUserValidate extends BaseValidate
{
    protected $rule = [
        'username' => 'require|min:1|isUnique',
        'password' => 'min:6|max:20',
        'description' => 'max:100',
        'user_nickname' => 'max:100',
        'user_avatar' => 'require|url',
        'role_ids' => 'regex:ids',
        'email' => 'email|isUnique',
        'isNotice' => 'in:1,2'
    ];

    protected $message = [
        'username.isUnique' => '用户名已经存在了',
        'email.isUnique' => '邮箱已经存在了',
    ];


    protected function isUnique($name, $tmp, $data, $field) {
        if($id = request()->id) {
            if(AdminUser::where($field, $name)->where('id', '<>', $id)->find()) {
                return false;
            }
        }else{
            if(AdminUser::where($field, $name)->find()) {
                return false;
            }
        }
        return true;
    }
}