<?php
/**
 * TypechoQiNiu
 * @package TypechoQiNiu
 * @author 邓尘锋
 * @version v1.0.0
 * Date: 2019/6/29
 * Time: 20:07
 */

namespace app\model;


class User extends BaseModel
{
    protected $model_name = "username";
    protected $model_password = "password";

    /**
     * 验证用户账户逻辑
     * @param $user
     * @param $verify_password
     * @return bool
     */
    public function verify_user($user, $verify_password)
    {
        $p = $this->model_password;
        if(password_verify($verify_password, $user->$p)){
            return true;
        }
        return false;
    }

    /**
     * 生成一个密码
     */
    public function create_password(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}