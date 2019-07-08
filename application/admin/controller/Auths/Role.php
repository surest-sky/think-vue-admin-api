<?php
/**
 * TypechoQiNiu
 * @package TypechoQiNiu
 * @author 邓尘锋
 * @version v1.0.0
 * Date: 2019/6/29
 * Time: 10:44
 */

namespace app\admin\controller\Auths;

use app\admin\controller\BaseController;
use app\admin\validate\AddPermissionValidate;
use app\admin\validate\RoleValidate;
use Surest\Model\Role as RoleModel;
use Surest\Model\Permission as PermissionModel;

/**
 * &角色管理&
 * Class Role
 * @package app\admin\controller\Auths
 */
class Role extends BaseController
{
    protected $field = ['id', 'name', 'remark'];
    protected $model = '\Surest\Model\Role';
    /**
     * -角色列表-
     */
    public function index()
    {
        $roles = RoleModel::where('status', 1)->field(['id', 'name', 'remark'])->select();
        $this->successed($roles);
    }

    /**
     * -新建角色-
     */
    public function save()
    {
        $validate = (new RoleValidate())->goCheck();
        $roleData = $validate->validatedData();
        if($role = RoleModel::create($roleData)) {
            $this->successed($role, '创建角色成功');
        }
        $this->frobidden("创建角色失败");
    }

    /**
     * -角色详情-
     * @param $id
     */
    public function read($id)
    {
        parent::read($id);
    }

    /**
     * -更新角色-
     */
    public function update($id)
    {
        $validate = (new RoleValidate())->goCheck();
        $roleData = $validate->validatedData();

        if(RoleModel::where('id', $id)->update($roleData)) {
           $this->successed($roleData, '更新角色成功');
        }

        $this->frobidden("更新角色异常");
    }

    /**
     * -删除角色-
     * @param $id
     */
    public function delete($id)
    {
        parent::delete($id);
    }

    /**
     * 给角色添加权限
     */
    public function addPermission()
    {
        $validate = (new AddPermissionValidate())->goCheck();
        $roleData = $validate->validatedData();
        if(!$role = RoleModel::find($roleData['rid'])) {
            $this->frobidden("角色不存在");
        }
        $pids = $validate->getIds('pids');
        $permission = PermissionModel::where('id', 'in', $pids)->field(['name'])->select();
        if(!$permission) {
            $this->frobidden("未找到需要设置的权限");
        }
        $permission = $permission->toArray();

        $permission_names = array_map(function ($permission) {
            return $permission['name'];
        }, $permission);

        $role->givePermissionTo($permission_names);

        $this->successed("权限添加成功");
    }
}