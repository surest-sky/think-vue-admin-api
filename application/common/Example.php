<?php
/**
 * Created by PhpStorm.
 * User: surest : http://surest.cn
 * Date: 19-7-23
 * Time: 下午3:55
 */

namespace app\common;


use app\admin\model\Permission;

class Example
{
    /**
     * 测试输出
     */
    public static function psysh()
    {
        $num = 1 + 1;
        echo $num;
    }


    /**
     * 初始化权限节点
     */
    public static function init_permission()
    {
        # 初始化权限节点 | 更新操作
        Permission::init_();
        echo "更新节点完成";
    }
}