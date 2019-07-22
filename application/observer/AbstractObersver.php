<?php
/**
 * Created by PhpStorm.
 * User: surest : http://surest.cn
 * Date: 19-7-22
 * Time: 下午3:11
 */

namespace app\observer;

/**
 * 观察者模型
 * Class BaseObersver
 */
abstract class AbstractObersver
{
    private $obersvers = [];

    public function add(Obersver $obServer)
    {
        $this->obersvers[] = $obServer;
    }

    /**
     * 执行操作
     */
    public function notify()
    {
        foreach ($this->obersvers as $obersver) {
            $obersver->handler();
        }
    }
}