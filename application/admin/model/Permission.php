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

    public static function init_()
    {
        (new  static())->init_node((bool) request()->param('is_delete', 0));
    }
}