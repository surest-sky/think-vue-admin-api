<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-24
 * Time: 下午4:03
 */
namespace app\common\server;

use Workerman\Lib\Timer;

class Events
{
    /**
     * 执行定时任务
     * @param $businessWorker
     */
    public static function onWorkerStart($businessWorker)
    {
        Timer::add(1800, "\\app\common\\tasks\\Main::handle");
    }
    public static function onConnect($client_id)
    {
    }
    public static function onWebSocketConnect($client_id, $data)
    {
    }
    public static function onMessage($client_id, $message)
    {
    }
    public static function onClose($client_id)
    {
    }
}