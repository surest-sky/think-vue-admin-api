<?php

namespace app\admin\model;

use app\common\server\Events;
use app\observer\Event;
use app\observer\Login\LoginHandler;
use Surest\Traits\HasRoles;
use think\Model;

class AdminUser extends BaseModel
{
    use HasRoles;
    protected $username_filed = 'username';
    protected $password_filed = 'password';
    protected $hidden = ['password'];

    const ADMIN_USER = 'admin';

    /**
     * 重置用户密码
     * @author baiyouwen
     */
    public function resetPassword($uid, $NewPassword)
    {
        $passwd = $this->encryptPassword($NewPassword);
        $ret = $this->where(['id' => $uid])->update(['password' => $passwd]);
        return $ret;
    }

    # 密码加密
    protected function encryptPassword($password, $salt = '', $encrypt = 'md5')
    {
        return $encrypt($password . $salt);
    }

    /**
     * 数据校验
     * @param string $username
     * @param string $password
     */
    public function attempt(string $username, string $password)
    {
        $password = self::encrypt($password);

        if($user = self::where($this->username_filed, $username)->where($this->password_filed, $password)->find()){
            return $user;
        }
        return false;
    }

    /**
     * 加密方式
     * @param $password
     */
    public static function encrypt($password)
    {
        return md5($password);
    }
    /**
     * 使之登录
     * @param AdminUser $user
     * @return string
     */
    public function handler(AdminUser $user)
    {
        session_start();
        $sid = session_id();
        $_SESSION['admin_id'] = $user->id;

        $event = new Event();
        $event->add(new LoginHandler($user));
        $event->trigger();

        return $sid;
    }

    /**
     * 条件查询
     */
    public function scopeCondition($query)
    {
        $username = request()->param('username');
        $nickname = request()->param('nickname');
        $email = request()->param('email');

        if($username) {
            $query->where('username', 'like', "%$username%");
        }

        if($nickname) {
            $query->where('nickname', 'like', "%$nickname%");
        }

        if($email) {
            $query->where('email', 'like', "%$email%");
        }

        return $query;
    }

    /**
     * 登录时间
     * @param $val
     * @return false|string
     */
    public function getLogintimeAttr($val)
    {
        if($val) {
            return getDateTime($val);
        }
    }


    /**
     * 检查是否是管理员
     */
    public static function checkIsAdmin(self $adminUser)
    {
        if($adminUser->username === "admin") {
            return true;
        }
        return false;
    }

    /**
     * 是不是最高管理员
     * 用于前端隐藏删除按钮
     * @param $temp
     * @param $data
     * @return int
     */
    public function getIsAdminAttr()
    {
        if(self::checkIsAdmin($this)) {
            return 1;
        }
        return 0;
    }
}
