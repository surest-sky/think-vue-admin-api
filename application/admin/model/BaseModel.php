<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-5
 * Time: 上午9:21
 */

namespace app\admin\model;

use app\common\model\BaseModel as BaseModelCommon;
use app\common\Traits\ApiResponse;

class BaseModel extends BaseModelCommon
{
    use ApiResponse;
    /**
     * 条件查询
     * @param $query
     * @return mixed
     */
    public function scopeSort($query)
    {
        $filed = request()->param('field');
        $order = request()->param('order');

        if($filed && $order && in_array($order, ['asc', 'desc'])) {
            $query->order($filed, $order);
        }

        return $query;
    }

}