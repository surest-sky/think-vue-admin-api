<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-12
 * Time: 上午10:25
 */

namespace app\admin\controller;

use app\admin\model\AdminUser as AdminUserModel;
use app\admin\validate\AdminUserValidate;
use think\Db;
use think\Request;

/**
 * 管理员管理
 * Class AdminUser
 * @package app\admin\controller
 */
class AdminUser extends BaseController
{
    protected $hidden = ['password'];

    /**
     * 管理员管理
     * @param Request $request
     */
    public function index(Request $request)
    {
        $pagesize = $request->param('pagesize', 10);

        $page = $request->param('page', 1);

        $list = AdminUserModel::condition()
            ->sort()
            ->append(['to_roles'])
            ->paginate($pagesize, false, compact('page'));

        $this->successed($list);
    }

    /**
     * 添加管理员
     */
    public function save()
    {
        $validate = (new AdminUserValidate())->goCheck();
        $data = $validate->validatedData();

        Db::startTrans();
        if(!$admin = AdminUserModel::create([
            'username' => $data['username'],
            'password' => isset($data['password']) ? AdminUserModel::encrypt($data['password']) :  AdminUserModel::encrypt("123456"),
            'user_avatar' => $data['user_avatar'],
            'description' => $data['description'] ?? '',
            'email' => $data['email'] ?? '',
            'user_nickname' => $data['user_nickname'] ?? '',
        ]) ) {
            Db::rollback();
            $this->frobidden('请联系管理员');
        }

        try {
            // 清空角色

            # 检查权限是否存在
            if(isset($data['role_ids'])) {
                $permission_ids = $validate->getIds('role_ids');
                $admin->syncRole($permission_ids); # 这里面已经有事务操作了
            }
            Db::commit();
        }catch (\Exception $e) {
            Db::rollback();
            $this->frobidden($e->getMessage());
        }

        $this->successed($admin);

    }

    /**
     * 更新管理员
     */
    public function update($id)
    {
        $validate = (new AdminUserValidate())->goCheck();
        $data = $validate->validatedData();

        $set_data = [
            'username' => $data['username'],
            'password' => isset($data['password']) ? AdminUserModel::encrypt($data['password']) :  AdminUserModel::encrypt("123456"),
            'user_avatar' => $data['user_avatar'],
            'description' => $data['description'] ?? '',
            'email' => $data['email'] ?? '',
            'user_nickname' => $data['user_nickname'] ?? '',
            'isNotice' => $data['isNotice'] ?? 1,
        ];

        Db::startTrans();
        if(!$admin = AdminUserModel::find($id)) {
            $this->frobidden("管理员未找到");
        }
        AdminUserModel::update($set_data, compact('id'));

        try {
            # 检查权限是否存在
            if(isset($data['role_ids'])) {
                $role_ids = $validate->getIds('role_ids');
                $admin->syncRole($role_ids); # 这里面已经有事务操作了
            }
            Db::commit();
        }catch (\Exception $e) {
            Db::rollback();
            $this->frobidden($e->getMessage());
        }

        $this->successed(AdminUserModel::find($id));
    }

    /**
     * 删除管理员
     * @param $id
     */
    public function delete($id)
    {
        if($admin = AdminUserModel::find($id)) {
            $admin->delete();
            $this->successed("删除成功");
        }else{
            $this->frobidden("管理员未找到");
        }
    }

    /**
     * 获取管理员信息
     * @param $id
     */
    public function read($id)
    {
        if($admin = AdminUserModel::with('roles')->find($id)) {
            $admin->roles = $admin->getAllRoles();
            $this->successed($admin);
        }else{
            $this->frobidden("管理员未找到");
        }
    }
}