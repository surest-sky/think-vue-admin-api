<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-11
 * Time: 上午11:43
 */

namespace app\admin\controller;

use app\admin\model\AdminUser as AdminUserModel;
use app\admin\validate\AdminUserLoginValidate;
use Surest\Traits\TreeNode;
use think\Request;

/**
 * 登录相关
 * Class Auth
 * @package app\admin\controller
 */
class Auth extends BaseController
{
    use TreeNode;

    /**
     * 获取我的信息
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function me()
    {
        if($this->user->username == 'admin') {
            $permissions = \Surest\Model\Permission::where(0, 0)
                ->order('method', 'desc')
                ->select()->toArray();
            $permissions = self::recursive_make_tree($permissions);
        }else{
            $permissions = $this->user->getAllPermissions(true);
        }

        unset($this->user['permissions']);
        $this->user->permissions = $permissions;
        $this->successed($this->user);
    }

    /**
     * 登录
     */
    public function login()
    {
        $validate = (new AdminUserLoginValidate())->goCheck();
        $data = $validate->validatedData();
        $admin = new AdminUserModel();
        if($user = $admin->attempt($data['username'], $data['password'])) {
            $sid = $admin->handler($user);
        }else{
            $this->frobidden('账号或者密码错误');
        }

        $this->successed(compact('user', 'sid'), '登录成功');
    }

    /**
     * 退出登录
     */
    public function logout(Request $request)
    {
        $sid = $request->param('sid');
        session_id($sid);
        session_destroy();
        unset($_SESSION);
        $this->successed('', '退出成功');
    }
}