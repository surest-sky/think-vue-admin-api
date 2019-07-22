<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

# 后台管理
Route::group('admin', function (){
    Route::group('', function (){

        # 所有权限
        Route::get('permission/all','admin/Permission/all');

        # 初始化权限节点
        Route::post('permission/init_permission','admin/Permission/init_permission');

        # 权限管理
        Route::resource('permission','admin/Permission');
        # 管理员管理
        Route::resource('admin-user','admin/AdminUser');
        # 角色管理
        Route::resource('role','admin/Role');
        # 获取所有角色
        Route::get('role/all','admin/Role/all');

    })->middleware(['AdminAuth', 'PermissionAuth']);

    # --------------------------------
    # 不需要权限校验
    # --------------------------------
    # 获取我我的信息
    Route::get('me', 'admin/Auth/me')->middleware(['AdminAuth']);

    # 获取七牛相关
    Route::get('qiniu/photo', 'admin/Qiniu/photo');

    # 退出登录
    Route::delete('logout', 'admin/Auth/logout')->middleware(['AdminAuth']);

    # 获取权限信息
    Route::get('/role/permissions/:id', 'admin/Role/permissions')->middleware(['AdminAuth']);

    # 不需要登录
    Route::post('login', 'admin/Auth/login');

});