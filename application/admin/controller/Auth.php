<?php
/**
 * TypechoQiNiu
 * @package TypechoQiNiu
 * @author 邓尘锋
 * @version v1.0.0
 * Date: 2019/6/29
 * Time: 0:25
 */

namespace app\admin\controller;


use Surest\Traits\HasRoles;

/**
 * &权限初始化&
 * Class Auth
 * @package app\admin\controller
 */
class Auth extends BaseController
{
    use HasRoles;

    # 定义一个需要权限控制的目录
    protected $path = 'application/admin/controller';
    #　需要排除的文件名称　| 可选
    protected $filter_file = [
        'Auth.php',
        'BaseController.php'
    ];
    # 需要排除的方法 | 可选
    protected $filter_action = [
        'show'
    ];
    # 匹配方法注释的正则 | 可选 | 下面是默认的匹配正则
    protected $action_regex = "#-(.*)-#";
    # 匹配类注释的正则 | 可选 | 下面是默认的匹配正则
    protected $class_regex = "/&(.*)&/i";

    /**
     * -初始化权限节点-
     */
    public function setPermissions()
    {
        $this->init_($this->path);
    }
}