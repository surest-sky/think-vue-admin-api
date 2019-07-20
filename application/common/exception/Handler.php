<?php
/**
 * Created by PhpStorm.
 * User: 邓尘锋
 * Date: 19-5-5
 * Time: 上午11:13
 */

namespace app\common\exception;

use Exception;
use think\exception\Handle;
use think\facade\Log;
use think\Response;

/**
 * 异常处理接管, debug关闭状态下防止抛出500错误
 * 以下情况将会导致500错误抛出
 * 致命错误 | 系统严重错误 | 代码的严重问题
 * Class Handler
 * @package app\common\exception
 */
class Handler extends Handle
{
    # 这里写需要进行捕获的错误加载类库
    protected $handler_exceptions = [
        '\app\common\exception\EsearchHandler',
        '\app\common\exception\RouteExceptionHandler',
        '\app\common\exception\SetHandler',
        '\app\common\exception\SystemHandler',
    ];

    // 重写render方法
    public function render(Exception $e)
    {
        try {
            $isDebug = config('app.app_debug'); # 判断是否是断点模式

//            # 走系统抛出的系统
//            if( !request()->isAjax() || $isDebug) {
//                return parent::render($e);
//            }
            $class_ = get_class($e);
            # 错误的信息, 用于写入日志
            $error_info = [
                'code' => $e->getCode(), # 错误代码描述
                'line' => $e->getLine(), # 错误代码行
                'message' => $e->getMessage(), # 错误详细信息
                'file' => $e->getFile(), # 错误文件名称,
                'class_' => $class_,
                "path_info" => \request()->host() . '/' . request()->pathinfo(),
                "method" => request()->method(),
                "ip" => request()->ip(),
            ];

            # 捕获错误处理异常
           return $this->handler_exception($e, $error_info);

        }catch (\Exception $exception) {
            return parent::render($exception);
        }
    }

    /**
     * 加载错误处理
     * @param $e
     */
    public function handler_exception($e, $error_info)
    {
        foreach ($this->handler_exceptions as $exception) {
            $exception = new $exception;
            if($exception->handler($e, $error_info) instanceof Response){
                return $exception->handler($e, $error_info);
            }
        }
    }
}