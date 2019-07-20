<?php

namespace app\http\middleware;

use app\admin\model\AdminUser;
use app\common\Traits\ApiResponse;

class AdminAuth
{
    use ApiResponse;

    public function handle($request, \Closure $next)
    {
        if((!$sid = $request->param('sid') ) && (!$sid = $_COOKIE['PHPSESSID'] ?? '')) {
            $this->failed('请登录');
        }

        session_id($sid);
        session_start();
        if(isset($_SESSION['admin_id'])){
            $user = AdminUser::find($_SESSION['admin_id']);
            $request->user = $user;
            return $next($request);
        }
        $this->failed('请登录');
    }
}
