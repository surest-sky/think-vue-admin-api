<?php

namespace app\http\middleware;

use app\common\Traits\ApiResponse;
use app\index\model\User;

/**
 * 注入用户的信息
 * Class Auth
 * @package app\http\middleware
 */
class App
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
            $user = User::getAvaliable(compact('token'));
            # 返回当前的用户信息
            if($user) {
                $request->user = $user;
            }
        }
    }
}
