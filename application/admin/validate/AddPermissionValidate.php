<?php
/**
 * TypechoQiNiu
 * @package TypechoQiNiu
 * @author 邓尘锋
 * @version v1.0.0
 * Date: 2019/6/29
 * Time: 22:57
 */

namespace app\admin\validate;


class AddPermissionValidate extends BaseValidate
{
    protected $rule = [
        'pids' => 'require|ids',
        'rid' => 'require',
    ];

    protected $message = [
        'pids.require' => '请选择权限',
        'rid.require' => '请选择角色',
        'pids.ids' => '权限id不符合规范',
    ];
}