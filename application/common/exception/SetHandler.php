<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-13
 * Time: 上午9:32
 */

namespace app\common\exception;

use app\index\exceptions\SetException;

/**
 * 配置参数出错的异常
 * Class SetHandler
 * @package app\common\exception
 */
class SetHandler extends BaseException implements CustomExceptionInterface
{
    public $level = 5;
    public function handler($e, array $error_info)
    {
        if( $e instanceof SetException) {
            return $this->showMsg($e->getMessage(), $error_info, 401);
        }
    }
}