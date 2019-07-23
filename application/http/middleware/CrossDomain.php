<?php

namespace app\http\middleware;

use think\Response;


class CrossDomain
{
    public function handle($request, \Closure $next)
    {
        # 跨域请求配置
        # 仅前端 Credentials = true 时
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
        header("Access-Control-Allow-Origin: $origin");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE');
        header('Access-Control-Max-Age: 1728000');
        if (strtoupper($request->method()) == "OPTIONS") {
            return Response::create()->send();
        }

        return $next($request);
    }
}
