<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-9
 * Time: 下午2:22
 */

namespace app\admin\controller;
use app\admin\validate\PermissionValidate;
use Surest\Model\Permission as PermissionModel;
use Surest\Traits\TreeNode;

/**
 * 权限管理
 * Class Permission
 * @package app\admin\controller
 */
class Permission extends BaseController
{
    use TreeNode;

    /**
     * 权限管理
     */
    public function index()
    {
        $permissions = PermissionModel::where(0, 0)
            ->order('method', 'desc')
            ->select()->toArray();
        $permissions = self::recursive_make_tree($permissions);
        $this->successed($permissions);
    }

    /**
     * 初始化权限节点
     */
    public function init_permission()
    {
        $r = $this->init_node((bool) request()->param('is_delete', 0));
        $this->successed($r);
    }
    /**
     * 获取所有的权限
     */
    public function all()
    {
        $permissions = PermissionModel::field(['id', 'p_id', 'name'])->select()->toArray();

        $permissions = self::recursive_make_tree($permissions);
        $this->successed($permissions);
    }

    /**
     * 获取权限信息
     * @param $id
     */
    public function read($id)
    {
        $permission = PermissionModel::find($id);
        $this->successed($permission);
    }

    /**
     * 创建权限节点
     */
    public function save()
    {
        $validate = (new PermissionValidate())->goCheck();
        $data = $validate->validatedData();

        try {
            PermissionModel::create($data);
        }catch (\Exception $e) {
            $this->frobidden('发生异常' . $e->getMessage());
        }

        $this->successed('', '创建成功');
    }

    /**
     * 更新权限
     * @param $id
     */
    public function update($id)
    {
        $validate = (new PermissionValidate())->goCheck();
        $data = $validate->validatedData();

        if(!$permission = PermissionModel::find($id)) {
            $this->frobidden("权限不存在");
        }

        try {
            PermissionModel::update($data, ['id' => $id]);
        }catch (\Exception $e) {
            $this->frobidden('发生异常');
        }

        $this->successed('', '更新成功');
    }

    /**
     * 删除权限
     * @param $id
     */
    public function delete($id)
    {
        if(PermissionModel::destroy($id)){
            PermissionModel::where('p_id', $id)->delete();
        }
        $this->successed('', '删除成功');
    }
}