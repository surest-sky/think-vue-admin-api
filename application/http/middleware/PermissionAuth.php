<?php

namespace app\http\middleware;

use app\admin\model\Permission;
use app\common\Traits\ApiResponse;

class PermissionAuth
{
    use ApiResponse;
    public function handle($request, \Closure $next)
    {
        if(!$request->user) {
            $this->failed("请登录");
        }

        # 获取当前的请求方法
        # 当数据库中没有添加这个权限的时候, 就放开通行
        $rule = $request->pathinfo();
        $method = strtolower($request->method());

        # 匹配前 : admin/superstore/online/293
        # 匹配过滤后: admin/superstore/online/<id>

        $rule = $this->filter_rule($rule);
        if($permission = Permission::where('rule', $rule)
            ->where('method', 'like', "%$method%")
            ->find()){
            if(!$request->user->can($permission)) {
                $this->failed('没有权限');
            }
        }else{
            $this->failed('没有权限');
        }

        return $next($request);
    }

    /**
     * 过滤路由
     */
    public function filter_rule($rule)
    {
        $pattern = '/(.*)\/([0-9]+)$/';
        $replacement = "$1/<id>";
        return preg_replace($pattern, $replacement, $rule);
    }
}
