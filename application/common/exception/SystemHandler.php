<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-13
 * Time: 上午9:32
 */

namespace app\common\exception;


// 用户接受处理系统错误抛出异常的一些错误

class SystemHandler extends BaseException implements CustomExceptionInterface
{
    public function handler($e, array $error_info)
    {
        # 写入日志
//          LogModel::ILogObserver("系统异常: ", $error_info);
        return $this->showMsg($e->getMessage(), $error_info);
    }
}