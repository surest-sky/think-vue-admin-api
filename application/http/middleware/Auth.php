<?php

namespace app\http\middleware;

use app\common\Traits\ApiResponse;
use app\index\model\User;

/**
 * 检查是否登录
 * Class Auth
 * @package app\http\middleware
 */
class Auth
{
    use ApiResponse;

    public function handle($request, \Closure $next)
    {
        $this->checkLogin($request);

        return $next($request);
    }

    /**
     * 检查是否已经登录
     * token 机制
     */
    public function checkLogin(&$request)
    {
        if( $token = request()->header('token') ) {
            $user = $request->user;
            # 返回当前的用户信息
            if(!$user) {
                $this->failed('登凭证校验失败');
            }

        }else{
            $this->failed('请登录');
        }
    }
}
