<?php
/**
 * Created by PhpStorm.
 * User: surest : http://surest.cn
 * Date: 19-7-23
 * Time: 上午11:21
 */

namespace app\admin\model;


class Role extends \Surest\Model\Role
{
    /**
     * 条件查询
     */
    public function scopeCondition($query)
    {
        $name = request()->param('name');

        if($name) {
            $query->where('name', 'like', "%$name%");
        }
        return $query;
    }

}