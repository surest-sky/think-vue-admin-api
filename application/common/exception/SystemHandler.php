<?php
/**
 * Created by PhpStorm.
 * User: chenf
 * Date: 19-5-13
 * Time: 上午9:32
 */

namespace app\common\exception;

/**
 * 严重异常, 这个类是在我们已知的错误之外的错误,需要立即处理,非常严重
 * Class SystemHandler
 * @package app\common\exception
 */
class SystemHandler extends BaseException implements CustomExceptionInterface
{
    public $level = 5;
    public function handler($e, array $error_info)
    {
        return $this->showMsg($e->getMessage(), $error_info);
    }
}