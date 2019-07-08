<?php

namespace app\http\middleware;

class SurestAuthPermission
{
    public function handle($request, \Closure $next)
    {
        # 获取请求的路由地址
//        $path = request()->controller() . '/' . request()->action();
//        $request->requestPermissionPath = $path;
        return $next();
    }
}
