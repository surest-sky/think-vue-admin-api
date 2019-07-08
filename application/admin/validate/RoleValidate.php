<?php
/**
 * TypechoQiNiu
 * @package TypechoQiNiu
 * @author 邓尘锋
 * @version v1.0.0
 * Date: 2019/6/29
 * Time: 22:42
 */

namespace app\admin\validate;

use Surest\Model\Role;

class RoleValidate extends BaseValidate
{
    protected $rule = [
        'name' => 'require|max:200|isRoleCreated',
        'remark' => 'max:200'
    ];

    protected $message = [
        'name.require' => '角色名称不能为空',
        'name.isRoleCreated' => '角色已经被创建',
        'name.max' => '角色名称不能大于200个字符',
        'remark.max' => '角色名称不能大于200个字符',
    ];

    /**
     * 检查是否重复
     * @param $value
     * @param $temp
     * @param $data
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function isRoleCreated($value, $temp, $data)
    {
        $id = request()->param('id');
        if($id) {
            return (bool)Role::where('id', '<>', $id)->where('name', $value)->find();
        }
        return (bool)Role::where('name', $value)->find();
    }
}