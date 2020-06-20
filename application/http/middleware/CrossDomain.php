<?php

namespace app\http\middleware;

use think\Response;


class CrossDomain
{
    public function handle($request, \Closure $next)
    {
        if (strtoupper($request->method()) == "OPTIONS") {
            return Response::create()->send();
        }
        \app\common\server\CrossDomain::credentials();

        return $next($request);
    }
}
