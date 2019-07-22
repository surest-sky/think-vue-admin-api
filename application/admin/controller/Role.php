<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-11
 * Time: 上午11:52
 */

namespace app\admin\controller;

use app\admin\validate\RoleValidate;
use Surest\Model\Role as RoleModel;
use Surest\Traits\TreeNode;
use think\Db;

/**
 * 角色管理
 * Class Role
 * @package app\admin\controller
 */
class Role extends BaseController
{
    use TreeNode;

    /**
     * 角色管理
     */
    public function index()
    {
        $roles = RoleModel::where(0, 0)->select()->toArray();
        $this->successed(compact('roles'));
    }

    /**
     * 创建角色
     */
    public function save()
    {
        $v = (new RoleValidate())->goCheck();
        $data = $v->validatedData();

        Db::startTrans();
        if(!$role = RoleModel::create(['name' => $data['name'], 'remark' => $data['remark'] ?? '']) ) {
            $this->frobidden('未知错误');
        }

        try {
            # 检查权限是否存在
            if(isset($data['permission_ids'])) {
                $permission_ids = $v->getIds('permission_ids');
                $role->syncPermissions($permission_ids); # 这里面已经有事务操作了
            }
            Db::commit();
        }catch (\Exception $e) {
            Db::rollback();
            $this->frobidden($e->getMessage());
        }

        $this->successed($role);
    }

    /**
     * 删除角色
     * @param $id
     */
    public function delete($id)
    {
        if($role = RoleModel::where('name', '<>', "超级管理员")->find($id)) {
            $role->delete();
            $this->successed('', '删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    /**
     * 修改角色
     * @param $id
     */
    public function update($id)
    {
        $v = (new RoleValidate())->goCheck();
        $data = $v->validatedData();
        if(!$role = RoleModel::find($id)) {
            $this->notFond('角色未找到');
        }

        Db::startTrans();
        RoleModel::update(['name' => $data['name'], 'remark' => $data['remark'] ?? ''], ['id' => $id] );

        # 清空这个角色的权限所有节点
        $role->clearPermissions();

        # 检查权限是否存在
        if(isset($data['permission_ids'])) {
            $permission_ids = $v->getIds('permission_ids');
            $role->syncPermissions($permission_ids); # 这里面已经有事务操作了
        }

        Db::commit();

        $this->successed($role);
    }

    /**
     * 获取角色信息
     */
    public function permissions($id)
    {
        if(!$role = RoleModel::with('permissions')->find($id)) {
            $this->frobidden("角色不存在");
        }

        $permissions = $role->permissions->visible(['id', 'name', 'rule']);
        $role->permissions = $permissions;

        $this->successed($role);
    }

    /**
     * 获取所有的角色
     */
    public function all()
    {
        $this->successed(RoleModel::field(['id','name'])->select());
    }
}