<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-10
 * Time: 上午11:33
 */

namespace app\admin\model;

use Surest\Traits\TreeNode;


class Permission extends \Surest\Model\Permission
{
    use TreeNode;

    /**
     * 初始化权限节点
     * @param $is_delete bool 是否删除节重建节点
     */
    public static function init_($is_delete = 0)
    {
        (new  static())->init_node($is_delete);
    }
}