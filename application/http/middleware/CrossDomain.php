<?php

namespace app\http\middleware;

use think\Response;


class CrossDomain
{
    public function handle($request, \Closure $next)
    {
        \app\common\server\CrossDomain::any();
        if (strtoupper($request->method()) == "OPTIONS") {
            return Response::create()->send();
        }

        return $next($request);
    }
}
