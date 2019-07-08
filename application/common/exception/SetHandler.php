<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-13
 * Time: 上午9:32
 */

namespace app\common\exception;


// 用户接受处理系统错误抛出异常的一些错误

use app\index\exceptions\SetException;

class SetHandler extends BaseException implements CustomExceptionInterface
{
    public function handler($e, array $error_info)
    {
        if( $e instanceof SetException) {
            return $this->showMsg($e->getMessage(), $error_info, 401);
        }

    }
}