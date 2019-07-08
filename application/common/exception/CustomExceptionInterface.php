<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-13
 * Time: 上午9:35
 */
namespace app\common\exception;

/**
 * 定义一个异常处理接口, 只要是app\common\exception下的子类, 必须继承它
 * Interface CustomExceptionInterface
 * @package app\common\exception
 */
Interface CustomExceptionInterface {
    public function handler($e, array $error_info); # 接受异常处理

    public function showMsg($msg, array $error_info, $code); # 抛出错误消息
}