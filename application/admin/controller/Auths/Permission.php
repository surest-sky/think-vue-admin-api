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

use Surest\Model\Permission as PermissionModel;
use app\admin\controller\BaseController;
use think\facade\Route;

/**
 * &权限管理&
 * Class Permission
 * @package app\admin\controller\Auths
 */
class Permission extends BaseController
{
    public function index()
    {
        $permissions = PermissionModel::field(['id', 'name','title','remark','p_id'])->where('status', 1)->select();
        $permissions = PermissionModel::permissionNode($permissions->toArray());

        $this->successed($permissions);
    }

    public function read($id)
    {
        
    }

    public function edit()
    {
        
    }
}