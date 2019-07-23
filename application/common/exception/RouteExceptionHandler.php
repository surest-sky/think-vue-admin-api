<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-13
 * Time: 下午2:51
 */

namespace app\common\exception;


use think\Exception;
use think\exception\HttpException;

class RouteExceptionHandler extends BaseException implements CustomExceptionInterface
{
    public $level = 0;

    public function handler($e, array $err_info)
    {
        # 检测理由错误
        if( $e instanceof HttpException) {
            return $this->showMsg("响应发生错误", $err_info, 404);
        }
    }
}