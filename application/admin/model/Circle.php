<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-7-9
 * Time: 上午10:56
 */

namespace app\admin\model;


class Circle extends BaseModel
{
    protected $type = [
        'create_time' => 'timestamp'
    ];
    /**
     * 条件查询
     * @param $query
     */
    public function scopeCondition($query)
    {
        $status = request()->param('status');
        $like_count = request()->param('like_count');
        $beautiful_count = request()->param('beautiful_count');
        $handsome_count = request()->param('handsome_count');
        $howe_count = request()->param('howe_count');
        $content = request()->param('content');
        $nickname = request()->param('nickname');

        $start_time = request()->param('start_time');
        $end_time = request()->param('end_time');

        if($start_time && $end_time) {
            $str = "$start_time , $end_time";
            $query->where('create_time', "between", $str);
        }

        if($status) {
            $query->where('status', (string)$status);
        }

        if($like_count) {
            $query->order('like_count', $like_count == "desc" ? 'desc' : 'asc');
        }
        if($beautiful_count) {
            $query->order('like_count', $beautiful_count == "desc" ? 'desc' : 'asc');
        }
        if($handsome_count) {
            $query->order('like_count', $handsome_count == "desc" ? 'desc' : 'asc');
        }
        if($howe_count) {
            $query->order('like_count', $howe_count == "desc" ? 'desc' : 'asc');
        }

        if($content) {
            $query->where('content', 'like', "%$content%");
        }

        // 构造子查询
        if($nickname) {
            $query->where('user_id','IN',function($query) use ($nickname){
                $query->name('user')->where('nickname',"like", "%$nickname%")->field('id');
            });
        }

        return $query;
    }

    /**
     * 修改状态
     */
    public static function update_status($id , $status)
    {
        try {
            # 0：待审核 1：已上线 2：已屏蔽 3:已删除
            $status_arr = [0, 1, 2, 3];
            if(!in_array($status, $status_arr)) {
                return false;
            }
            self::update(['status' => $status], ['id' => $id]);
            return true;
        }catch (\Exception $exception) {
            # 忽略掉 , 交给全局异常处理
        }
    }

    /**
     * 批量修改状态
     */
    public static function batch_update_status(array $ids, $status)
    {
        foreach ($ids as $id) {
            self::update_status($id, $status);
        }
    }

    /**
     * 对应的用户
     */
    public function user()
    {
        return $this->belongsTo(User::class)->field(['nickname', 'id']);
    }

    /**
     * 图片列表
     */
    public function getImgsAttr($value)
    {
        if(!$value) {
            return [];
        }
        return \json_decode($value, true);
    }


    /**
     * 批量操作
     * @param $ids
     * @param $status
     * @return int|string
     */
    public function batchUpdateStatus($ids, $status)
    {
        $total = self::where('id', 'in', $ids)->update(['status' => $status]);
        return $total;
    }
}