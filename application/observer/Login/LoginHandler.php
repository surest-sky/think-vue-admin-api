<?php
/**
 * Created by PhpStorm.
 * User: surest : http://surest.cn
 * Date: 19-7-22
 * Time: 下午3:15
 */

namespace app\observer\Login;

use app\admin\model\AdminUser;
use app\observer\AbstractObersver;
use \app\observer\Obersver;

/**
 * 登录事件处理
 * 更新一些参数
 * Class LoginHandler
 * @package app\observer\Login
 */
class LoginHandler extends AbstractObersver implements Obersver
{
    protected $target = null;

    public function __construct($target)
    {
        $this->target = $target;
    }
    /**
     * 处理登录事件
     * @param $target
     */
    public function handler()
    {
        $data = [];
        $data['login_time'] = time();
        $data['update_time'] = time();

        AdminUser::update($data, ['id' => $this->target->id]);
    }
}