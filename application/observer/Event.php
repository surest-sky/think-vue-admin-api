<?php
/**
 * Created by PhpStorm.
 * User: surest : http://surest.cn
 * Date: 19-7-22
 * Time: 下午3:21
 */

namespace app\observer;


class Event extends AbstractObersver
{
    /**
     * 触发事件
     */
    public function trigger()
    {
        //通知观察者
        $this->notify();
    }
}